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

/**
 * Definición de los ficheros según la especificación oficial del Ministerio del Interior.
 * Véase documento `FICHEROS.doc`
 */

$format = [
	// Fichero de candidaturas
	'03' => [
		// Tipo de elección.
		'Tipo de elección' => [
			'start' => 1,
			'length' => 2,
			'formatter' => fn($code) => PROCESOS[$code],
		],

		// Año del proceso electoral
		'Año' => [
			'start' => 3,
			'length' => 4,
			'formatter' => fn($code) => $code,
		],

		// Mes del proceso electoral
		'Mes' => [
			'start' => 7,
			'length' => 2,
			'formatter' => fn($code) => (int) $code,
		],

		// Código de la candidatura
		'Código' => [
			'start' => 9,
			'length' => 6,
			'formatter' => fn($code) => $code,
		],

		// Siglas de la candidatura
		'Siglas' => [
			'start' => 15,
			'length' => 50,
			'formatter' => fn($code) => trim(utf8_encode($code)),
		],

		// Denominación de la candidatura
		'Candidatura' => [
			'start' => 65,
			'length' => 150,
			'formatter' => fn($code) => trim(utf8_encode($code)),
		],

		// Código de la candidatura cabecera de acumulación a nivel provincial
		'Candidatura provincial' => [
			'start' => 215,
			'length' => 6,
			'formatter' => fn($code) => $code,
		],

		// Código de la candidatura cabecera de acumulación a nivel autonómico
		'Candidatura autonómica' => [
			'start' => 221,
			'length' => 6,
			'formatter' => fn($code) => $code,
		],

		// Código de la candidatura cabecera de acumulación a nivel nacional
		'Candidatura nacional' => [
			'start' => 227,
			'length' => 6,
			'formatter' => fn($code) => $code,
		],

	],

	// Fichero de relación de candidatos
	'04' => [
		// Tipo de elección
		'Tipo de elección' => [
			'start' => 1,
			'length' => 2,
			'formatter' => fn($code) => PROCESOS[$code],
		],

		// Año del proceso electoral
		'Año' => [
			'start' => 3,
			'length' => 4,
			'formatter' => fn($code) => $code,
		],

		// Mes del proceso electoral
		'Mes' => [
			'start' => 7,
			'length' => 2,
			'formatter' => fn($code) => (int) $code,
		],

		// Número de vuelta (en procesos a una sola vuelta = 1)
		'Vuelta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => fn($code) => $code,
		],

		// Código INE de la provincia (99 en elecciones al Parlamento Europeo)
		'Provincia' => [
			'start' => 10,
			'length' => 2,
			'formatter' => fn($code) => $code === '99' ? null : PROVINCIAS[$code],
		],

		// Distrito electoral cuando corresponda,
		// o 9 en elecciones que no tienen este tipo de circunscripción
		'Distrito' => [
			'start' => 12,
			'length' => 1,
			'formatter' => function($code, $line) {
				if ($code === '9') {
					return null;
				}
				$proceso = substr($line, 0, 2);
				$provincia = substr($line, 9, 2);
				return DISTRITOS[$proceso][$provincia][$code];
			},
		],

		// Código INE del municipio (elecciones municipales) o del senador (elecciones al Senado).
		// En el resto de procesos electorales es siempre 999.
		'Municipio' => [
			'start' => 13,
			'length' => 3,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				$provincia = substr($line, 9, 2);
				if ($proceso === '04') {
					return MUNICIPIOS[$provincia . $code];
				}
			},
		],
		'Número de orden de senador' => [
			'start' => 13,
			'length' => 3,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				$provincia = substr($line, 9, 2);
				if ($proceso === '03') {
					return (int) $code;
				}
			},
		],

		// Código de la candidatura
		'Candidatura' => [
			'start' => 16,
			'length' => 6,
			'formatter' => fn($code) => $code,
		],

		// Número de orden del candidato
		'Número de orden del candidato' => [
			'start' => 22,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],

		// Tipo de candidato (T = Titular, S = Suplente)
		'Tipo de candidato' => [
			'start' => 25,
			'length' => 1,
			'formatter' => function($code) {
				$map = [
					'T' => 'Titular',
					'S' => 'Suplente',
				];
				return $map[$code];
			},
		],

		// Nombre del candidato
		'Nombre' => [
			'start' => 26,
			'length' => 25,
			'formatter' => fn($code) => trim(utf8_encode($code)),
		],

		// Primer apellido del candidato
		'Primer apellido' => [
			'start' => 51,
			'length' => 25,
			'formatter' => fn($code) => trim(utf8_encode($code)),
		],

		// Segundo apellido del candidato
		'Segundo apellido' => [
			'start' => 76,
			'length' => 25,
			'formatter' => fn($code) => trim(utf8_encode($code)),
		],

		// Sexo del candidato
		'Sexo' => [
			'start' => 101,
			'length' => 1,
			'formatter' => function($code) {
				$map = [
					'M' => 'Hombre',
					'F' => 'Mujer',
				];
				return $map[$code];
			},
		],

		// Fecha de nacimiento del candidato (DIA)
		'Día de nacimiento' => [
			'start' => 102,
			'length' => 2,
			'formatter' => fn($code) => (int) $code ?: null,
		],

		// Fecha de nacimiento del candidato (MES)
		'Mes de nacimiento' => [
			'start' => 104,
			'length' => 2,
			'formatter' => fn($code) => (int) $code ?: null,
		],

		// Fecha de nacimiento del candidato (AÑO)
		'Año de nacimiento' => [
			'start' => 106,
			'length' => 4,
			'formatter' => fn($code) => (int) $code ?: null,
		],

		// DNI
		'DNI' => [
			'start' => 110,
			'length' => 10,
			'formatter' => fn($code) => trim($code) ?: null,
		],

		// Candidato elegido (Si/No)
		'Elegido' => [
			'start' => 120,
			'length' => 1,
			'formatter' => function($code) {
				$map = [
					'S' => 'Sí',
					'N' => 'No',
				];
				return $map[$code];
			},
		],
	],
];
