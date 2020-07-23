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
 * Script invocable desde la línea de comandos que decodifica un fichero `.DAT` dado.
 */

// Algunos ficheros particularmente grandes requieren más memoria de la predeterminada
ini_set('memory_limit', '512M');

if (count($argv) != 2) {
    printf("Uso: %s [FICHERO.DAT]\n", $argv[0]);
    die;
}
$filename = $argv[1];

// Interpreta el nombre del fichero únicamente
$file = parseName($filename);

/**
 * Para la decodificación de los municipios la especificación oficial remite al INE.
 * Pero los códigos cambian a comienzos de cada año, por lo que se hace preciso cargar
 * la del año correspondiente.
 *
 * Y además es preciso añadir a la correspondencia los códigos que el Ministerio ha utilizado
 * históricamente pero que el INE actualmente no reconoce.
 */
require sprintf('includes/municipios/%s.php', $file['Año'] >= 2001 ? $file['Año'] : '2001');
const MUNICIPIOS = MUNICIPIOS_INE + MUNICIPIOS_INEXISTENTES;

// Interpreta el contenido del fichero
$results = parseFile($file['Código'], $filename);

print_r($file);
print_r($results);
