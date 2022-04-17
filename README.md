# Proyecto Ocio Backend PhP Laravel para....
***
![Foto de la academia de Geekhubs](./img/geekhubs.png)
***
## Repositorio en el que se a estado trabajando el proyecto.

## https://github.com/RobertoGuzman64/BackendPhPLaravel
## Los requisitos funcionales de la aplicación son los siguientes:
* Los usuarios se tienen que poder registrar a la aplicación, estableciendo un usuario/contraseña.
* Los usuarios tienen que autenticarse a la aplicación haciendo login.
* Los usuarios tienen que poder crear Partidas (grupos) por un determinado videojuego.
* Los usuarios tienen que poder buscar Partidas seleccionando un videojuego.
* Los usuarios pueden entrar y salir de una Partida.
* Los usuarios tienen que poder enviar mensajes a la Partida. Estos mensajes tienen que poder ser editados y borrados por su usuario creador.
* Los mensajes que existan en una Partida se tienen que visualizar como un chat común.
* Los usuarios pueden introducir y modificar sus datos de perfil, por ejemplo, su usuario de Battle.net
* Los usuarios tienen que poder hacer logout de la aplicación web.

## BASE DE DATOS Y SUS RELACIONES

***
![Base de datos y sus relaciones](/img/esquema.png)
***

* Usuario tiene una relación con **Partida de 1:N** (una Partida solo tiene un Usuario creador, y un Jugador puede ser creador de 0, 1 o varias Partidas).
* Jugador tiene una relación con **Partida de N:N**, creando la tabla **Jugador** (una Partida puede tener 1 o varios Usuarios como Jugadores, y un Jugador puede pertenecer a 0, 1 o varias Partidas).
* Usuario tiene una relación con **Mensaje de 1:N** (un Mensaje solo puede tener un Usuario creador, y un Usuario puede tener 0, 1 o varios Mensajes).
* Mensaje tiene una relación con **Partida de 1:N** (una Partida puede tener 0, 1 o varios Mensajes, y un Mensaje solo puede tener una Partida).
* Partida tiene una relación con **Juego de 1:N** (una Partida solo puede tener un Juego, y un Juego puede tener 0, 1 o varias Partidas).

## TECNOLOGÍAS UTILIZADAS EN EL PROYECTO
* SQL --> usado como sistema de base de datos.
* PHP --> lenguaje de programación usado en la API.
* Composer --> usado como gestor de dependencias.
* Laravel --> framework de PHP usado para la creación de la API.
* Eloquent --> usado para acceso y manejo de la base de datos del proyecto.
* Git --> usado para tener alojado el proyecto en repositorio de github.
* Heroku --> usado para tener la API deployada.
* Jwt --> usado para la autenticación de los Usuarios

## ENDPOINTS DE LA API

* ENLACE A POSTMAN, CONFIGURADO CON TODOS LOS ENDPOINTS (LOCAL)
    * [![Probar en Postman](https://run.pstmn.io/button.svg)](https://go.postman.co/workspace/My-Workspace~7d94c733-7b7b-4ce9-8954-4e704cb99832/collection/19641286-350ba66c-1012-46e8-ae24-449539e0d4df?action=share&creator=19641286)

* USER
    * Mostrar el perfil de Usuario --> /api/me (GET)
    * Registro de nuevo Usuario -- > /api/register (POST)
    * Login en la aplicación --> /api/login (POST)
    * Logout de la aplicación --> /api/logout (POST)
    * Actualizar el perfil de Usuario --> /api/actualizarUsuario (PUT) 
    * Eliminar el perfil de Usuario --> /api/borrarUsuario/{id} (DELETE)

* JUGADOR (PERTENECE A LA TABLA USUARIO)
    * Ver todos los Jugadores --> /api/jugadores (GET)
    * Crear un Jugador --> /api/jugadores (POST)
    * Ver Jugador por ID --> /api/jugadorId (POST)
    * Ver Jugador por ID de Partida --> /api/jugadorPartidaId (POST)
    * Ver Jugador por ID de Usuario --> /api/jugadorUsuarioId (POST)
    * Actualizar datos de Jugador --> /api/jugadorActualiza (PUT)
    * Eliminar Jugador --> /api/jugadorBorrar (DELETE)

* JUEGO (PERTENECE A LA TABLA PARTIDA)
    * Ver todos los Juegos --> /api/juegos (GET)
    * Crear un Juego --> /api/juegos (POST)
    * Ver Juego por ID --> /api/juegoId (POST)
    * Actualizar datos de un Juego --> /api/juegoActualiza (PUT)
    * Eliminar Juego --> /api/juegoBorrar (DELETE)

* PARTIDA
    * Ver todas las Partidas --> /api/partidas (GET)
    * Crear una Partida --> /api/partidas (POST)
    * Buscar party por ID --> /api/partidaId (POST)
    * Actualizar datos de una Partida --> /api/partidaActualiza (PUT)
    * Eliminar Partida --> /api/partidaBorrar (DELETE)

* MENSAJE
    * Ver todos los Mensajes --> /api/mensajes (GET)
    * Ver Mensaje por ID de Partida --> /api/mensajesPartidaId (POST)
    * Crear un Mensaje --> /api/mensajes (POST)
    * Ver Mensaje por ID --> /api/mensajeId (POST)
    * Actualizar los datos de un Mensaje --> /api/mensajeActualiza (PUT)
    * Eliminar Mensaje --> /api/mensajeBorrar (DELETE)

## MIGRATION Y SEEDERS
* Todas las tablas de la base de datos y los registros de la tabla **Juegos** están creados con archivos de migraciones y de seeders (solo se crean registros de Juegos, ya que el registro de usuarios se debe de hacer de manera manual desde la API para poder usar login con token, y el resto de tablas tienen relaciones con la tabla **Users**). Para crear tanto las tablas como los registros, además de sobreescribir la información guardada en la base de datos, se usa el siguiente comando:
```
php artisan db:seed
```
* Para que se ejecuten todos los seeders, además, se ha añadido en el archivo **Database\Seeders\DatabaseSeeder** los diferentes seeders que existen en la API.

## IMPLEMENTACIÓN DE SEGURIDAD EN LA API: JASON WEB TOKEN
* Se instala JWT en el proyecto con el siguiente comando:
```
composer require tymon/jwt-auth:*
```
* Se comprueba que en modelo **User** existen las siguientes lineas:
```
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
```
* Dentro de la clase **class User extends Authenticatable implements JWTsubject** añadimos la siguiente línea:
```
use HasApiTokens, HasFactory, Notifiable;
```
* Dentro del archivo **app/Http/Controllers/UserController** añadimos las siguientes líneas:
```
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
```
* En **/config/app.php** dentro del array 'providers' añadimos lo siguiente:
```
'providers' => [
        /*
         * Laravel Framework Service Providers...
         */

        Tymon\JWTAuth\Providers\LaravelServiceProvider::class,

        /*
         * Package Service Providers...
         */
],
```
* En **/config/auth.php** dentro del array 'defaults' y 'api' añadimos lo siguiente:
```
'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],
'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
        'hash' => false,
],
```
Se comprueba que también se a creado el archivo **/config/jwt.php**

* En **app/Http/Kernel.php** dentro del array 'protected $routeMiddleware' añadimos la siguien línea:
```
protected $routeMiddleware = [
        'jwt.auth' => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
];
```

* Creamos UsuarioController, donde se añaden las funciones de registro de nuevo Usuario, de login y de logout.