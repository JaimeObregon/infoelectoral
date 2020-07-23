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

/**
 * El INE proporciona tablas para decodificar los municipios desde 2001, pero los procesos
 * electorales anteriores hacen referencia a códigos que hay que decodificar de alguna manera,
 * pero no hay tablas.
 *
 * He construido manualmente dicha correspondencia escudriñando la web oficial de la AEMET,
 * que sí parece decodificar correctamente los códigos que a mí aquí me faltan. Lo he hecho
 * alterando sucesivamente el ID que aparece en esta URL:
 *
 * http://www.aemet.es/es/eltiempo/widgets/municipios/benahadux-09186
 *
 * Los municipios que tampoco existen en la web de AEMET los he correspondido con `null`.
 */
const MUNICIPIOS_INEXISTENTES = [
	'01012' => null,
	'01015' => null,
	'01026' => null,
	'01029' => null,
	'01045' => null,
	'01048' => null,
	'04025' => 'Alboloduy',
	'04039' => null,
	'04040' => 'Alcóntar',
	'04042' => null,
	'04904' => 'Balanegra',
	'05003' => 'Adanero',
	'05004' => null,
	'05028' => null,
	'05050' => null,
	'05068' => null,
	'05146' => null,
	'05223' => null,
	'05248' => null,
	'05250' => null,
	'05255' => 'Gutierre-Muñoz',
	'05268' => null,
	'06903' => 'Guadiana del Caudillo',
	'08173' => null,
	'09004' => 'Abajas',
	'09008' => null,
	'09031' => null,
	'09049' => null,
	'09053' => null,
	'09069' => null,
	'09080' => 'Barrio de Muñó',
	'09081' => null,
	'09092' => 'Belorado',
	'09116' => 'Cabañes de Esgueva',
	'09126' => 'Campolara',
	'09145' => null,
	'09150' => 'Cascajares de la Sierra',
	'09153' => null,
	'09158' => 'Castil de Peones',
	'09171' => null,
	'09186' => 'Cerezo de Río Tirón',
	'09187' => null,
	'09188' => null,
	'09193' => null,
	'09245' => null,
	'09260' => 'Fuentemolinos',
	'09263' => null,
	'09278' => 'Grijalba',
	'09284' => 'Gumiel de Izán',
	'09285' => null,
	'09286' => 'Gumiel de Mercado',
	'09290' => 'Hacinas',
	'09296' => 'Hontanas',
	'09333' => null,
	'09336' => 'Iglesias',
	'09341' => null,
	'09344' => 'Jaramillo Quemado',
	'09364' => 'Llano de Bureba',
	'09367' => null,
	'09402' => 'Milagros',
	'09420' => 'Montorio',
	'09436' => 'Olmillos de Muñó',
	'09453' => null,
	'09474' => 'Pedrosa del Páramo',
	'09475' => null,
	'10902' => 'Vegaviana',
	'10903' => 'Alagón del Río',
	'10904' => 'Tiétar',
	'10905' => 'Pueblonuevo de Miramontes',
	'11903' => null,
	'12019' => null,
	'12030' => 'Alcudia de Veo',
	'12047' => null,
	'12062' => null,
	'12066' => null,
	'13099' => null,
	'14901' => null,
	'14902' => null,
	'15902' => 'Oza-Cesuras',
	'16076' => 'Altarejos',
	'16201' => null,
	'16252' => 'Casasimarro',
	'16260' => 'Castillejo de Iniesta',
	'16907' => null,
	'17072' => 'Besalú',
	'17122' => null,
	'17131' => null,
	'17235' => null,
	'18019' => null,
	'18026' => null,
	'18065' => 'Dehesas Viejas',
	'18077' => null,
	'18106' => 'Játar',
	'18156' => null,
	'18166' => null,
	'18914' => 'Valderrubio',
	'18915' => 'Domingo Pérez de Granada',
	'18916' => null,
	'19012' => 'Alaminos',
	'19137' => null,
	'19253' => null,
	'19276' => 'Escariche',
	'19315' => 'Fuentenovilla',
	'21902' => null,
	'22005' => null,
	'22038' => null,
	'22121' => null,
	'22138' => null,
	'22219' => null,
	'23905' => 'Arroyo del Ojanco',
	'24013' => null,
	'24048' => 'Barrios de Luna, Los',
	'24072' => 'Bercianos del Real Camino',
	'24075' => null,
	'24085' => null,
	'24111' => null,
	'24128' => 'Campazas',
	'24138' => null,
	'24186' => null,
	'24195' => null,
	'24204' => 'Cebrones del Río',
	'24220' => 'Congosto',
	'25106' => null,
	'25229' => null,
	'26116' => null,
	'26156' => null,
	'27036' => null,
	'28913' => null,
	'29902' => 'Villanueva de la Concepción',
	'29903' => 'Montecorto',
	'29904' => 'Serrato',
	'34065' => null,
	'34085' => null,
	'34111' => null,
	'34128' => 'Calahorra de Boedo',
	'34226' => null,
	'36902' => 'Cerdedo-Cotobade',
	'37084' => 'Barceo',
	'37093' => null,
	'37220' => 'Encinas de Arriba',
	'38901' => 'Pinar de El Hierro, El',
	'40011' => null,
	'40027' => null,
	'40096' => 'Basardilla',
	'40116' => 'Bernuy de Porreros',
	'40133' => null,
	'40137' => null,
	'40147' => null,
	'40169' => null,
	'40175' => null,
	'40187' => null,
	'40209' => null,
	'40217' => null,
	'40226' => 'Cozuelos de Fuentidueña',
	'41904' => null,
	'42138' => null,
	'43907' => 'Canonja, La',
	'44140' => 'Beceite',
	'44202' => null,
	'46904' => 'Benicull de Xúquer',
	'47072' => 'Bercero',
	'47107' => null,
	'47136' => 'Canalejas de Peñafiel',
	'47202' => null,
	'48915' => 'Ziortza-Bolibar',
	'49074' => null,
	'49217' => null,
	'50903' => 'Villamayor de Gállego',
];
