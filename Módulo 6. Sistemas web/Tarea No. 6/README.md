# Instrucciones para ejecutar el proyecto:

Asegúrate de tener:

- PHP 7.4+
- MySQL
- Composer

## 1. Configura la base de datos

Importa el archivo `dump.sql` ubicado en la carpeta `/config` para crear las tablas y datos necesarios.

## 2. Configura las variables de entorno

Ve a la carpeta `/config` y crea un archivo `.env`.
Agrega las siguientes variables y reemplaza los valores según tu configuración:

```env
DB_HOST="tu_host"
DB_USER="tu_usuario"
DB_PASS="tu_contraseña"
DB_NAME="nombre_de_tu_base_de_datos"
```

## 3. Ejecuta el servidor PHP

Desde la raíz del proyecto, ejecuta el siguiente comando para iniciar el servidor:

```bash
php -S localhost:1111 -t public
```

---

**Nota:**

- Si tienes errores con extensiones de PHP (como `pdo_mysql`), instálalas y habilítalas en tu archivo `php.ini`.

¡Eso fueron todos los pasos!  
_¡Espero puedas disfrutar de mi aplicación web!_
