Alan: darle función al botón de "Ver partidos políticos", en el mismo deben cargarse los partidos políticos existentes en la base
de datos, también agregarle un botón con la funcionalidad de activar el partido, ya que por defecto, este se crea inactivo, recuer-
da que las columnas "estado" son booleanas, funcionan con true o false, si es true, estan activas, si es false, inactivas,
para lo de activar partido, puedes guiarte de lo que se realizó en activar puesto, puedes hacer que se visualizen los partidos
parecido a como se visualizan los puestos en la pantala de Administración, recuerda cargar los logos de cada partido, estos se
encuentran en assets/images/partidos, los arrays de objetos que se cargan con partido tiene un objeto que se llama logo, esta con-
tiene el nombre de cada imagen para cargar.

Estaban: El diseño de agregar candidato está hecho, te encargarás de darle la funcionalidad de que este se agreguen, recuerda que
debes validad para que no acepte valores null ( Puedes guiarte de añadirPuesto.php ), debes llenar el método add del candidatosHandler,
para esto ( El código es bastante parecido al PartidoHandler.php, puedes guiarte de ahí para el asunto de la foto de perfil de-
candidato ), recuerda que el directorio a guardar la foto del candidato es en assets/images/candidatos/, y su respectivo nombre que nombrarás
en el CandidatosFileHandler en el método Add, también debes agregar un apartado para desactivar el candidato, puedes guiarte de lo que se realizó en activar puesto,
para agregar el desactivar candidato, es necesario darle funcionalidad al botón " ver candidatos " y que este cargue a los candidatos activos y en el-
botón de desactivar candidatos, carguen los candidatos inactivos y posteriormente se puedan activar ( Puedes guiarte de Administración.php y activarPuesto.php, ambos archivos
poseen la clave para eso ),y un apartado para editar ( Esto puedes hacerlo haciendo un copy paste de básicamente todo el agregarCandidato.php y hacer que carguen
los datos del candidato a editar, ya que la ID del mismo puedes hacer que se manden por parámetros una vez se vayan cargando ( Guiarte de como se hace con los puestos en el archivo Administracion.php )
 y posteriormente llamar la función que hará el edit, si te presenta error, guíate del modificarPuesto.php.

Yo Brahiam me encargaré del resto faltante, como cargar los candidatos de cada respectivo puesto y partido una vez se le clickee al "ver candidatos" de cada puesto, con su respectiva foto de perfil
y logo de cada partido, esta base se utilizará como perspectiva del ciudadano a votar, también me encargaré de la parte de agregar ciudadanos y activarlos y una comenzar de manera parcial la parte
de elecciones para que esta se pueda activar y realizar el CRUD y cargar las elecciones tantos activas como inactivas con sus respectivos resultados.

Extra (

Una vez hayamos acabado esto, tendríamos el 80% del proyecto realizado, ya que las bases del mismo estarían bien implementadas y solo quedaría la perspectiva del ciudadano, lo cual esto resta a un pequeño
copy and paste del foreach que se ejecuta en administrador.php, un filtro en los puestos conforme a la tabla de auditoría, lo cual expliqué anteriormente y la función de votar a cada candidato y que este registre
la misma votación a la tabla de auditoría que se utilizará para validar el resto y sacar los resultados finales.

).

Pueden clonar el repositorio y ejecutar el script MYSQL, este trae consigo un registro de administrador para que puedan realizar pruebas y acceder a la parte administrativa del programa.

Los datos son:

Usuario: Leonardo

Contraseña: 123123

¡¡Suerte muchachos, rompamos esto que nosotros somos duros!!