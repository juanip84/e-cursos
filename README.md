# e-cursos
E-Cursos es una plataforma para e-learning interno en empresas, sin embargo la misma fue desarrollada como un producto.
Es decir una instalación de la plataforma (en un hosting propio) puede albergar muchas empresas, a las cuales se les brinda 
el servicio, por el cual la empresa no necesitará instalar nada.

Para entender un poco más del funcionamiento y características ingresar a www.e-cursos.com.ar.
En poco tiempo tendremos online datos demo para que puedan ingresar a ver la plataforma y familiarizarse
sin tener que descargar e instalar localmente.

——————————————————————————————————————————————————————
Instalación BD inicial
——————————————————————————————————————————————————————
Ejecutar el script bd_inicial.sql en la carpeta BD en mysql, 
el mismo creara la BD, un usuario de BD y las tablas para la empresa “demo”.

Para loguearse en el sistema (localmente o en el dominio instalado) y probarlo 
debe ingresar con los  siguientes datos:

usuario: demo1
clave: 12345
empresa: demo


——————————————————————————————————————————————————————
Cambios para envío de mails (alta usuario, feedback, asignación cursos)
——————————————————————————————————————————————————————

Es necesario modificar la dirección de mail desde la cual se envían las notificaciones ya que por ejemplo al realizar el alta de un usuario se envia por mail la información con una clave random.
A su vez se envían notificaciones al autor de un curso cuando recibe feedback, o a un usuario cuando se le asigna un curso.

- En clase Application (application-controllers) modificar función generic_email setear dirección de mail valida para el dominio donde se instala la plataforma.


——————————————————————————————————————————————————————
Cambios en archivos js por url del dominio hardcodeada
——————————————————————————————————————————————————————

Reemplazar en:

- datos_usuario.js
- main.js
- init.js

En todas las url donde figure localhost/empresas-dev/ por el dominio donde esta instalado.
Ej en el caso del dominio de ecursos, se reemplazaría localhost/empresas-dev/ por www.e-cursos.com.ar/

——————————————————————————————————————————————————————
Configuración BD y dominio (si corresponde)
——————————————————————————————————————————————————————

En caso de ser necesario deberá configurar los archivos 
config.php y database.php dentro de application-config, 
con los datos pertinentes.

——————————————————————————————————————————————————————
Alta de una nueva empresa en la plataforma
——————————————————————————————————————————————————————

El alta de una nueva empresa y su usuario inicial (administrador)
es un proceso manual, luego la misma podrá ingresar con el usuario
creado para dar de alta nuevos usuarios, y hacer uso de la misma 
en forma normal.

Para dar de alta una nueva empresa, deberá ejecutar el script
alta_empresa.sql reemplazando el nombre de las tablas por un prefijo
(en el caso de la empresa demo el prefijo es “dem”) y luego en el insert
en la tabla empresas ingresar los datos pertinentes, incluido el prefijo
de las tablas.

Chequear que los ids utilizados correspondan (en el caso del usuario que apunte
a la empresa que se dio de alta.

Cada empresa nueva va a tener su set de tablas, esto se pensó así por temas de performance
ya que cada empresa va a trabajar contra sus tablas.

——————————————————————————————————————————————————————
Más información
——————————————————————————————————————————————————————

Podrán encontrar más información en:

- www.e-cursos.com.ar
- www.e-cursos.com.ar/foro
