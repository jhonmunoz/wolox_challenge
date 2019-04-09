# Comenzando
Para poder descargar el proyecto
```sh
git clone https://github.com/LucaPascarelli/wolox_challenge.git
```

Para poder instalar las dependencias
```sh
composer install
```

Se puede utilizar cualquier editor de base de datos.
Se debe ejecutar el archivo wolox_challenge.sql para poder generar la base y las tablas necesarias para poder utilizar la API.

Verificar el archivo **src/settings.php** para poder cambiar las credenciales de acceso a la base de datos si es necesario.

Para poder ejecutar el server 
```sh
php -S 127.0.0.1:8080
```

# Endpoints
  - GET /users/{id}
  - DELETE /users/{id}
  - PATCH /users/edit
  - POST /users/add

# Response
```sh
GET /users/{id}
```
```sh
Status: 200 OK
{
    "id": "1",
    "name": "Luca",
    "email": "lpascarelli@gmail.com",
    "image": "http://localhost:8080/public/assets/images/users/80099ba3dfc8cc67.png"
}
```
```sh
DELETE /users/{id}
```
```sh
Status: 204 No Content
```
```sh
PATCH /users/edit
```
```sh
Status: 204 No Content
```
```sh
POST /users/add
```
```sh
Status: 204 No Content
```
