## SkyFlow

SkyFlow es una plataforma integral desarrollada en Laravel para la gestión administrativa de aerolíneas, vuelos, tripulaciones y un sistema completo de reservas para pasajeros. Diseñado con una arquitectura robusta en el backend y una interfaz de usuario minimalista y moderna.

## Características Principales

### Panel Administrativo
* **Gestión de Vuelos:** Creación y programación de vuelos, asignación de aeronaves, aerolíneas y gestión dinámica de escalas (rutas con múltiples paradas).
* **Gestión de Rutas:** Registro de orígenes, destinos, cálculo de distancias y tiempos estimados, con validación estricta de unicidad (códigos IATA).
* **Control de Flotillas (Aviones):** Registro de aeronaves, capacidades máximas y carga de imágenes integradas directamente con **Cloudinary**.
* **Gestión de Tripulación:** Control de pilotos, sobrecargos y asistentes, asignación de licencias con formatos estrictos y disponibilidad de personal.
* **Reclamos:** Panel cuya vista puede administrar el seguimiento de un reclamo hecho por un usuario.

### Portal de Pasajeros (Reservas y Pagos)
* **Búsqueda Dinámica:** Motor de búsqueda de vuelos disponibles por origen, destino y fecha.
* **Selección de Asientos:** Selección de asientos desde un panel dinamico de asientos simulados dentro de un avión.
* **Sistema de Reservas:** Gestion de reservas por medio de estados, ademas de uso de limpieza de reservas fantasma.
* **Pasarela de Pagos (Simulada):** Gestión rigurosa de datos de tarjeta con las que el usuario tiene que pagar.
* **Gestión de Reclamos:** Seguimiento y cancelación de reservas confirmadas (con reglas lógicas de tiempo de salida).

## Endpoints del sistema

 ```bash
GET|HEAD        / ................................................................................................................................................................... 
  GET|HEAD        airlines ................................................................................................................... airlines.index ÔÇ║ AirlineController@index
  POST            airlines ................................................................................................................... airlines.store ÔÇ║ AirlineController@store
  GET|HEAD        airlines/create .......................................................................................................... airlines.create ÔÇ║ AirlineController@create
  GET|HEAD        airlines/{airline} ........................................................................................................... airlines.show ÔÇ║ AirlineController@show
  PUT|PATCH       airlines/{airline} ....................................................................................................... airlines.update ÔÇ║ AirlineController@update
  DELETE          airlines/{airline} ..................................................................................................... airlines.destroy ÔÇ║ AirlineController@destroy
  GET|HEAD        airlines/{airline}/edit ...................................................................................................... airlines.edit ÔÇ║ AirlineController@edit
  GET|HEAD        airplanes ................................................................................................................ airplanes.index ÔÇ║ AirplaneController@index
  POST            airplanes ................................................................................................................ airplanes.store ÔÇ║ AirplaneController@store
  GET|HEAD        airplanes/create ....................................................................................................... airplanes.create ÔÇ║ AirplaneController@create
  GET|HEAD        airplanes/{airplane} ....................................................................................................... airplanes.show ÔÇ║ AirplaneController@show
  PUT|PATCH       airplanes/{airplane} ................................................................................................... airplanes.update ÔÇ║ AirplaneController@update
  DELETE          airplanes/{airplane} ................................................................................................. airplanes.destroy ÔÇ║ AirplaneController@destroy
  GET|HEAD        airplanes/{airplane}/edit .................................................................................................. airplanes.edit ÔÇ║ AirplaneController@edit
  POST            api/register ........................................................................................................................................................ 
  GET|HEAD        claims ......................................................................................................................... claims.index ÔÇ║ ClaimController@index
  POST            claims ......................................................................................................................... claims.store ÔÇ║ ClaimController@store
  GET|HEAD        claims/create/{id_reserves} .................................................................................................. claims.create ÔÇ║ ClaimController@create
  PATCH           claims/{id}/state .................................................................................................. claims.updateState ÔÇ║ ClaimController@updateState
  GET|HEAD        crews ............................................................................................................................ crews.index ÔÇ║ CrewController@index
  POST            crews ............................................................................................................................ crews.store ÔÇ║ CrewController@store
  GET|HEAD        crews/create ................................................................................................................... crews.create ÔÇ║ CrewController@create
  GET|HEAD        crews/{crew} ....................................................................................................................... crews.show ÔÇ║ CrewController@show
  PUT|PATCH       crews/{crew} ................................................................................................................... crews.update ÔÇ║ CrewController@update
  DELETE          crews/{crew} ................................................................................................................. crews.destroy ÔÇ║ CrewController@destroy
  GET|HEAD        crews/{crew}/edit .................................................................................................................. crews.edit ÔÇ║ CrewController@edit
  GET|HEAD        dashboard ..................................................................................................................... dashboard ÔÇ║ DashboardController@index
  GET|HEAD        flights ...................................................................................................................... flights.index ÔÇ║ FlightController@index
  POST            flights ...................................................................................................................... flights.store ÔÇ║ FlightController@store
  GET|HEAD        flights/create ............................................................................................................. flights.create ÔÇ║ FlightController@create
  GET|HEAD        flights/{flight} ............................................................................................................... flights.show ÔÇ║ FlightController@show
  PUT|PATCH       flights/{flight} ........................................................................................................... flights.update ÔÇ║ FlightController@update
  DELETE          flights/{flight} ......................................................................................................... flights.destroy ÔÇ║ FlightController@destroy
  GET|HEAD        flights/{flight}/edit .......................................................................................................... flights.edit ÔÇ║ FlightController@edit
  GET|HEAD        index ......................................................................................................................................................... index
  GET|HEAD        login ............................................................................................................ login ÔÇ║ Auth\AuthenticatedSessionController@create
  POST            login ..................................................................................................................... Auth\AuthenticatedSessionController@store
  POST            logout ......................................................................................................... logout ÔÇ║ Auth\AuthenticatedSessionController@destroy
  GET|HEAD        my-claims ...................................................................................................................... claims.my ÔÇ║ ClaimController@myClaims
  GET|HEAD        my-reserves .............................................................................................................. reserves.my ÔÇ║ ReserveController@myReserves
  POST            payments ................................................................................................................... payments.store ÔÇ║ PaymentController@store
  GET|HEAD        payments/create/{id_reserves} ............................................................................................ payments.create ÔÇ║ PaymentController@create
  GET|HEAD        profile ............................................................................................................................ profile ÔÇ║ ProfileController@edit
  GET|HEAD        register ............................................................................................................ register ÔÇ║ Auth\RegisteredUserController@create
  POST            register ........................................................................................................................ Auth\RegisteredUserController@store
  POST            reserves ................................................................................................................... reserves.store ÔÇ║ ReserveController@store
  GET|HEAD        reserves/confirmation/{id_reserves} .......................................................................... reserves.confirmation ÔÇ║ ReserveController@confirmation
  GET|HEAD        reserves/create/{id_flights} ............................................................................................. reserves.create ÔÇ║ ReserveController@create
  PATCH           reserves/{id_reserves}/cancel ............................................................................................ reserves.cancel ÔÇ║ ReserveController@cancel
  GET|HEAD        routes ......................................................................................................................... routes.index ÔÇ║ RouteController@index
  POST            routes ......................................................................................................................... routes.store ÔÇ║ RouteController@store
  GET|HEAD        routes/create ................................................................................................................ routes.create ÔÇ║ RouteController@create
  GET|HEAD        routes/{route} ................................................................................................................... routes.show ÔÇ║ RouteController@show
  PUT|PATCH       routes/{route} ............................................................................................................... routes.update ÔÇ║ RouteController@update
  DELETE          routes/{route} ............................................................................................................. routes.destroy ÔÇ║ RouteController@destroy
  GET|HEAD        routes/{route}/edit .............................................................................................................. routes.edit ÔÇ║ RouteController@edit
  GET|HEAD        vuelos/buscar .............................................................................................................. flights.search ÔÇ║ FlightController@search
 ```

