# Descarga del proyecto
Para poder descargar el proyecto, usar el comando git clone en el directorio en le que se quiere descargar el mismo
```sh
git clone https://github.com/LucaPascarelli/wolox_challenge.git
```


# Composer
Para poder instalar las dependecias del proyecto, se debe utilizar [Composer]
Debemos estar en el directorio del proyecto y ejecutar el siguiente comando:
```sh
composer install
```

# Xampp
Para poder usar PHP y MySQL debemos descargar e instalar la herramienta [Xampp]

[![N|Solid](http://www.mclibre.org/consultar/php/img/xampp/xampp-control-panel-04.png)]

A tener en cuenta:
- Solo se debe instalar MySQL y PHP
- Lo unico que debemos ejecutar (presionando el boton Start) es MySQL

# Base de Datos
Se puede utilizar cualquier editor de base de datos.
Se debe crear la base de datos wolox_challenge y ejecutar la siguiente query para generar la tabla:

```sql 
create table user 
 (
    id    int auto_increment primary key,
    name  varchar(180) null,
    email varchar(180) null,
    image varchar(180) null
);
```

# Postman
Para poder testear la API, se debe utilizar la herramienta [Postman]
La documentacion (con ejemplos) se puede consultar [aqui]

# Ejecutar el server
Para poder ejecutar el server (para que, de este modo nuestra API empiece a correr), se debe ejecutar el siguiente comando sobre el directorio del proyecto:
```sh
php -S 127.0.0.1:8080
```


[Composer]: <https://getcomposer.org/>
[Xampp]: <https://www.apachefriends.org/es/index.html>
[Postman]: <https://www.getpostman.com/>
[aqui]: <https://learning.getpostman.com/docs/postman/collections/examples/>