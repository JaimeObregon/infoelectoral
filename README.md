# infoelectoral

Intérprete de candidaturas electorales del Ministerio del Interior español.

Este repositorio refleja (*mirror*), reúne y simplifica el acceso a los datos de los procesos electorales en España. Es parte de [la Chanchullopedia™](https://twitter.com/JaimeObregon/status/1274331563254259713), un proyecto personal de Jaime Gómez-Obregón que busca [cruzar las adjudicaciones de contratos del sector público español con las listas electorales](https://twitter.com/JaimeObregon/status/1273814894840856576) para aflorar y exponer [chanchullos con dinero público](https://twitter.com/JaimeObregon/status/1271790012464599040).

# Qué es esto

El Ministerio del Interior español está a cargo de los procesos electorales en España. Y publica no solo los resultados electorales detallados sino además otra mucha información adicional entre la que me parecen particularmente interesantes para los objetivos de la Chanchullopedia **las listas electorales**.

Estas listas reflejan **la composición de las candidaturas electorales a todos los comicios** europeos, estatales (Congreso y Senado), autonómicos y municipales, incluyendo los cabildos canarios. Se trata, en definitiva, de un conjunto de datos de un elevado valor investigativo e histórico que comprende miles de agrupaciones electorales y el nombre de cientos de miles de candidatos.

**La información publicada por el Ministerio no puede ser consumida directamente**: es preciso interpretarla con un software desarrollado ad hoc y que implemente la especificación técnica de los particulares formatos informáticos en que las autoridades electorales españolas codifican la información.

El objetivo de este repositorio es:

1. **Alojar el desarrollo de este software** para que cualquier interesado pueda explorar los microdatos de las listas electorales.

2. **Redundar aquí en Github los datos oficiales** publicados por el Ministerio del Interior para que su existencia no dependa de un único origen y esté efectivamente distribuida en la red.

3. **Racionalizar la forma de presentación de estos datos para que sea más fácil trabajar con ellos**, por supuesto sin alterarlos ni desnaturalizarlos.

A mayores, mi idea es **elaborar una API que alimente la Chanchullopedia™ y desarrollar una herramienta web para explorar las listas electorales** españolas desde la restauración del sistema democrático.

# Los datos oficiales

A fecha de creación de este proyecto (julio de 2020), [la fuente oficial](https://en.wikipedia.org/wiki/Single_source_of_truth) de los datos es el área de descargas del portal de información electoral de la Dirección General de Política Interior del Ministerio del Interior del Gobierno de España:

    [http://www.infoelectoral.mir.es/infoelectoral/min/areaDescarga.html](http://www.infoelectoral.mir.es/infoelectoral/min/areaDescarga.html)

![Captura de pantalla de la sección de descarga de datos del portal oficial en julio de 2020](/assets/portal-oficial.png)

## Descarga inicial de los datos oficiales

La descarga inicial manual de todos los ficheros es tediosa porque se hace preciso cumplimentar iterativamente los desplegables `Elección` (proceso electoral) y `Fecha` así como descargar uno a uno sucesivamente y descomprimir cada uno de los 161 ficheros históricos existentes.

Para evitarte esta tediosa descarga manual, este repositorio reúne ya una copia descargada y descomprimida de todos estos ficheros oficiales. No obstante, y por si por razones de auditoría u otros motivos deseas descargar los datos de la fuente original, he compilado la relación de recursos descargables en los siguientes ficheros:

- [Congreso](/assets/congreso.txt)
- [Senado](/assets/senado.txt)
- [Parlamento Europeo](/assets/europeas.txt)
- [Municipales](/assets/municipales.txt)
- [Cabildos](/assets/cabildos.txt)
- [Referéndums](/assets/referendums.txt)

Así, por ejemplo puedes valerte de `wget -i municipales.txt` para descargar los datos oficiales de todas las elecciones municipales.

# Agradecimientos

Este proyecto es posible gracias al micromecenazgo (*crowdfunding*) de varios cientos de personas que con su generoso apoyo están haciendo posible **que desarrolle herramientas digitales para dar más transparencia a las cosas del sector público en España**. Gracias a este apoyo económico puedo volcarme en esta misión a jornada completa y de manera independiente.

Puedes leer los detalles y **sumarte a esta iniciativa de la sociedad civil** en [patreon.com/jaime_gomez_obregon](https://www.patreon.com/jaime_gomez_obregon).

# Información legal

A la fecha de desarrollo de este proyecto estos son los términos legales para la reutilización de la información en el portal institucional del Ministerio del Interior.

| Aviso legal del Ministerio del Interior | Aviso legal de datos.gob.es a que refiere el Ministerio |
| --------------------------------------- | ------------------------------------------------------- |
| ![Captura de pantalla del aviso legal del Ministerio del Interior](/assets/aviso-legal-ministerio.png) | ![Captura de pantalla del aviso legal de datos.gob.es a que refiere el Ministerio](/assets/aviso-legal-datos.png) |


# Licencia de este repositorio

<strong>El *copyright* de este proyecto pertenece a Jaime Gómez-Obregón</strong>, quien lo distribuye como software libre bajo los términos de la licencia GNU Affero General Public License versión 3 y posteriores.

Sin perjuicio de lo especificado en el texto de la licencia, puedes modificar, distribuir y utilizar este proyecto, incluso con fines comerciales, siempre y cuando cites mi *copyright*, mantengas este aviso y publiques el código fuente de tus modificaciones.

## Licencia de los datos

El origen de los datos aquí reutilizados es el Ministerio del Interior del Gobierno de España. La carga inicial de datos se ha realizado en junio de 2020, si bien pretendo mantener este repositorio actualizado con los datos que sean publicados posteriormente.

El Ministerio del Interior no participa, patrocina ni necesariamente apoya la reutilización de datos que aquí realizo ni los objetivos que con ella persigo.

## Apéndice conforme la licencia GNU AGPL

infoelectoral, intérprete de candidaturas electorales del Ministerio del Interior español
Copyright (C) 2020 Jaime Gómez-Obregón

Este repositorio es software libre: puedes redistribuirlo y/o modificarlo bajo los términos
de la GNU Affero General Public License versiónn 3 y posteriores, publicada por la Free Software Foundation.

Este programa se distribuye con la esperanza de ser útil, pero **sin garantía alguna**; incluso sin la garantía implícita de que pueda ser **comercializable** o **válido para un propósito concreto**. Para más detalles lee laa licencia GNU Affero General Public License.

Con este programa recibes una copia de dicha licencia, pero en todo caso puedes leerla en [https://www.gnu.org/licenses/](https://www.gnu.org/licenses/).
