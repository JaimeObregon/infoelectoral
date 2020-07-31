<?php
/**
 * infoelectoral, intérprete de microdatos electorales del Ministerio del Interior español.
 * Copyright (C) 2020 Jaime Gómez-Obregón
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * @copyright     Copyright (c) Jaime Gómez-Obregón
 * @link          https://github.com/JaimeObregon/infoelectoral
 * @license       https://www.gnu.org/licenses/agpl-3.0.en.html
 */

require 'constants.php';
require 'formats.php';

/**
 * Pequeña biblioteca de funciones que apoyan la decodificación de los ficheros `.DAT`.
 */

/**
 * Decodifica una línea de un fichero, dado su tipo.
 *
 * @param  string $format Tipo de fichero. Véase la constante `FICHEROS`
 * @param  string $line   Línea de texto a decodificar
 * @return array          Estructura de datos con la línea decodificada
 */
function parseLine($format, $line) {
	global $formats;

	// Ficheros como `municipales/04201505_TOTA/04041505.DAT` tienen corrompido
	// un particular registro. Pero es posible subsanar el error y aquí lo hacemos.
	// Saludos a Linda M. Peeters, cuya candidatura en 2015 corrompió los ficheros oficiales...
	if ($format === '04' && preg_match('/^042015051439153090873009TLinda/', $line)) {
		$line = str_replace('7000000001', 'F00000000 ', $line);
	}

	// Ficheros como `municipales/04197904_MUNI/11047904.DAT` tienen algunas líneas corrompidas.
	// Aquí descartamos dichas líneas.
	if ($format === '11' && preg_match('/[SN]$/', $line) === 0) {
		return false;
	}

	// Ficheros como `municipales/04198305_MUNI/12048305.DAT` tienen también corrompidas algunas
	// líneas. Lo subsanamos aquí.
	if ($format === '12' && preg_match('/ {30}\d{3}[SN] {50}$/', $line)) {
		$line = substr_replace(trim($line), str_pad('', 50, ' '), 69, 0);
	}

	$results = [];
	foreach ($formats[$format] as $name => $field) {
		$value = substr($line, $field['start'] - 1, $field['length']);
		$result = $field['formatter']($value, $line);
		if (!is_null($result)) {
			$results[$name] = $result;
		}
	}

	return $results;
}

/**
 * Interpreta el nombre de un fichero conforme la especificación.
 *
 * La especificación define literalmente así la nomenclatura de un ficheros `nnxxaamm.dat`:
 * - `nn`: Código identificativo del tipo de fichero
 * - `xx`: Tipo de proceso electoral
 * - `aa`: Dos últimas cifras del año de celebración del proceso electoral
 * - `mm`: Dos dígitos correspondientes al mes de celebración del proceso electoral
 * - `dat`: Es siempre la extensión de los ficheros
 *
 * @param  string $filename Nombre del fichero
 * @return array            Estructura de datos con el nombre del fichero decodificado
 */
function parseName($filename) {
	preg_match('#(\d{2})(\d{2})(\d{2})(\d{2})\.DAT#i', $filename, $matches);
	list(, $nn, $xx, $aa, $mm) = $matches;
	$year = ($aa > 70 ? '19' : '20') . $aa;

	return [
		'Fichero' => $filename,
		'Código' => $nn,
		'Descripción' => FICHEROS[$nn],
		'Proceso' => $xx,
		'Tipo' => PROCESOS[$xx],
		'Año' => $year,
		'Mes' => (int) $mm,
	];
}

/**
 * Interpreta un fichero `.DAT` conforme la especificación.
 *
 * @param  string $format   Tipo de fichero. Véase la constante `FICHEROS`
 * @param  string $filename Ruta del fichero
 * @return array            Estructura de datos con los registros del fichero decodificados
 */
function parseFile($format, $filename) {
	$results = [];
	$lines = file($filename);
	foreach ($lines as $line) {
		$results[] = parseLine($format, $line);
	}

	return $results;
}

/**
 * Hace un embellecimiento del nombre completo de un candidato.
 *
 * @param  [string] $name Nombre completo del candidato
 * @return [string]       Nombre completo embellecido
 */
function prettifyName($name) {
	$map = [
		'/ De La /' => ' de la ',
		'/ Del /' => ' del ',
		'/ De /' => ' de ',
		'/ Y /' => ' y ',
		'/ I /' => ' i ',
		'/ E /' => ' e ',
	];

	// Hagamos un mínimo embellecimiento de la capitalización...
	$name = mb_convert_case($name, MB_CASE_TITLE);
	$name = preg_replace(array_keys($map), array_values($map), $name);

	// ...y erradiquemos también los sufijos que entre paréntesis constan a veces. Ejemplos:
	// - `Ramon Marrero Garcia (Independiente)`
	// - `Celestino Gonzalez Bolaños (PCE L-M)`
	$name = trim(preg_replace('/\(.+\)\s*$/', '', $name));

	return $name;
}

/**
 * Embellece el nombre de un municipios.
 *
 * Véase https://github.com/JaimeObregon/infoelectoral/issues/1
 *
 * @param  [string] $name Nombre del municipio
 * @return [string]       Nombre del municipio embellecido
 */
function prettifyMunicipality($name) {
	// Reemplazamos dobles espacios. Ejemplos:
	// - `Saus,  Camallera i Llampaies` → `Saus, Camallera i Llampaies`
	// - `Cruïlles,  Monells i Sant Sadurní de l'Heura` → `Cruïlles, Monells i Sant Sadurní de l'Heura`
	$name = trim(preg_replace('/ {2,}/', ' ', $name));

	// En el caso de municipios con dos nombres, cada uno ha de embellecerse por separado.
	// Por ejemplo:
	// - `Pinós, el/Pinoso` ha de ser `El Pinós/Pinoso`
	// - `Lorcha/Orxa, l'` ha de ser `Lorcha/l'Orxa`, y no `l'Lorcha/Orxa`
	$names = explode('/', $name);
	foreach ($names as &$name) {
		// He revisado automáticamente todas las tablas de decodificación de municipios del INE,
		// así como también `MUNICIPIOS_INEXISTENTES`, y he obtenido así todos los posibles sufijos
		// que pueden aparecer, tras una coma, en el nombre de un municipio. Son estos:
		$sufijos = "#^(.+), (A|As|El|Els|Es|L'|La|Las|Les|Los|O|Os|Sa|Ses|el|els|l'|la|les)$#";
		$name = preg_replace($sufijos, '${2} ${1}', $name);

		// Pero lo correcto es `L'Albi` y no `L' Albi`
		$name = preg_replace("/^[Ll]' /", "L'", $name);

		// Y `l'Alfàs del Pi` ha de ser `L'Alfàs del Pi`
		$name = ucfirst($name);
	}

	$name = implode('/', $names);

	return $name;
}
