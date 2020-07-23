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

require 'includes/constants.php';
require 'includes/formats.php';

/**
 * Script invocable desde la línea de comandos que decodifica un fichero `.DAT` dado.
 */

// Algunos ficheros particularmente grandes requieren más memoria de la predeterminada
ini_set('memory_limit', '512M');

if (count($argv) != 2) {
    printf("Uso: %s [FICHERO.DAT]\n", $argv[0]);
    die;
}

$filename = $argv[1];

/**
 * La especificación define literalmente así la nomenclatura de los ficheros .DAT:
 * `nnxxaamm.dat`
 * - `nn`: Código identificativo del tipo de fichero
 * - `xx`: Tipo de proceso electoral
 * - `aa`: Dos últimas cifras del año de celebración del proceso electoral
 * - `mm`: Dos dígitos correspondientes al mes de celebración del proceso electoral
 * - `dat`: Es siempre la extensión de los ficheros
 */
preg_match('#(\d{2})(\d{2})(\d{2})(\d{2})\.DAT#i', $filename, $matches);
list(, $nn, $xx, $aa, $mm) = $matches;
$year = ($aa > 70 ? '19' : '20') . $aa;

$file = [
	'Fichero' => $filename,
	'Tipo de fichero' => FICHEROS[$nn],
	'Tipo de proceso electoral' => PROCESOS[$xx],
	'Año del proceso electoral' => $year,
	'Mes del proceso electoral' => (int) $mm,
];
print_r($file);

/**
 * Para la decodificación de los municipios la especificación remite al INE.
 * Pero los códigos cambian a comienzos de cada año, por lo que se hace preciso cargar
 * la del año correspondiente.
 */
require sprintf('includes/municipios/%s.php', $year >= 2001 ? $year : '2001');
const MUNICIPIOS = MUNICIPIOS_INE + MUNICIPIOS_INEXISTENTES;

$lines = file($filename);
foreach ($lines as $line) {
	// Ficheros como `municipales/04201505_TOTA/04041505.DAT` tienen corrompido
	// un particular registro. Pero es posible subsanar el error y aquí lo hacemos.
	// Saludos a Linda M. Peeters, cuya candidatura en 2015 corrompió los ficheros oficiales...
	if ($nn === '04' && preg_match('/^042015051439153090873009TLinda/', $line)) {
		$line = str_replace('7000000001', 'F00000000 ', $line);
	}

	// Ficheros como `municipales/04197904_MUNI/11047904.DAT` tienen algunas líneas corrompidas.
	// Aquí descartamos dichas líneas.
	if ($nn === '11' && preg_match('/[SN]$/', $line) === 0) {
		continue;
	}

	// Ficheros como `municipales/04198305_MUNI/12048305.DAT` tienen también corrompidas algunas
	// líneas. Lo subsanamos aquí.
	if ($nn === '12' && preg_match('/ {30}\d{3}[SN] {50}$/', $line)) {
		$line = substr_replace(trim($line), str_pad('', 50, ' '), 69, 0);
	}

	$results = [];
	foreach ($formats[$nn] as $name => $field) {
		$value = substr($line, $field['start'] - 1, $field['length']);
		$result = $field['formatter']($value, $line);
		if (!is_null($result)) {
			$results[$name] = $result;
		}
	}
	print_r($results);
}
