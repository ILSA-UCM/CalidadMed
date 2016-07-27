Proyecto Calidad MED
===================


Para este proyecto es **requerido**:

> - Apache Web Server
> - PHP
> - MySQL

**Recomendamos descargarse el paquete <i>[XAMPP]</i> que contine todo lo necesario para poder ejecutar la aplicacion <i>OdA</i> tanto para <i>MAC</i>, <i>LINUX</i> o <i>WINDOWS</i>**  

[XAMPP]:  https://www.apachefriends.org/

----------

Instrucciones de instalacion
-------------

Para Realizar la instalacion de esta aplicacion es necesario crear la base de datos en mysql con el script adjunto en el root de la carpeta **DataBaseInitial.sql** 

>**Opcional**
>Si se desea configurar el nombre de la base de datos que se creara se deberá editar el archivo  **DataBaseInitial.sql** sustitutyendo las primeras lineas:

> - CREATE DATABASE  IF NOT EXISTS **`tfg2016`** /*!40100 DEFAULT CHARACTER SET latin1 */;
> - USE **`tfg2016`**;

>por:

> - CREATE DATABASE  IF NOT EXISTS **`DATABASE_NAME`** /*!40100 DEFAULT CHARACTER SET latin1 */;
> - USE **`DATABASE_NAME`**;

>En caso contrario la **DATABASE_NAME** sera **tfg2016**

Despues de la insercion de la base de datos deberemos configurar la aplicacion en ../php/conexion.php de la siguiente manera:

- $servername = "SERVER"; // Nombre del servidor que almacena la Base de datos
- $username = "USER_SERVER"; // Usuario en el servidor con acceso
- $password = "PASSWORD"; //Contraseña del usuario del punto anterior
- $dbname = "DB_NAME"; // Dombre de la base de datos ( si no se hace la parte **opcional** descrita con anterioridad, sera por defecto **tfg2016** en creación por el script.

Con todo ello la aplicacion debe correr correctamente.

Un Saludo.