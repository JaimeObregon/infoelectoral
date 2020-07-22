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

/**
 * Definición de los ficheros según la especificación oficial del Ministerio del Interior.
 * Véase documento `FICHEROS.doc`
 */

$formats = [
	// Fichero de control de los ficheros que componen el proceso electoral
	'01' => [
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

		// Número de vuelta (en procesos a una sola vuelta o referéndum = `1`)
		'Vuelta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => fn($code) => $code,
		],

		// Si se adjunta o no el fichero `02xxaamm.dat`
		'Contiene el fichero 02 (' . FICHEROS['02'] . ')' => [
			'start' => 11,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `03xxaamm.dat`
		'Contiene el fichero 03 (' . FICHEROS['03'] . ')' => [
			'start' => 12,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `04xxaamm.dat`
		'Contiene el fichero 04 (' . FICHEROS['04'] . ')' => [
			'start' => 13,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `05xxaamm.dat`
		'Contiene el fichero 05 (' . FICHEROS['05'] . ')' => [
			'start' => 14,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `06xxaamm.dat`
		'Contiene el fichero 06 (' . FICHEROS['06'] . ')' => [
			'start' => 15,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `07xxaamm.dat`
		'Contiene el fichero 07 (' . FICHEROS['07'] . ')' => [
			'start' => 16,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `08xxaamm.dat`
		'Contiene el fichero 08 (' . FICHEROS['08'] . ')' => [
			'start' => 17,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `09xxaamm.dat`
		'Contiene el fichero 09 (' . FICHEROS['09'] . ')' => [
			'start' => 18,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `10xxaamm.dat`
		'Contiene el fichero 10 (' . FICHEROS['10'] . ')' => [
			'start' => 19,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `1104aamm.dat`
		'Contiene el fichero 1104 (' . FICHEROS['11'] . ')' => [
			'start' => 20,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `1204aamm.dat`
		'Contiene el fichero 1204 (' . FICHEROS['12'] . ')' => [
			'start' => 21,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `0510aamm.dat`
		'Contiene el fichero 0510 (' . FICHEROS['05'] . ')' => [
			'start' => 22,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `0610aamm.dat`
		'Contiene el fichero 0610 (' . FICHEROS['06'] . ')' => [
			'start' => 23,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `0710aamm.dat`
		'Contiene el fichero 0710 (' . FICHEROS['07'] . ')' => [
			'start' => 24,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],

		// Si se adjunta o no el fichero `0810aamm.dat`
		'Contiene el fichero 0810 (' . FICHEROS['08'] . ')' => [
			'start' => 25,
			'length' => 1,
			'formatter' => fn($code) => [
				'1' => 'Sí',
				'0' => 'No',
			][$code],
		],
	],

	// Fichero de identificación del proceso electoral
	'02' => [
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

		// Número de vuelta (en procesos a una sola vuelta o referéndum = `1`)
		'Vuelta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => fn($code) => $code,
		],

		// Tipo de ámbito
		'Tipo de ámbito' => [
			'start' => 10,
			'length' => 1,
			'formatter' => function($code) {
				return [
					'N' => 'Nacional',
					'A' => 'Autonómico',
				][$code];
			},
		],

		// Ámbito territorial del proceso electoral
		'Ámbito' => [
			'start' => 11,
			'length' => 2,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				$ambito = substr($line, 9, 1);
				if (in_array($proceso, ['05', '06', '15']) || ($proceso === '01' && $ambito === 'A')) {
					return AUTONOMIAS[$code];
				}
			}
		],

		// Día de la fecha de celebración del proceso electoral
		'Día de celebración' => [
			'start' => 13,
			'length' => 2,
			'formatter' => fn($code) => (int) $code,
		],

		// Mes de la fecha de celebración del proceso electoral
		'Mes de celebración' => [
			'start' => 15,
			'length' => 2,
			'formatter' => fn($code) => (int) $code,
		],

		// Año de la fecha de celebración del proceso electoral
		'Año de celebración' => [
			'start' => 17,
			'length' => 4,
			'formatter' => fn($code) => $code,
		],

		// Hora de apertura de los colegios electorales (en formato `HH:MM` de 24 horas)
		'Hora de apertura' => [
			'start' => 21,
			'length' => 5,
			'formatter' => fn($code) => $code,
		],

		// Hora de cierre de los colegios electorales (en formato `HH:MM` de 24 horas)
		'Hora de cierre' => [
			'start' => 26,
			'length' => 5,
			'formatter' => fn($code) => $code,
		],

		// Hora del primer avance de participación (en formato `HH:MM` de 24 horas)
		'Hora del primer avance de participación' => [
			'start' => 31,
			'length' => 5,
			'formatter' => fn($code) => $code,
		],

		// Hora del segundo avance de participación (en formato `HH:MM` de 24 horas)
		'Hora del segundo avance de participación' => [
			'start' => 36,
			'length' => 5,
			'formatter' => fn($code) => $code,
		],
	],

	// Fichero de candidaturas
	'03' => [
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

		// Número de vuelta (en procesos a una sola vuelta o referéndum = `1`)
		'Vuelta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => fn($code) => $code,
		],

		// Código INE de la provincia (`99` en elecciones al Parlamento Europeo)
		'Provincia' => [
			'start' => 10,
			'length' => 2,
			'formatter' => fn($code) => $code === '99' ? null : PROVINCIAS[$code],
		],

		// Distrito electoral cuando corresponda,
		// o `9` en elecciones que no tienen este tipo de circunscripción
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
		// En el resto de procesos electorales es siempre `999`.
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

		// Tipo de candidato
		'Tipo de candidato' => [
			'start' => 25,
			'length' => 1,
			'formatter' => function($code) {
				return [
					'T' => 'Titular',
					'S' => 'Suplente',
				][$code];
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
				return [
					'M' => 'Hombre',
					'F' => 'Mujer',
					// Aunque la especificación no lo contempla, en algunos ficheros como por ejemplo
					// `municipales/04200305_MESA/04040305.DAT` sucede que este campo es un espacio
					// en blanco.
					' '  => null,
				][$code];
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
				return [
					'S' => 'Sí',
					'N' => 'No',
				][$code];
			},
		],
	],

	// Fichero de datos comunes de municipios
	'05' => [
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

		// Número de vuelta (en procesos a una sola vuelta o referéndum = `1`)
		'Vuelta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => fn($code) => $code,
		],

		// Código de la comunidad autónoma
		'Comunidad autónoma' => [
			'start' => 10,
			'length' => 2,
			'formatter' => fn($code) => AUTONOMIAS[$code],
		],

		// Código INE de la provincia
		'Provincia' => [
			'start' => 12,
			'length' => 2,
			'formatter' => fn($code) => PROVINCIAS[$code],
		],

		// Código INE del municipio
		'Municipio' => [
			'start' => 14,
			'length' => 3,
			'formatter' => function($code, $line) {
				$provincia = substr($line, 11, 2);
				return MUNICIPIOS[$provincia . $code];
			},
		],

		// Número de distrito municipal
		'Número de distrito' => [
			'start' => 17,
			'length' => 2,
			'formatter' => fn($code) => $code === '99' ? null : $code,
		],

		// Nombre del municipio o del distrito municipal
		'Nombre del municipio' => [
			'start' => 19,
			'length' => 100,
			'formatter' => function($code, $line) {
				$distrito = substr($line, 16, 2);
				return $distrito === '99' ? trim(utf8_encode($code)) : null;
			},
		],
		'Nombre del distrito' => [
			'start' => 19,
			'length' => 100,
			'formatter' => function($code, $line) {
				$distrito = substr($line, 16, 2);
				return $distrito !== '99' ? trim(utf8_encode($code)) : null;
			},
		],

		// Código del distrito electoral, o `0` en elecciones
		// que no tienen este tipo de circunscripción
		'Distrito electoral' => [
			'start' => 119,
			'length' => 1,
			'formatter' => fn($code) => (int) $code ?: null,
		],

		// Código del partido judicial
		'Partido judicial' => [
			'start' => 120,
			'length' => 3,
			'formatter' => fn($code) => $code,
		],

		// Código de la diputación provincial
		'Diputación provincial' => [
			'start' => 123,
			'length' => 3,
			'formatter' => fn($code) => $code,
		],

		// Código de la comarca
		'Comarca' => [
			'start' => 126,
			'length' => 3,
			'formatter' => fn($code) => $code,
		],

		// Población de derecho
		'Población de derecho' => [
			'start' => 129,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Número de mesas
		'Número de mesas' => [
			'start' => 137,
			'length' => 5,
			'formatter' => fn($code) => (int) $code,
		],

		// Censo del INE
		'Censo del INE' => [
			'start' => 142,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Censo de escrutinio
		'Censo de escrutinio' => [
			'start' => 150,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Censo CERE en escrutinio (residentes extranjeros)
		'Censo CERE en escrutinio' => [
			'start' => 158,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Total votantes CERE (residentes extranjeros)
		'Total votantes CERE' => [
			'start' => 166,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Votantes del primer avance de participación
		'Votantes del primer avance' => [
			'start' => 174,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Votantes del segundo avance de participación
		'Votantes del segundo avance' => [
			'start' => 182,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Votos en blanco
		'Votantes en blanco' => [
			'start' => 190,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Votos nulos
		'Votantes nulos' => [
			'start' => 198,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Votos a candidaturas
		'Votantes a candidaturas' => [
			'start' => 206,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Número de escaños a distribuir cuando el municipio es la circunscripción electoral.
		// Ceros en otros casos.
		'Número de escaños' => [
			'start' => 214,
			'length' => 3,
			'formatter' => fn($code) => (int) $code ?: null,
		],

		// Votos afirmativos en referéndum, o ceros en otros procesos electorales
		'Votos afirmativos' => [
			'start' => 217,
			'length' => 8,
			'formatter' => fn($code) => (int) $code ?: null,
		],

		// Votos negativos en referéndum, o ceros en otros procesos electorales
		'Votos negativos' => [
			'start' => 225,
			'length' => 8,
			'formatter' => fn($code) => (int) $code ?: null,
		],

		// Datos oficiales
		'Datos oficiales' => [
			'start' => 233,
			'length' => 1,
			'formatter' => fn($code) => [
				'S' => 'Sí',
				'N' => 'No',
			][$code],
		],
	],

	// Fichero de datos de candidaturas de municipios
	'06' => [
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

		// Número de vuelta (en procesos a una sola vuelta o referéndum = `1`)
		'Vuelta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => fn($code) => $code,
		],

		// Código INE de la provincia
		'Provincia' => [
			'start' => 10,
			'length' => 2,
			'formatter' => fn($code) => PROVINCIAS[$code],
		],

		// Código INE del municipio
		'Municipio' => [
			'start' => 12,
			'length' => 3,
			'formatter' => function($code, $line) {
				$provincia = substr($line, 9, 2);
				return MUNICIPIOS[$provincia . $code];
			},
		],

		// Número de distrito municipal
		'Número de distrito' => [
			'start' => 15,
			'length' => 2,
			'formatter' => fn($code) => $code === '99' ? null : $code,
		],

		// Código de la candidatura o del senador
		'Código de candidatura' => [
			'start' => 17,
			'length' => 6,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				if ($proceso !== '03') {
					return $code;
				}
			}
		],
		'Distrito' => [
			'start' => 17,
			'length' => 6,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				if ($proceso === '03') {
					$provincia = substr($code, 0, 2);
					$distrito = substr($code, 2, 1);
					if ($distrito === '9') {
						return null;
					}
					return DISTRITOS[$proceso][$provincia][$distrito];
				}
			},
		],
		'Número de orden de senador' => [
			'start' => 17,
			'length' => 6,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				if ($proceso === '03') {
					return (int) substr($code, 3, 3);
				}
			},
		],

		// Votos obtenidos por la candidatura
		'Votos obtenidos' => [
			'start' => 23,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Número de candidatos obtenidos por la candidatura
		'Número de candidatos obtenidos' => [
			'start' => 31,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],
	],

	// Fichero de datos comunes de ámbito superior al municipio
	'07' => [
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

		// Número de vuelta (en procesos a una sola vuelta = `1`) o número de pregunta en referéndum
		'Vuelta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				if ($proceso !== '01') {
					return $code;
				}
			}
		],
		'Número de pregunta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				if ($proceso === '01') {
					return $code;
				}
			}
		],

		// Código de la comunidad autónoma. O `99` en el caso de total nacional.
		'Comunidad autónoma' => [
			'start' => 10,
			'length' => 2,
			'formatter' => fn($code) => $code === '99' ? null : AUTONOMIAS[$code],
		],

		// Código INE de la provincia. O `99` si son datos a nivel total comunidad o total nacional.
		'Provincia' => [
			'start' => 12,
			'length' => 2,
			'formatter' => fn($code) => $code === '99' ? null : PROVINCIAS[$code],
		],

		// Código del distrito electoral, o `9` en datos a nivel total provincial, comunidad o nacional
		'Distrito electoral' => [
			'start' => 14,
			'length' => 1,
			'formatter' => function($code, $line) {
				if ($code === '9') {
					return null;
				}
				$proceso = substr($line, 0, 2);
				$provincia = substr($line, 11, 2);
				return DISTRITOS[$proceso][$provincia][$code];
			},
		],

		// Nombre del ámbito territorial
		'Ámbito territorial' => [
			'start' => 15,
			'length' => 50,
			'formatter' => fn($code) => trim(utf8_encode($code)),
		],

		// Población de derecho
		'Población de derecho' => [
			'start' => 65,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Número de mesas
		'Número de mesas' => [
			'start' => 73,
			'length' => 5,
			'formatter' => fn($code) => (int) $code,
		],

		// Censo del INE
		'Censo del INE' => [
			'start' => 78,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Censo de escrutinio
		'Censo de escrutinio' => [
			'start' => 86,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Censo CERE en escrutinio (residentes extranjeros)
		'Censo CERE en escrutinio' => [
			'start' => 94,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Total votantes CERE (residentes extranjeros)
		'Total votantes CERE' => [
			'start' => 102,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Votantes del primer avance de participación
		'Votantes del primer avance' => [
			'start' => 110,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Votantes del segundo avance de participación
		'Votantes del segundo avance' => [
			'start' => 118,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Votos en blanco
		'Votantes en blanco' => [
			'start' => 126,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Votos nulos
		'Votantes nulos' => [
			'start' => 134,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Votos a candidaturas
		'Votantes a candidaturas' => [
			'start' => 142,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Número de escaños a distribuir cuando el ámbito coincida con la circunscripción electoral,
		// o total de escaños distribuidos en el ámbito.
		// Ceros en el caso de que el ámbito sea inferior a la circunscripción electoral
		'Número de escaños' => [
			'start' => 150,
			'length' => 6,
			'formatter' => fn($code) => (int) $code ?: null,
		],

		// Votos afirmativos en referéndum, o ceros en otros procesos electorales
		'Votos afirmativos' => [
			'start' => 156,
			'length' => 8,
			'formatter' => fn($code) => (int) $code ?: null,
		],

		// Votos negativos en referéndum, o ceros en otros procesos electorales
		'Votos negativos' => [
			'start' => 164,
			'length' => 8,
			'formatter' => fn($code) => (int) $code ?: null,
		],

		// Datos oficiales
		'Datos oficiales' => [
			'start' => 172,
			'length' => 1,
			'formatter' => fn($code) => [
				'S' => 'Sí',
				'N' => 'No',
			][$code],
		],
	],

	// Fichero de datos de candidaturas de ámbito superior al municipio
	'08' => [
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

		// Número de vuelta (en procesos a una sola vuelta = `1`)
		'Vuelta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => fn($code) => $code,
		],

		// Código de la comunidad autónoma. O `99` en el caso de total nacional.
		'Comunidad autónoma' => [
			'start' => 10,
			'length' => 2,
			'formatter' => fn($code) => $code === '99' ? null : AUTONOMIAS[$code],
		],

		// Código INE de la provincia. O `99` si son datos a nivel total comunidad o total nacional.
		'Provincia' => [
			'start' => 12,
			'length' => 2,
			'formatter' => fn($code) => $code === '99' ? null : PROVINCIAS[$code],
		],

		// Código del distrito electoral, o `9` en datos a nivel total provincial, comunidad o nacional
		'Distrito electoral' => [
			'start' => 14,
			'length' => 1,
			'formatter' => function($code, $line) {
				if ($code === '9') {
					return null;
				}
				$proceso = substr($line, 0, 2);
				$provincia = substr($line, 11, 2);
				return DISTRITOS[$proceso][$provincia][$code];
			},
		],

		// Código de la candidatura o del senador
		'Código de candidatura' => [
			'start' => 15,
			'length' => 6,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				if ($proceso !== '03') {
					return $code;
				}
			}
		],
		'Distrito' => [
			'start' => 15,
			'length' => 6,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				if ($proceso === '03') {
					$provincia = substr($code, 0, 2);
					$distrito = substr($code, 2, 1);
					if ($distrito === '9') {
						return null;
					}
					return DISTRITOS[$proceso][$provincia][$distrito];
				}
			},
		],
		'Número de orden de senador' => [
			'start' => 15,
			'length' => 6,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				if ($proceso === '03') {
					return (int) substr($code, 3, 3);
				}
			},
		],

		// Votos obtenidos por la candidatura
		'Votos obtenidos' => [
			'start' => 21,
			'length' => 8,
			'formatter' => fn($code) => (int) $code,
		],

		// Número de candidatos obtenidos por la candidatura
		'Número de candidatos obtenidos' => [
			'start' => 29,
			'length' => 5,
			'formatter' => fn($code) => (int) $code,
		],
	],

	// Fichero de datos comunes de mesas y del CERA
	'09' => [
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

		// Número de vuelta (en procesos a una sola vuelta = `1`) o número de pregunta en referéndum
		'Vuelta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				if ($proceso !== '01') {
					return $code;
				}
			}
		],
		'Número de pregunta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				if ($proceso === '01') {
					return $code;
				}
			}
		],

		// Código de la comunidad autónoma. O `99` en el caso de total nacional del CERA.
		'Comunidad autónoma' => [
			'start' => 10,
			'length' => 2,
			'formatter' => fn($code) => $code === '99' ? null : AUTONOMIAS[$code],
		],

		// Código INE de la provincia. O `99` si son datos a nivel total autonómico
		// o nacional del CERA.
		'Provincia' => [
			'start' => 12,
			'length' => 2,
			'formatter' => fn($code) => $code === '99' ? null : PROVINCIAS[$code],
		],

		// Código INE del municipio. `999` = CERA.
		'Municipio' => [
			'start' => 14,
			'length' => 3,
			'formatter' => function($code, $line) {
				if ($code !== '999') {
					$provincia = substr($line, 11, 2);
					return MUNICIPIOS[$provincia . $code];
				}
			},
		],
		'CERA' => [
			'start' => 14,
			'length' => 3,
			'formatter' => function($code, $line) {
				if ($code === '999') {
					return 'Sí';
				}
			},
		],

		// Número de distrito municipal en su caso o `01` si el municipio no tiene distritos.
		// En el caso de datos procedentes del CERA, llevará el número del distrito electoral
		// a que correspondan, o `09` si el ámbito de dicho distrito coincide con el de la provincia.
		'Número de distrito' => [
			'start' => 17,
			'length' => 2,
			'formatter' => fn($code) => $code === '01' ? null : $code,
		],

		// Código de la sección (tres dígitos seguidos de un espacio, letra mayúscula u otro dígito)
		'Código de sección' => [
			'start' => 19,
			'length' => 4,
			'formatter' => fn($code) => $code === '0000' ? null : $code,
		],

		// Código de mesa (una letra mayúscula identificando la mesa o una `U` en caso de mesa única)
		'Código de mesa' => [
			'start' => 23,
			'length' => 1,
			'formatter' => fn($code) => $code === 'U' ? null : $code,
		],

		// Censo del INE
		'Censo del INE' => [
			'start' => 24,
			'length' => 7,
			'formatter' => fn($code) => $code === '0000000' ? null : (int) $code,
		],

		// Censo de escrutinio o censo CERA
		'Censo de escrutinio' => [
			'start' => 31,
			'length' => 7,
			'formatter' => function($code, $line) {
				$municipio = substr($line, 13, 3);
				if ($municipio !== '999') {
					return (int) $code;
				}
			},
		],
		'Censo CERA' => [
			'start' => 31,
			'length' => 7,
			'formatter' => function($code, $line) {
				$municipio = substr($line, 13, 3);
				if ($municipio === '999') {
					return (int) $code;
				}
			},
		],

		// Censo CERE en escrutinio (residentes extranjeros)
		'Censo CERE en escrutinio' => [
			'start' => 38,
			'length' => 7,
			'formatter' => fn($code) => $code === '0000000' ? null : (int) $code,
		],

		// Total votantes CERE (residentes extranjeros)
		'Total votantes CERE' => [
			'start' => 45,
			'length' => 7,
			'formatter' => fn($code) => $code === '0000000' ? null : (int) $code,
		],

		// Votantes del primer avance de participación
		'Votantes del primer avance' => [
			'start' => 52,
			'length' => 7,
			'formatter' => fn($code) => $code === '0000000' ? null : (int) $code,
		],

		// Votantes del segundo avance de participación
		'Votantes del segundo avance' => [
			'start' => 59,
			'length' => 7,
			'formatter' => fn($code) => $code === '0000000' ? null : (int) $code,
		],

		// Votos en blanco
		'Votantes en blanco' => [
			'start' => 66,
			'length' => 7,
			'formatter' => fn($code) => (int) $code,
		],

		// Votos nulos
		'Votantes nulos' => [
			'start' => 73,
			'length' => 7,
			'formatter' => fn($code) => (int) $code,
		],

		// Votos a candidaturas
		'Votantes a candidaturas' => [
			'start' => 80,
			'length' => 7,
			'formatter' => fn($code) => (int) $code,
		],

		// Votos afirmativos en referéndum, o ceros en otros procesos electorales
		'Votos afirmativos' => [
			'start' => 87,
			'length' => 7,
			'formatter' => fn($code) => (int) $code ?: null,
		],

		// Votos negativos en referéndum, o ceros en otros procesos electorales
		'Votos negativos' => [
			'start' => 94,
			'length' => 7,
			'formatter' => fn($code) => (int) $code ?: null,
		],

		// Datos oficiales
		'Datos oficiales' => [
			'start' => 101,
			'length' => 1,
			'formatter' => fn($code) => [
				'S' => 'Sí',
				'N' => 'No',
			][$code],
		],
	],

	// Fichero de datos de candidaturas de mesas y del CERA
	'10' => [
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

		// Número de vuelta (en procesos a una sola vuelta = `1`)
		'Vuelta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => fn($code) => $code,
		],

		// Código de la comunidad autónoma. O `99` en el caso de total nacional del CERA.
		'Comunidad autónoma' => [
			'start' => 10,
			'length' => 2,
			'formatter' => fn($code) => $code === '99' ? null : AUTONOMIAS[$code],
		],

		// Código INE de la provincia. O `99` si son datos a nivel total autonómico
		// o nacional del CERA.
		'Provincia' => [
			'start' => 12,
			'length' => 2,
			'formatter' => fn($code) => $code === '99' ? null : PROVINCIAS[$code],
		],

		// Código INE del municipio. `999` = CERA.
		'Municipio' => [
			'start' => 14,
			'length' => 3,
			'formatter' => function($code, $line) {
				if ($code !== '999') {
					$provincia = substr($line, 11, 2);
					return MUNICIPIOS[$provincia . $code];
				}
			},
		],
		'CERA' => [
			'start' => 14,
			'length' => 3,
			'formatter' => function($code, $line) {
				if ($code === '999') {
					return 'Sí';
				}
			},
		],

		// Número de distrito municipal en su caso o `01` si el municipio no tiene distritos.
		// En el caso de datos procedentes del CERA, llevará el número del distrito electoral
		// a que correspondan, o `09` si el ámbito de dicho distrito coincide con el de la provincia.
		'Número de distrito' => [
			'start' => 17,
			'length' => 2,
			'formatter' => fn($code) => $code === '01' ? null : $code,
		],

		// Código de la sección (tres dígitos seguidos de un espacio, letra mayúscula u otro dígito)
		'Código de sección' => [
			'start' => 19,
			'length' => 4,
			'formatter' => fn($code) => $code === '0000' ? null : $code,
		],

		// Código de mesa (una letra mayúscula identificando la mesa o una `U` en caso de mesa única)
		'Código de mesa' => [
			'start' => 23,
			'length' => 1,
			'formatter' => fn($code) => $code === 'U' ? null : $code,
		],

		// Código de la candidatura o del senador
		'Código de candidatura' => [
			'start' => 24,
			'length' => 6,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				if ($proceso !== '03') {
					return $code;
				}
			}
		],
		'Distrito' => [
			'start' => 24,
			'length' => 6,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				if ($proceso === '03') {
					$provincia = substr($code, 0, 2);
					$distrito = substr($code, 2, 1);
					if ($distrito === '9') {
						return null;
					}
					return DISTRITOS[$proceso][$provincia][$distrito];
				}
			},
		],
		'Número de orden de senador' => [
			'start' => 24,
			'length' => 6,
			'formatter' => function($code, $line) {
				$proceso = substr($line, 0, 2);
				if ($proceso === '03') {
					return (int) substr($code, 3, 3);
				}
			},
		],

		// Votos obtenidos por la candidatura o el senador
		'Votos obtenidos' => [
			'start' => 30,
			'length' => 7,
			'formatter' => fn($code) => (int) $code,
		],
	],

	// Fichero de datos comunes en municipios menores de 250 habitantes.
	// Solo en elecciones municipales.
	'11' => [
		// Tipo de municipio
		'Tipo de municipio' => [
			'start' => 1,
			'length' => 2,
			'formatter' => function($code) {
				return [
					'08' => 'Entre 100 y 250 habitantes',
					'09' => 'Menos de 100 habitantes',
				][$code];
			},
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

		// Número de vuelta (en procesos a una sola vuelta = `1`)
		'Vuelta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => fn($code) => $code,
		],

		// Código de la comunidad autónoma
		'Comunidad autónoma' => [
			'start' => 10,
			'length' => 2,
			'formatter' => fn($code) => AUTONOMIAS[$code],
		],

		// Código INE de la provincia
		'Provincia' => [
			'start' => 12,
			'length' => 2,
			'formatter' => fn($code) => PROVINCIAS[$code],
		],

		// Código INE del municipio
		'Municipio' => [
			'start' => 14,
			'length' => 3,
			'formatter' => function($code, $line) {
				$provincia = substr($line, 11, 2);
				return MUNICIPIOS[$provincia . $code];
			},
		],

		// Nombre del municipio
		'Nombre del municipio' => [
			'start' => 17,
			'length' => 100,
			'formatter' => fn($code) => trim(utf8_encode($code)),
		],

		// Código del partido judicial
		'Partido judicial' => [
			'start' => 117,
			'length' => 3,
			'formatter' => fn($code) => $code,
		],

		// Código de la diputación provincial
		'Diputación provincial' => [
			'start' => 120,
			'length' => 3,
			'formatter' => fn($code) => $code,
		],

		// Código de la comarca
		'Comarca' => [
			'start' => 123,
			'length' => 3,
			'formatter' => fn($code) => $code,
		],

		// Población de derecho
		'Población de derecho' => [
			'start' => 126,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],

		// Número de mesas
		'Número de mesas' => [
			'start' => 129,
			'length' => 2,
			'formatter' => fn($code) => (int) $code,
		],

		// Censo del INE
		'Censo del INE' => [
			'start' => 131,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],

		// Censo de escrutinio
		'Censo de escrutinio' => [
			'start' => 134,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],

		// Censo CERE en escrutinio (residentes extranjeros)
		'Censo CERE en escrutinio' => [
			'start' => 137,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],

		// Total votantes CERE (residentes extranjeros)
		'Total votantes CERE' => [
			'start' => 140,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],

		// Votantes del primer avance de participación
		'Votantes del primer avance' => [
			'start' => 143,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],

		// Votantes del segundo avance de participación
		'Votantes del segundo avance' => [
			'start' => 146,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],

		// Votos en blanco
		'Votantes en blanco' => [
			'start' => 149,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],

		// Votos nulos
		'Votantes nulos' => [
			'start' => 152,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],

		// Votos a candidaturas
		'Votantes a candidaturas' => [
			'start' => 155,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],

		// Número de escaños a distribuir
		'Número de escaños' => [
			'start' => 158,
			'length' => 2,
			'formatter' => fn($code) => (int) $code ?: null,
		],

		// Datos oficiales
		'Datos oficiales' => [
			'start' => 160,
			'length' => 1,
			'formatter' => fn($code) => [
				'S' => 'Sí',
				'N' => 'No',
			][$code],
		],
	],

	// Fichero de datos de candidaturas de municipios menores de 250 habitantes.
	// Solo en elecciones municipales.
	'12' => [
		// Tipo de municipio
		'Tipo de municipio' => [
			'start' => 1,
			'length' => 2,
			'formatter' => function($code) {
				return [
					'08' => 'Entre 100 y 250 habitantes',
					'09' => 'Menos de 100 habitantes',
				][$code];
			},
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

		// Número de vuelta (en procesos a una sola vuelta = `1`)
		'Vuelta' => [
			'start' => 9,
			'length' => 1,
			'formatter' => fn($code) => $code,
		],

		// Código INE de la provincia
		'Provincia' => [
			'start' => 10,
			'length' => 2,
			'formatter' => fn($code) => PROVINCIAS[$code],
		],

		// Código INE del municipio
		'Municipio' => [
			'start' => 12,
			'length' => 3,
			'formatter' => function($code, $line) {
				$provincia = substr($line, 9, 2);
				return MUNICIPIOS[$provincia . $code];
			},
		],

		// Código de la candidatura
		'Código' => [
			'start' => 15,
			'length' => 6,
			'formatter' => fn($code) => $code,
		],

		// Votos obtenidos por la candidatura
		'Votos obtenidos' => [
			'start' => 21,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],

		// Número de candidatos obtenidos por la candidatura
		'Número de candidatos obtenidos' => [
			'start' => 24,
			'length' => 2,
			'formatter' => fn($code) => (int) $code,
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
				return [
					'M' => 'Hombre',
					'F' => 'Mujer',
				][$code];
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

		// Votos obtenidos por el candidato
		'Votos obtenidos' => [
			'start' => 120,
			'length' => 3,
			'formatter' => fn($code) => (int) $code,
		],

		// Candidato elegido (Si/No)
		'Elegido' => [
			'start' => 123,
			'length' => 1,
			'formatter' => function($code) {
				return [
					'S' => 'Sí',
					'N' => 'No',
				][$code];
			},
		],
	],
];
