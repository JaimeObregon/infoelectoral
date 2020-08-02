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

require 'includes/functions.php';

/**
 * Dados dos ficheros, uno con las candidaturas (`03*.DAT`) y otro con los candidatos (`04*.DAT`),
 * este script los interpreta y combina devolviendo por `stdout` un fichero CSV con las listas
 * electorales de dicho proceso electoral.
 *
 * Ni que decir tiene que los dos ficheros dados han de pertenecer al mismo proceso electoral.
 */

// Algunos ficheros particularmente grandes requieren más memoria de la predeterminada
ini_set('memory_limit', '1G');

if (count($argv) != 3) {
    printf("Uso: %s [03*.DAT] [04*.DAT]\n", $argv[0]);
    die;
}

$candidaturas = $candidatos = [];

// Interpreta el nombre del fichero únicamente
$file = parseName($argv[1]);

/**
 * Para la decodificación de los municipios la especificación oficial remite al INE.
 * Pero los códigos cambian a comienzos de cada año, por lo que se hace preciso cargar
 * la del año correspondiente.
 *
 * Y además es precesio añadir a la correspondencia los códigos que el Ministerio ha utilizado
 * históricamente pero que el INE actualmente no reconoce.
 */
require sprintf('includes/municipios/%s.php', $file['Año'] >= 2001 ? $file['Año'] : '2001');
const MUNICIPIOS = MUNICIPIOS_INE + MUNICIPIOS_INEXISTENTES;

// Interpreta el contenido del fichero de candidaturas
$results = parseFile('03', $argv[1]);
foreach ($results as &$result) {
	$codigo = $result['Código'];
	$candidaturas[$codigo] = [
		'Siglas' => $result['Siglas'],
		'Candidatura' => $result['Candidatura'],
		'Provincial' => $result['Candidatura provincial'],
		'Autonómica' => $result['Candidatura autonómica'],
		'Nacional' => $result['Candidatura nacional'],
	];
}

// Interpreta el contenido del fichero de candidatos
$results = parseFile('04', $argv[2]);
foreach ($results as &$result) {
	/**
	 * Aunque la especificación define para los nombres tres campos (`Nombre`, `Primer apelllido` y
	 * `Segundo apellido`), en la práctica sucede que este criterio solo se aplica en ciertos
	 * procesos a partir de un determinado año. Y en los años previos los registros no separan el
	 * nombre y cada uno de los apellidos, sino que consignan todo concatenado en el primero de los
	 * campos (`Nombre`), desbordando sucesivamente el exceso a los otros dos campos siguientes.
	 */
	// En las elecciones a Congreso, Senado, Cabildos y Parlamento Europeo, el cambio de formato se
	// da en el año 2003. En las municipales, en 2011.
	if (in_array($file['Proceso'], ['02', '03', '06', '07']) && $file['Año'] >= 2003 ||
		$file['Proceso'] === '04' && $file['Año'] >= 2011) {
		$nombre = trim(implode(' ',  [
			$result['Nombre'],
			$result['Primer apellido'] ?? '',
			$result['Segundo apellido'] ?? '',
		]));
	}
	else {
		$nombre = $result['Nombre'];
		if (!empty($result['Primer apellido'])) {
			$separator = mb_strlen($result['Nombre']) === 25 ? '' : ' ';
			$nombre .= $separator . $result['Primer apellido'];
			if (!empty($result['Segundo apellido'])) {
				$separator = mb_strlen($result['Primer apellido']) === 25 ? '' : ' ';
				$nombre .= $separator . $result['Segundo apellido'];
			}
		}
	}

	$candidatura = $result['Candidatura'];

	/**
	 * Esta es la estructura de datos exportada.
	 * Los valores inexistentes son devueltos con `null`
	 */
	$candidato = [
		'Proceso' => PROCESOS[$file['Proceso']],
		'Tipo' => $file['Tipo'],
		'Año' => $file['Año'],
		'Mes' => $file['Mes'],
		'Número de orden' => $result['Número de orden del candidato'],
		'Elegido' => $result['Elegido'],
		'Sexo' => $result['Sexo'] ?? null,

		/**
		 * Los registros oficiales omiten el nombre de algunos candidatos.
		 * Por ejemplo, en `cabildos/06199105_TOTA/04069105.DAT:881`.
		 *
		 * Supongo que porque la AEPD o un tribunal han obligado al Ministerio,
		 * en virtud del "derecho al olvido" recogido en el RGPD, a omitir a algunas personas
		 * que no desean seguir apareciendo en las listas.
		 *
		 * En el caso de recibir un nombre vacío, `prettifyName()` devuelve ya `null`.
		 *
		 * Véase https://www.eldiario.es/tecnologia/diario-turing/datos_1_4270624.html
		 */
		'Candidato' => prettifyName($nombre),

		'Provincia' => $result['Provincia'] ?? null,
		'Municipio' => empty($result['Municipio']) ? null : prettifyMunicipality($result['Municipio']),
		'Siglas' => $candidaturas[$candidatura]['Siglas'] ?? null,
		'Candidatura' => $candidaturas[$candidatura]['Candidatura'] ?? null,
	];
	$candidatos[] = $candidato;
}

// Escribe en `stdout` los resultados en formato CSV
$output = fopen('php://output', 'w');
foreach ($candidatos as $candidato) {
	fputcsv($output, array_values($candidato));
}
fclose($output);
