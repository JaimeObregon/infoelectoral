<?php
/**
 * infoelectoral, intérprete de candidaturas electorales del Ministerio del Interior español.
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

const FILENAME = '../files/municipales/04201105_TOTA/04041105.DAT';

$lines = file(FILENAME);
foreach ($lines as $line) {
	$results = [];
	foreach ($format['04'] as $name => $field) {
		$value = substr($line, $field['start'] - 1, $field['length']);
		$result = $field['formatter']($value, $line);
		if (!is_null($result)) {
			$results[$name] = $result;
		}
	}
	print_r($results);
}
