# App para registrar tiendas y crear productos asociados a la tienda.

## Descripción:

En esta aplicación se podrá crear una tienda con sus respectivos productos la cual se almacenará en una base de datos MySQL, donde se relacionan los productos a una tienda en específico.

### Imagenes de la aplicacion

![Gif de la aplicacion](https://media.giphy.com/media/NdfHAwmbyfDZOCaZzf/giphy.gif)

---

## Tecnologías Usadas:

- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)
- [HTML](https://developer.mozilla.org/es/docs/Web/HTML)
- [Bootstrap 4](https://getbootstrap.com/docs/4.6/getting-started/introduction/)
- [Font awesome](https://fontawesome.com/)
- [XAMPP](https://www.apachefriends.org/es/index.html)

---

## Para usarlo

Para usar la aplicación debes de descargar o clonar este repositorio en tu máquina local.

    $ git clone https://github.com/klich1984/CRUD-PHP_TREDA.git
    $ cd ../path/to/the/file

Para correr el proyecto debes de tener un servidor corriendo en tu máquina local, yo en mi caso utilice [XAMPP](https://www.apachefriends.org/es/index.html), que al iniciarlo cuenta con todo lo necesario para servir nuestra aplicación, la cual se guarda en la carpeta htdocs de xampp.

Puedes utilizar cualquier servidor que sirva contenido php y utilizar como gestor de base de datos [MySQL](https://www.mysql.com/).

---

## Crear base de datos

En MySQL se debe correr el script que se encuentra en el directorio **database** llamado [DB-APP-treda-solutions.sql](database/DB-APP-treda-solutions.sql) el cual se encargará de crear la base de datos con sus respectivas tablas que usa la aplicación.

Una vez todo esté configurado y corriendo en tu máquina local **(Localhost)** puedes entrar y la dirección donde se sirve tu sitio y usar la aplicación.

- EJ: para mi caso para correr mi aplicación por medio de de mi configuración de XAMPP se realizaba en la siguiente ruta.


        http://localhost/prueba-tecnica-treda/index.php

---

## Configuración base de datos por PHP

En el directorio **database** hay un archivo [db.php](./database/db.php) donde se encuentran las configuraciones de usuario, contraseña y base de datos a usar, debes de cambiar estos datos con tu usuario y contraseña de MySQL si así lo requieres.

---

SI tienes alguna inquietud con mucho gusto de ayudare, no dudes en escribirme. a [klich84@gmail.com](mailto:klich84@gmail.com)
