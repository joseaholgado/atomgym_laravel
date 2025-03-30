# atomgym_laravel
Proyecto en Laravel de 2ªDAW

# AVISO
⚠️ Este proyecto está archivado y puede contener vulnerabilidades. No se recomienda su uso en producción.

# AtomGym

AtomGym es una página web de entrenamientos donde los usuarios pueden registrar rutinas de entrenamiento personalizadas. ![image](https://github.com/joseaholgado/atomgym_laravel/assets/115182985/8252e463-8063-41c7-bd35-b00137d1660b)


Los usuarios pueden añadir ejercicios a su rutina, especificando el nombre del ejercicio, series, repeticiones, descripción y opcionalmente una imagen.
![image](https://github.com/joseaholgado/atomgym_laravel/assets/115182985/47b26eca-4374-459b-8a7f-97134d2ae881)

Además, la página está dividida en grupos musculares registrados en la base de datos, los cuales pueden ser administrados por el administrador, quien puede añadir o eliminar dichos grupos musculares. ![image](https://github.com/joseaholgado/atomgym_laravel/assets/115182985/a35b2e34-ee75-48fe-9ec6-fd9d5136d031)


## Requisitos Previos

- PHP >= 8.3 ![image](https://github.com/joseaholgado/atomgym_laravel/assets/115182985/f59b2721-0e10-4035-9f20-5922a6f7b1db)

- Laravel 10 ![image](https://github.com/joseaholgado/atomgym_laravel/assets/115182985/94c3e044-9135-4dbf-a19b-54d5ef6181d2)

- MySQL u otro sistema de gestión de bases de datos compatible ![image](https://github.com/joseaholgado/atomgym_laravel/assets/115182985/ff4e0dba-3a5b-4cd3-bf61-5698d195aeb2)

- Composer ![image](https://github.com/joseaholgado/atomgym_laravel/assets/115182985/824e0891-2799-4b70-ac9a-699c95346aa9)

- Extensiones adicionales: 
  - Livewire para la funcionalidad del buscador ![image](https://github.com/joseaholgado/atomgym_laravel/assets/115182985/fbb05246-cc9d-4806-84d4-2b7de1d81f59)

  - Blade para el uso de plantillas ![image](https://github.com/joseaholgado/atomgym_laravel/assets/115182985/dae11593-6e16-47ac-89c9-a9cb3423eefa)

  - Tailwind CSS para el diseño ![image](https://github.com/joseaholgado/atomgym_laravel/assets/115182985/0a29327c-f706-43e9-8d1c-63b5c5646056)


## Instalación

1. Clona este repositorio: `gh repo clone joseaholgado/atomgym_laravel`
2. Navega hasta el directorio del proyecto: `cd atomgym2`
3. Instala las dependencias de PHP con Composer: `composer install`
4. Ejecuta las migraciones de la base de datos: `php artisan migrate`
5. (Opcional) Ejecuta los seeders para llenar la base de datos con datos de prueba: `php artisan db:seed`

## Uso

- Los usuarios pueden registrar una cuenta, iniciar sesión y crear, modificar o eliminar rutinas de entrenamiento. ![image](https://github.com/joseaholgado/atomgym_laravel/assets/115182985/db5aae38-d754-40fa-88f5-d24aec33f760)

- El administrador puede acceder a un panel de administración donde puede gestionar los grupos musculares, ver todos los usuarios registrados y eliminar usuarios.
- Se utiliza Livewire para implementar un buscador interactivo. 
- Blade se utiliza para la creación de plantillas, facilitando la creación de interfaces de usuario dinámicas.
- Tailwind CSS se emplea para el diseño del frontend, proporcionando un estilo moderno y adaptable.
- Se ha implementado un sistema de paginación para facilitar la navegación entre los registros. ![image](https://github.com/joseaholgado/atomgym_laravel/assets/115182985/c37d59fe-95f3-4c8d-bc45-bd272707d336)

- Se ha implementado la subida de archivos para adjuntar imágenes a los entrenamientos registrados.
- Se han añadido validaciones en el registro y actualización de entrenamientos, así como en la creación de grupos musculares desde el lado del administrador.
- Se ha creado un componente propio para el buscador. ![image](https://github.com/joseaholgado/atomgym_laravel/assets/115182985/219590de-923a-4c91-93f4-c65d3189eca6)


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
