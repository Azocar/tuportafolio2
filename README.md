# Mini Proyecto MVC - TuPortafolio Básico

Este es un proyecto web básico que implementa el patrón MVC utilizando PHP puro y MySQL. La aplicación permite registrar estudiantes y visualizar una lista de los mismos, con soporte para login, registro, dos idiomas (español/inglés) y dos temas (claro/oscuro).

## Requisitos
- XAMPP (Apache + MySQL)

## Guía de Instalación

1. **Clonar/Descargar**: Coloca la carpeta del proyecto `TuPortafolio` dentro de tu directorio `htdocs` de XAMPP (generalmente `C:/xampp/htdocs/`).
2. **Iniciar Servidores**: Abre el panel de control de XAMPP y activa los módulos de **Apache** y **MySQL**.
3. **Base de Datos**:
    - Navega a `http://localhost/phpmyadmin`.
    - Crea una nueva base de datos llamada `tuportafolio_db`.
    - Selecciona la base de datos recién creada, ve a la pestaña "SQL" y ejecuta el contenido del archivo `database.sql` (incluido en este proyecto).
4. **Acceder al Proyecto**: Abre tu navegador y visita `http://localhost/TuPortafolio/public/`.

## Explicación de la Estructura MVC

- **Modelos (`app/models/`)**: Contiene la clase `DatabaseModel.php`, que se encarga de toda la lógica de la base de datos (conexión, inserción y selección de datos). Es la única capa que habla con MySQL.
- **Vistas (`app/views/`)**: Contienen los archivos de presentación (HTML/CSS/JS) que el usuario ve en el navegador. No contienen lógica de negocio.
- **Controladores (`app/controllers/`)**: Actúan como intermediarios. Reciben las peticiones del usuario, interactúan con el Modelo para obtener o guardar datos, y finalmente cargan la Vista apropiada para mostrar la respuesta.
- **Punto de Entrada (`public/index.php`)**: Todas las peticiones del usuario son redirigidas a este archivo (Patrón Front Controller), que se encarga de cargar el controlador y método correctos según la ruta solicitada.
- **Configuración (`config/routes.php`)**: Define las rutas válidas de la aplicación y a qué par `[Controlador, método]` corresponden.
- **Idiomas (`lang/`)**: Traducciones para español e inglés.
- **Temas (`public/css/`)**: Archivos CSS para tema claro y oscuro.

## Cómo Probarlo

1. Asegúrate de que XAMPP está corriendo.
2. Importa `database.sql` en phpMyAdmin.
3. Accede a `http://localhost/TuPortafolio/public/`.
4. Regístrate, inicia sesión, cambia idioma y tema, y prueba el registro de habilidades.


