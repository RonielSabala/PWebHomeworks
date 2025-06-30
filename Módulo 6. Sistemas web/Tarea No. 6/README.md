# Instrucciones para ejecutar el proyecto

Sigue estos pasos para configurar y ejecutar correctamente el proyecto web:

## 1. Requisitos previos

Asegúrate de tener instalado:

- [PHP 7.4+]
- [MySQL]
- [Composer]

## 2. Configura la base de datos

En MySQL Workbench crea una nueva base de datos, importa el archivo `dump.sql` ubicado en la carpeta `/config` para crear las tablas y datos necesarios.

## 3. Configura las variables de entorno

Ve a la carpeta `/config`, crea un archivo `.env` y agrega las siguientes variables y reemplaza los valores según tu configuración:

```env
DB_HOST="tu_host"
DB_USER="tu_usuario"
DB_PASS="tu_contraseña"
DB_NAME="nombre_de_tu_base_de_datos"
```

## 4. Ejecuta el servidor PHP

Desde la raíz del proyecto, ejecuta el siguiente comando para iniciar el servidor:

```bash
php -S localhost:1111 -t public
```

---

**Notas adicionales:**

- Si tienes errores relacionados con extensiones de PHP (como `pdo_mysql`), instálalas y habilítalas en tu archivo `php.ini`.

¡Eso fueron todos los pasos!  
_¡Espero puedas disfrutar de mi aplicación web!_
