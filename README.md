# Gesstión Académica
Plataforma integral para la administración de procesos académicos universitarios. Este sistema facilita la gestión de docentes, horarios, evaluaciones y planes de estudio, optimizando la coordinación entre departamentos académicos.

Instalación y uso

Para realizar la instalación, debe clonar este repositorio o también ejecutar el siguiente comando comando.

Dirígese a la carpeta

Después de la instalación, actualice la carpeta del vendor. Puede actualizarla con este comando.

```composer update```

Después de la actualización, cree el archivo .env con el siguiente comando.

```cp .env.example .env```

Ahora genera la product key.

```php artisan key:generate```

Migre las tablas y genere la base de datos.


```php artisan migrate --seed```

Ahora solo tiene que servir el ejecutar el proyecto.

```php artisan serve```

