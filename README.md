# infoelectoral

[![AGPL License](https://img.shields.io/badge/license-AGPL-blue.svg)](http://www.gnu.org/licenses/agpl-3.0)
<span class="badge-patreon"><a href="https://patreon.com/jaime_gomez_obregon" title="Apoya este proyecto en Patreon"><img src="https://img.shields.io/badge/patreon-donate-yellow.svg" alt="Botón para donar en Patreon" /></a></span>

Intérprete de microdatos electorales del Ministerio del Interior español.

Este repositorio refleja (*mirror*), reúne y simplifica el acceso a los datos de los procesos electorales en España. Es parte de [la Chanchullopedia™](https://twitter.com/JaimeObregon/status/1274331563254259713), un proyecto personal de Jaime Gómez-Obregón que busca [cruzar las adjudicaciones de contratos del sector público español con las listas electorales](https://twitter.com/JaimeObregon/status/1273814894840856576) para aflorar y exponer [chanchullos con dinero público](https://twitter.com/JaimeObregon/status/1271790012464599040).

# Qué es esto

El Ministerio del Interior español está a cargo de los procesos electorales de ámbito estatal en España. Y publica no solo los resultados electorales detallados sino además otra mucha información adicional entre la que **las listas electorales** me parecen particularmente interesantes para los objetivos de la Chanchullopedia™.

Estas listas reflejan **la composición de las candidaturas electorales a todos los comicios** europeos, estatales (Congreso y Senado) y municipales, incluyendo los cabildos canarios. También aparecen datos complementarios detallados de los cuatro referéndums celebrados desde 1976. Se trata, en definitiva, de un conjunto de datos de un elevado valor investigativo e histórico que comprende miles de agrupaciones electorales y el nombre de cientos de miles de candidatos.

> :warning: El Ministerio **no publica datos de las elecciones autonómicas**, [pero **hay una tediosa solución**](#las-elecciones-autonómicas).

**La información publicada por el Ministerio no puede ser consumida directamente**: es preciso interpretarla con un software desarrollado *ad hoc* y que implemente la especificación técnica de los particulares formatos informáticos en que las autoridades electorales españolas codifican la información.

El objetivo de este repositorio es:

1. **Alojar el desarrollo de este software** para que cualquier interesado pueda explorar los microdatos de las listas electorales.

2. **Redundar aquí en Github los datos oficiales** publicados por el Ministerio del Interior para que su existencia no dependa de un único origen y esté efectivamente distribuida en la red.

3. **Racionalizar la forma de presentación de estos datos para que sea más fácil trabajar con ellos** desde un punto de vista informático, por supuesto sin alterarlos ni desnaturalizarlos de ninguna manera.

A mayores, mi idea es elaborar después **una API que alimente la Chanchullopedia™** y desarrollar **un portal web para explorar las listas electorales** españolas desde la restauración del sistema democrático.

# Los datos oficiales

A fecha de creación de este proyecto (julio de 2020), [la fuente oficial](https://en.wikipedia.org/wiki/Single_source_of_truth) de los datos es el área de descargas del portal de información electoral de la Dirección General de Política Interior del Ministerio del Interior del Gobierno de España:

    http://www.infoelectoral.mir.es/infoelectoral/min/areaDescarga.html

| Descarga de datos del portal oficial | Metodología y fuentes |
| ------------------------------------ | --------------------- |
| ![Captura de pantalla de la sección de descarga de datos del portal oficial en julio de 2020](/assets/portal-oficial.png) | ![Captura de pantalla de la sección de metodología y fuentes en julio de 2020](/assets/metodologia-y-fuentes.png) |

## Descarga inicial de los datos oficiales

La descarga inicial manual de todos los ficheros es tediosa porque se hace preciso cumplimentar iterativamente los desplegables `Elección` (proceso electoral) y `Fecha` (convocatoria) así como descargar y descomprimir uno a uno sucesivamente cada uno de los 161 ficheros históricos existentes ahora mismo.

Para evitarte este tedioso trabajo manual, este repositorio reúne ya **una copia descargada y descomprimida de todos estos ficheros oficiales**. No obstante, y si por razones de auditoría u otros motivos deseares descargar los datos de la fuente original, he compilado la relación de recursos descargables en los siguientes ficheros:

- [`congreso.txt`](/assets/congreso.txt)
- [`senado.txt`](/assets/senado.txt)
- [`europeas.txt`](/assets/europeas.txt)
- [`municipales.txt`](/assets/municipales.txt)
- [`cabildos.txt`](/assets/cabildos.txt)
- [`referendums.txt`](/assets/referendums.txt)

Así, por ejemplo puedes valerte de `wget -i municipales.txt` para descargar todos los ficheros oficiales de todas las elecciones municipales.

## ¿Qué posprocesado he hecho aquí con los datos oficiales?

En [el directorio `/files`](/files) de este repositorio he posprocesado cada fichero `.zip` descargado de la fuente oficial. Este posprocesado no altera ni desnaturaliza los datos:

1. Cada fichero se ha descomprimido, preservando su nombre de fichero, en el subdirectorio correspondiente al tipo de proceso electoral al que pertenece. Por ejemplo, `04199105_TOTA.zip` se ha descomprimido en `municipales/04199105_TOTA`.

2. Los ficheros `FICHEROS.DOC` y `FICHEROS.rtf` que el Ministerio incluye en cada uno de los ficheros `.zip` han sido eliminados de cada subdirectorio descomprimido tras comprobar que son exactamente los mismos ficheros en todos y cada uno de los ficheros `.zip`. Como además `FICHEROS.DOC` y `FICHEROS.rtf` son exactamente el mismo documento en dos formatos diferentes, he eliminado el segundo y dejado una única copia del primero que puede encontrarse en [`/files`](/files).

# Las elecciones autonómicas

Los ficheros oficiales aquí trabajados omiten las elecciones autonómicas. He escrito al Ministerio para solicitar estos registros, pero lógicamente *no ha colado*. He aquí su respuesta:

> Los resultados de las elecciones de ámbito autonómico, así como su convocatoria, son competencia de cada una de las Comunidades Autónomas, a las que deberá dirigirse para obtener la información solicitada.
>
> [En este enlace tiene la dirección de las distintas Comunidades Autónomas](https://administracion.gob.es/pagFront/espanaAdmon/directorioOrganigramas/comunidadesAutonomas/comunidadesAutonomas.htm#.Xx_aF9Kqljo).
>
> — Ministerio del Interior

Hay un debate sobre cómo circunvalar este obstáculo en [*#2: ¿Tiene sentido incorporar las elecciones autonómicas?*](https://github.com/JaimeObregon/infoelectoral/issues/2). La alternativa a este esfuerzo es, por supuesto, simplemente prescindir de los datos de las elecciones autonómicas.

# Requisitos

El intérprete está escrito en PHP, del que se requiere al menos la versión 7.4. No hay otras dependencias.

# Cómo se usa

Desde línea de comandos, lanza [`parse.php`](src/parse.php) con el fichero `.DAT` a interpretar como único argumento. Por ejemplo:

```console
$ php src/parse.php files/congreso/02201904_MESA/04021904.DAT
```

Ello devolverá por `stdout` la estructura de datos del fichero decodificada, en un formato legible por humanos.

Para exportar las listas electorales de un proceso electoral en formato CSV por `stdout`, invoca [`list.php`](src/list.php) con dos argumentos: el primero el fichero con las candidaturas (`03*.DAT`) y el segundo el que contiene los candidatos (`04*.DAT`). Por ejemplo:

```console
$ php src/list.php files/municipales/04201905_MUNI/03041905.DAT files/municipales/04201905_MUNI/04041905.DAT
```

Ni que decir tiene que ambos ficheros han de pertenecer al mismo proceso electoral.

# Cómo contactarme, plantear dudas o contribuir

Tanto si deseas **contribuir a este proyecto** como simplemente **plantear una duda, hacer una petición o contactarme**, por favor lee detenidamente las [pautas para participar](/CONTRIBUTING.md), que contienen además algunos detalles técnicos relevantes.

Como otros muchos proyectos de software libre, este proyecto está presidido por su [**código de conducta**](/CODE_OF_CONDUCT.md).

# Agradecimientos

Este proyecto es posible gracias al micromecenazgo (*crowdfunding*) de varios cientos de personas que con su generoso apoyo están haciendo posible **que desarrolle herramientas digitales para dar más transparencia a las cosas del sector público en España**.

Gracias a este apoyo económico puedo volcarme en esta misión a jornada completa y de manera independiente. Publicaré el nombre (o, para quien lo prefiera, el pseudónimo) de todos estos valientes colaboradores en la página de agradecimientos del portal web que desarrollaré para la Chanchullopedia™ 😊.

**Si deseas sumarte a esta iniciativa de la sociedad civil para dar más transparencia a la contratación del sector público en España**, puedes consultar los detalles en [patreon.com/jaime_gomez_obregon](https://www.patreon.com/jaime_gomez_obregon).

# Información legal

A la fecha de desarrollo de este proyecto estos son los términos legales para la reutilización de la información existente en el portal institucional del Ministerio del Interior.

| Aviso legal del Ministerio del Interior | Aviso legal de `datos.gob.es` a que refiere el Ministerio |
| --------------------------------------- | ------------------------------------------------------- |
| ![Captura de pantalla del aviso legal del Ministerio del Interior](/assets/aviso-legal-ministerio.png) | ![Captura de pantalla del aviso legal de datos.gob.es a que refiere el Ministerio](/assets/aviso-legal-datos.png) |

## Protección de datos personales

Este software habilita la decodificación de los microdatos oficiales que comprenden las listas electorales en las que han concurrido cientos de miles de candidatos desde la restauración democrática en España.

De esta decodificación pueden deducirse simplemente listas que relacionen nombres de personas con los distintos partidos políticos en los que han militado o concurrido a elecciones. Esto podría asemejarse a un fichero de datos personales de naturaleza ideológica, y estar por lo tanto protegido por legislación específica que impediría el tratamiento que se podría llevar a cabo con el programa informático de este repositorio.

Pero la Agencia Española de Protección de Datos, en su Resolución de 17 de julio de 2013, apartado séptimo, recuerda la jurisprudencia constitucional al respecto (la negrita es mía):

> En relación a los responsables de fichero respecto de los que se solicita el derecho de oposición debe tenerse en cuenta la STC 110/2007, de 10 de mayo, que recuerda la STC 85/2003 en la que se señaló que "las informaciones protegidas frente a una publicidad no querida por el art. 18.1 CE se corresponden con los aspectos más básicos de la autodeterminación personal y es obvio que entre aquellos aspectos básicos no se encuentran los datos referentes a la participación de los ciudadanos en la vida política, actividad que por su propia naturaleza se desarrolla en la esfera pública de una sociedad democrática, con excepción del derecho de sufragio activo dado el carácter secreto del voto. De esta manera, el ejercicio del derecho de participación política (art. 23.1 CE) implica en general la renuncia a mantener ese aspecto de la vida personal alejada del público conocimiento.

> A ello debe añadirse el carácter público que la legislación electoral atribuye a determinadas actuaciones de los ciudadanos en los procesos electorales, en concreto, la publicación de las candidaturas presentadas y proclamadas en las elecciones, que se efectúa, para las municipales, en el Boletín Oficial de la Provincia (arts. 47 y 187.4 LOREG); y la publicación de los electos, que se efectúa, para todo tipo de elecciones, en el Boletín Oficial del Estado (art. 108.6 LOREG). Estas normas que prescriben la publicidad de candidatos proclamados y electos son, por otra parte, básicas para la transparencia política que en un Estado democrático debe regir las relaciones entre electores y elegibles". (F. 21). En esta misma resolución rechazamos igualmente que pudiera "considerarse vulnerado el derecho fundamental a la protección de datos (art. 18.4 CE), que faculta a los ciudadanos para oponerse a que determinados datos personales sean utilizados para fines distintos de aquel legítimo que justificó su obtención (STC 94/1988, de 24 de mayo, F. 4). Tal derecho persigue garantizar a las personas un poder de control sobre sus datos personales, sobre su uso y su destino, con el propósito de impedir su tráfico ilícito y lesivo para la dignidad y derecho del afectado (STC 292/2000, de 30 de noviembre, F. 6). Pero ese poder de disposición no puede pretenderse con respecto al único dato relevante en este caso, a saber, la vinculación política de aquellos que concurren como candidatos a un proceso electoral pues, como hemos dicho, se trata de datos publicados a los que puede acceder cualquier ciudadano y que por tanto quedan fuera del control de las personas a las que se refieren. **La adscripción política de un candidato es y debe ser un dato público en una sociedad democrática, y por ello no puede reclamarse sobre él ningún poder de disposición**" (F. 12). En términos análogos, se han pronunciado las SSTC 99/2004, F. 13, y 68/2005, F. 15.

# Licencia de este repositorio

<strong>El *copyright* de este proyecto pertenece a Jaime Gómez-Obregón</strong>, quien lo distribuye como software libre y de código abierto bajo los términos de la licencia GNU Affero General Public License versión 3 y posteriores.

Sin perjuicio de lo especificado en el texto de la licencia, puedes modificar, distribuir y utilizar este proyecto, incluso con fines comerciales, siempre y cuando cites mi *copyright*, mantengas este aviso y publiques el código fuente de tus modificaciones.

## Licencia de los datos

El origen de los datos aquí reutilizados es el Ministerio del Interior del Gobierno de España. La carga inicial de datos se realizó en junio de 2020 y la he actualizado con el volcado de datos electorales de 2019 que el Ministerio realizó en julio. Mi idea es mantener este repositorio actualizado con los datos que sean publicados posteriormente.

El Ministerio del Interior no participa, patrocina ni necesariamente apoya la reutilización de datos que aquí realizo ni los objetivos que con ella persigo.

## Apéndice conforme la licencia GNU AGPL

`infoelectoral`, intérprete de microdatos electorales del Ministerio del Interior español\
Copyright (C) 2020 Jaime Gómez-Obregón

Este repositorio es software libre: puedes redistribuirlo y/o modificarlo bajo los términos
de la GNU Affero General Public License versión 3 y posteriores, publicada por la Free Software Foundation.

Este programa se distribuye con la esperanza de ser útil, pero **sin garantía alguna**; incluso sin la garantía implícita de que pueda ser **comercializable** o **válido para un propósito concreto**. Para más detalles lee la [licencia GNU Affero General Public License](/LICENSE).

Con este programa recibes una copia de dicha licencia, pero en todo caso puedes leerla en [`https://www.gnu.org/licenses/`](https://www.gnu.org/licenses/).
