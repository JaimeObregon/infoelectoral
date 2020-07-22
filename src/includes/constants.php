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
 * Definición de constantes según la especificación oficial del Ministerio del Interior.
 * Véase documento `FICHEROS.doc`
 */

/**
 * Códigos de las Comunidades Autónomas, tomados de la especificación.
 */
const AUTONOMIAS = [
	'01' => 'Andalucía',
	'02' => 'Aragón',
	'03' => 'Asturias',
	'04' => 'Baleares',
	'05' => 'Canarias',
	'06' => 'Cantabria',
	'07' => 'Castilla La Mancha',
	'08' => 'Castilla y León',
	'09' => 'Cataluña',
	'10' => 'Extremadura',
	'11' => 'Galicia',
	'12' => 'Madrid',
	'13' => 'Navarra',
	'14' => 'País Vasco',
	'15' => 'Murcia',
	'16' => 'La Rioja',
	'17' => 'Comunidad Valenciana',
	'18' => 'Ceuta',
	'19' => 'Melilla',
];

/**
 * Relación de códigos de provincias españolas.
 *
 * La especificación remite al INE, que es de donde he tomado los datos:
 * https://www.ine.es/daco/daco42/codmun/cod_provincia_estandar.htm
 *
 * He decidido adaptar la grafía de algunas provincias para adaptarla a lo que entiendo que son
 * los nombres esperados por un lector castellanohablante. Por ejemplo, `Valencia` en lugar de
 * `València` o `Baleares` en vez de `Illes Balears.
 *
 * La solución políticamente correcta es tomar los nombres oficiales, pero estos datos alimentarán
 * un portal web presentado en idioma español y se me hace forzado informar de `Gipuzkoa` o
 * `Alacant` en lugar de `Guipúzcoa` y `Alicante`. Ello sin prejuicio de que he mantenido
 * por ejemplo `A Coruña` o `Girona` porque no me suenan tan extrañas.
 *
 * TL;DR: como esto es el debate ibérico por antonomasia, he hecho lo que me da la gana :-)
 */
const PROVINCIAS = [
	'01' => 'Álava',
	'02' => 'Albacete',
	'03' => 'Alicante',
	'04' => 'Almería',
	'05' => 'Ávila',
	'06' => 'Badajoz',
	'07' => 'Baleares',
	'08' => 'Barcelona',
	'09' => 'Burgos',
	'10' => 'Cáceres',
	'11' => 'Cádiz',
	'12' => 'Castellón',
	'13' => 'Ciudad Real',
	'14' => 'Córdoba',
	'15' => 'A Coruña',
	'16' => 'Cuenca',
	'17' => 'Girona',
	'18' => 'Granada',
	'19' => 'Guadalajara',
	'20' => 'Guipúzcoa',
	'21' => 'Huelva',
	'22' => 'Huesca',
	'23' => 'Jaén',
	'24' => 'León',
	'25' => 'Lleida',
	'26' => 'La Rioja',
	'27' => 'Lugo',
	'28' => 'Madrid',
	'29' => 'Málaga',
	'30' => 'Murcia',
	'31' => 'Navarra',
	'32' => 'Ourense',
	'33' => 'Asturias',
	'34' => 'Palencia',
	'35' => 'Las Palmas',
	'36' => 'Pontevedra',
	'37' => 'Salamanca',
	'38' => 'Santa Cruz de Tenerife',
	'39' => 'Cantabria',
	'40' => 'Segovia',
	'41' => 'Sevilla',
	'42' => 'Soria',
	'43' => 'Tarragona',
	'44' => 'Teruel',
	'45' => 'Toledo',
	'46' => 'Valencia',
	'47' => 'Valladolid',
	'48' => 'Vizcaya',
	'49' => 'Zamora',
	'50' => 'Zaragoza',
	'51' => 'Ceuta',
	'52' => 'Melilla',
];

/**
 * Códigos identificativos de los tipos de ficheros, según la especificación
 */
const FICHEROS = [
	'01' => 'Control',
	'02' => 'Identificación del proceso electoral',
	'03' => 'Candidaturas',
	'04' => 'Candidatos',
	'05' => 'Datos globales de ámbito municipal',
	'06' => 'Datos de candidaturas de ámbito municipal',
	'07' => 'Datos globales de ámbito superior al municipio',
	'08' => 'Datos de candidaturas de ámbito superior al municipio',
	'09' => 'Datos globales de mesas',
	'10' => 'Datos de candidaturas de mesas',
	'11' => 'Datos globales de municipios menores de 250 habitantes (en elecciones municipales)',
	'12' => 'Datos de candidaturas de municipios menores de 250 habitantes (en elecciones municipales)',
];

/**
 * Tipos de procesos electorales, según la especificación
 */
const PROCESOS = [
	'01' => 'Referéndum',
	'02' => 'Congreso',
	'03' => 'Senado',
	'04' => 'Municipales',
	'05' => 'Autonómicas',
	'06' => 'Cabildos',
	'07' => 'Parlamento Europeo',
	'10' => 'Partidos judiciales y diputaciones provinciales',
	'15' => 'Juntas Generales',
];

/**
 * Distritos electorales en función del tipo de elección, según la especificación.
 *
 * El primer nivel es el tipo de proceso electoral (`PROCESOS`) y
 * el segundo nivel es la provincia (`PROVINCIAS`)
 */
const DISTRITOS = [
	'03' => [
		'07' => [
			'1' => 'Mallorca',
			'2' => 'Menorca',
			'3' => 'Ibiza-Formentera',
		],
		'35' => [
			'1' => 'Gran Canaria',
			'2' => 'Lanzarote',
			'3' => 'Fuerteventura',
		],
		'38' => [
			'4' => 'Tenerife',
			'5' => 'La Palma',
			'6' => 'La Gomera',
			'7' => 'El Hierro',
		],
	],
	'05' => [
		'07' => [
			'1' => 'Mallorca',
			'2' => 'Menorca',
			'3' => 'Ibiza',
			'4' => 'Formentera',
		],
		'30' => [
			'1' => 'Primera',
			'2' => 'Segunda',
			'3' => 'Tercera',
			'4' => 'Cuarta',
			'5' => 'Quinta',
		],
		'33' => [
			'1' => 'Oriente',
			'2' => 'Centro',
			'3' => 'Occidente',
		],
		'35' => [
			'1' => 'Gran Canaria',
			'2' => 'Lanzarote',
			'3' => 'Fuerteventura',
		],
		'38' => [
			'4' => 'Tenerife',
			'5' => 'La Palma',
			'6' => 'La Gomera',
			'7' => 'El Hierro',
		],
	],
	'06' => [
		'35' => [
			'1' => 'Gran Canaria',
			'2' => 'Lanzarote',
			'3' => 'Fuerteventura',
		],
		'38' => [
			'4' => 'Tenerife',
			'5' => 'La Palmaa',
			'6' => 'La Gomera',
			'7' => 'El Hierro',
		],
	],
	'15' => [
		'01' => [
			'1' => 'Vitoria-Gasteiz',
			'2' => 'Aira-Ayala',
			'3' => 'Resto',
		],
		'20' => [
			'1' => 'Deba-Urola',
			'2' => 'Bidasoa-Oyarzun',
			'3' => 'Donostialdea',
			'4' => 'Oria',
		],
		'48' => [
			'1' => 'Bilbao',
			'2' => 'Encartaciones',
			'3' => 'Durango-Arratia',
			'4' => 'Busturia-Uribe',
		],
	],
];
