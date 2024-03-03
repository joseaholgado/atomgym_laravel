# atomgym_laravel
Proyecto en Laravel de 2ªDAW
# AtomGym

AtomGym es una página web de entrenamientos donde los usuarios pueden registrar rutinas de entrenamiento personalizadas. Los usuarios pueden añadir ejercicios a su rutina, especificando el nombre del ejercicio, series, repeticiones, descripción y opcionalmente una imagen. Además, la página está dividida en grupos musculares registrados en la base de datos, los cuales pueden ser administrados por el administrador, quien puede añadir o eliminar dichos grupos musculares.

## Requisitos Previos

- PHP >= 8.3
- Laravel 10
- MySQL u otro sistema de gestión de bases de datos compatible
- Composer
- Extensiones adicionales:
  - Livewire para la funcionalidad del buscador
  - Blade para el uso de plantillas
  - Tailwind CSS para el diseño

## Instalación

1. Clona este repositorio: `gh repo clone joseaholgado/atomgym_laravel`
2. Navega hasta el directorio del proyecto: `cd atomgym2`
3. Instala las dependencias de PHP con Composer: `composer install`
4. Ejecuta las migraciones de la base de datos: `php artisan migrate`
5. (Opcional) Ejecuta los seeders para llenar la base de datos con datos de prueba: `php artisan db:seed`

## Uso

- Los usuarios pueden registrar una cuenta, iniciar sesión y crear, modificar o eliminar rutinas de entrenamiento.
- El administrador puede acceder a un panel de administración donde puede gestionar los grupos musculares, ver todos los usuarios registrados y eliminar usuarios.
- Se utiliza Livewire para implementar un buscador interactivo.
- Blade se utiliza para la creación de plantillas, facilitando la creación de interfaces de usuario dinámicas.
- Tailwind CSS se emplea para el diseño del frontend, proporcionando un estilo moderno y adaptable.
- Se ha implementado un sistema de paginación para facilitar la navegación entre los registros.
- Se ha implementado la subida de archivos para adjuntar imágenes a los entrenamientos registrados.

## Seeders

El proyecto incluye los siguientes seeders para generar datos de prueba:
- `Database\Seeders\MusculosSeeder`: Genera datos para la tabla de grupos musculares.
- `Database\Seeders\UserSeeder`: Genera datos para la tabla de usuarios.
- `Database\Seeders\EntrenamientosSeeder`: Genera datos para la tabla de entrenamientos.

La contraseña predeterminada para todos los usuarios (incluido el administrador) es: `12341234`

## Migraciones

El proyecto utiliza las siguientes migraciones:
- `create_users_table.php`: Define la estructura de la tabla de usuarios.
- `create_entrenamientos_table.php`: Define la estructura de la tabla de entrenamientos.
- `create_musculos_table.php`: Define la estructura de la tabla de grupos musculares.

## Modelo Vista Controlador (MVC)

Se ha seguido el patrón de diseño Modelo Vista Controlador para la estructura del proyecto.

## Configuración de la Base de Datos

El archivo de configuración de la base de datos (` .env`) contiene la siguiente configuración para MySQL:

- CONNECTION=mysql
- HOST=localhost
- PORT=3306
- DATABASE=atomgym
- USERNAME=root

## Créditos

Este proyecto fue creado por [Jose Antonio Holgado Bonet]. 
