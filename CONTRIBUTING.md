# Cómo contactar y participar en este proyecto

Ten en cuenta que este repositorio es un subproducto colateral de un proyecto más ambicioso que está en ciernes: la Chanchullopedia™. No obstante, y como en cualquier proyecto de software libre, son muy bienvenidas las contribuciones:

- Si detectas algún defecto o tienes alguna duda, comentario o petición, **puedes [abrir un issue aquí en Github](https://github.com/jaimeobregon/infoelectoral/issues)**.

- Siéntete libre de **[enviar pull requests con tus aportaciones](https://github.com/jaimeobregon/infoelectoral/pulls)**, pero antes de contribuir código, por favor abre un *issue* primero y comparte tus planes. Tengo una visión muy clara para este proyecto y sus objetivos, y además unos estándares elevados para mezclar (*merge*) contribuciones, así que poniendo previamente en común tus planes en un *issue* maximizaremos las posibilidades de que sea aceptada.

- Si quieres dirigirte específicamente a mí como promotor de este proyecto o de la Chanchullopedia™, **[envíame un tuit](https://twitter.com/JaimeObregon) público o privado** (mensaje directo). En general no suelo hacer mucho caso al correo electrónico así que por favor trata de no enviarme correo.

- Si deseas garantizar el futuro del proyecto y además que te informe directa y periódicamente de su desarrollo, [puedes **hacerte mecenas en Patreon**](https://www.patreon.com/jaime_gomez_obregon).

Dicho esto, mi idea es **articular una comunidad de desarrolladores** en torno a la idea de [dar más transparencia a la contratación del sector público en España](https://twitter.com/JaimeObregon/status/1284444424634871808). Al menos por el momento, planteo que esta actividad tenga su epicentro aquí en Github, y descarto abrir un Discord o similar [por varias razones](https://twitter.com/JaimeObregon/status/1281954005846024200).

Como otros muchos proyectos de software libre, este proyecto está presidido por su [**código de conducta**](/CODE_OF_CONDUCT.md).

# Aspectos técnicos

## La fiesta de los municipios

Los microdatos codifican numéricamente los municipios conforme el nomenclátor oficial del INE. Así, `Santander` recibe el código `39075`. Pero la tabla que relaciona el código de cada municipio con su nombre **cambia todos los años**.

Esto provoca **la fiesta de los municipios 🥳**: es preciso mantener tantas tablas como años hay desde 2001, y cargar la correspondiente al proceso electoral que se analiza. Este software lo hace automáticamente, pero documento aquí el proceso.

El INE publica la tabla de cada año en un documento de Excel que, a fecha de julio de 2020, puede descargarse de la página ["Relación de municipios y sus códigos por provincias"](https://www.ine.es/dyngs/INEbase/es/operacion.htm?c=Estadistica_C&cid=1254736177031&menu=ultiDatos&idp=1254734710990). Como es tedioso descargarlos todos, y por redundar estas tablas y que no se pierdan si el INE decide despublicarlas o romper el mencionado enlace, las he reflejado (*mirror*) en este repositorio. Las encontrarás en [`/assets/municipios`](/assets/municipios).

Pero si por motivos de auditoría u otras razones deseares descargar estos documentos de la fuente original, he compilado las direcciones de todos ellos en [`/assets/municipios.txt`](/assets/municipios.txt). Así puedes valerte, por ejemplo, de `wget -i municipios.txt` para descargar todos estos recursos de su fuente original.

Pero la fiesta de los municipios tiene su resaca. Y es que he tenido que transformar cada hoja de cálculo en una estructura de datos adaptada. Están todas en [`/src/includes/municipios/`](/src/includes/municipios/).

Por si fuera poco, los procesos electorales más antiguos referencian algunos municipios para los que el INE no publica ningún código. He tenido que identificarlos uno a uno y construir manualmente la tabla de correspondencias, que este software implementa.

## Registros corrompidos

Los registros publicados por el Ministerio no siempre cumplen la especificación técnica publicada por el propio Ministerio. Son pocos registros y casi siempre de procesos electorales antiguos (años 70 y 80), pero esto dispara una duda razonable: **¿cómo decodificar los registros que no se ciñen a la especificación?**.

En los casos en que ha sido posible, la mayoría, este software detecta y corrige los registros corrompidos. En los escasísimos casos en que esto no ha sido posible, he optado por simplemente omitir estos datos de la salida del programa.
