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
$file = [
	'Tipo de fichero' => FICHEROS[$nn],
	'Tipo de proceso electoral' => PROCESOS[$xx],
	'Año del proceso electoral' => ($aa > 70 ? '19' : '20') . $aa,
	'Mes del proceso electoral' => (int) $mm,
];
print_r($file);

$lines = file($filename);
foreach ($lines as $line) {
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
