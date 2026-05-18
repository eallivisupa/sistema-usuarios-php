# sistema-usuarios-php
Sistema web seguro de gestión de usuarios en PHP y MySQL. Implementa autenticación, control de accesos con $_SESSION, hashing de contraseñas con Bcrypt, actualización de perfil y modo oscuro nativo con Font Awesome.
# Sistema Seguro de Gestión de Usuarios
## Descripción del Sistema
Este es un sistema web desarrollado en PHP y MySQL que permite la gestión segura de usuarios. Implementa funcionalidades de autenticación (Login/Registro), manejo de estado mediante sesiones de PHP, y una zona privada donde los usuarios pueden actualizar su información básica y cambiar su contraseña de forma segura. Además, cuenta con un diseño responsivo, Modo Oscuro nativo y UI con Font Awesome.

## Requisitos
- **Servidor Web:** Apache (XAMPP)
- **Lenguaje:** PHP 8.0 o superior
- **Base de Datos:** MySQL (XAMPP)

## Estructura del Proyecto
- `/`: Vistas principales (`index.php`, `registro.php`, `perfil.php`, `cambiar_password.php`, `cerrar_sesion.php`, `style.css`, `script.js`).
- `/config/`: Conexión a la base de datos PDO (`conexion.php`).
- `/actions/`: Lógica de backend y validaciones del servidor.

## Pasos para instalar y probar localmente
1. Clonar este repositorio en la carpeta `htdocs` de XAMPP.
2. Encender Apache y MySQL en XAMPP.
3. Importar la base de datos:
   - Abrir `http://localhost/phpmyadmin`.
   - Ejecutar el script SQL para crear la base de datos `sistema_usuarios` y la tabla `usuarios`.
4. Configurar la conexión en `config/conexion.php` según el puerto del servidor local.
5. Acceder al sistema ingresando a `http://localhost/Sistema_Web/registro.php`.