## Stack Tecnológico

* **Backend:** PHP 8.2 | Laravel 12.x
* **Frontend:** Blade Templates (Laravel Breeze) | Tailwind CSS | JavaScript Vanilla 
* **Base de Datos:** MySQL
* **Almacenamiento en la Nube:** Cloudinary API 
* **Herramientas de UI:** Flowbite | SweetAlert2

## Requisitos Previos

Asegúrate de tener instalado en tu entorno local:
* PHP >= 8.2
* Composer
* Node.js y NPM
* MySQL
* Cuenta en Cloudinary

## Instalación y Configuración

Sigue estos pasos para levantar el proyecto en tu entorno local:

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/tu-usuario/proyecto-catedra-dss.git
   cd proyecto-dss
   ```
2. **Instalar dependencias de PHP:**
   ```bash
   composer install
   ```
3. **Instalar dependencias de Node:**
   ```bash
   npm install
   ```
4. **Configurar entorno:**
   Copia el archivo de ejemplo y genera tu clave de aplicación.
    ```bash
   cp .env.example .env
    php artisan key:generate
    ```
5. Configurar la Base de Datos y Cloudinary:
Abre el archivo .env y configura tus credenciales de MySQL y Cloudinary:
   ```bash
   DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_bd
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña

    CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME
    CLOUDINARY_CLOUD_NAME=tu_cloud_name
    CLOUDINARY_KEY=tu_api_key
    CLOUDINARY_SECRET=tu_api_secret
    ```
6. Ejecutar migraciones y seeders:
(Opcional: Si tienes seeders configurados para poblar la base de datos)
   ```bash
   php artisan migrate --sedd
   ```
7. Compilar assets de Tailwind CSS:
   ```bash
   npm run dev
   ```
8. Levantar el servidor local:
En una nueva terminal, ejecuta:
   ```bash
   php artisan serve
   ```

## Estructura de validaciones y seguridad

Este proyecto incorpora medidas de seguridad y lógica de negocio estricta:

* **Transacciones de Base de Datos:** Garantiza la integridad de los datos al registrar vuelos con múltiples escalas o procesar pagos.
* * **Bloqueos Pesimistas:** Evita la doble reserva del mismo asiento en entornos concurrentes.
* * **Limpieza Automática (Garbage Collection):** Los registros temporales (reservas pendientes) se limpian automáticamente en cada petición de creación de nueva reserva.
* * **Protección contra Inyecciones y XSS:** Uso nativo de Eloquent ORM y motor de plantillas Blade.
  
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
