 # Concesionario api - TEP3 web 2 
 ## Integrantes
   * Bossio Luca 
   * Tami Marcos David
##  Descripcion
  El objetivo de este proyecto es proporcionar una solución escalable y eficiente para el manejo de datos de una concesionaria, permitiendo integrarse con sistemas front-end y aplicaciones móviles para mejorar la experiencia del usuario final.
## Funcionalidades Principales
### Gestión de Vehículos
  * Consultar inventario: Listar todos los vehículos disponibles con filtros y paginados.
  * Registrar vehículos: Agregar nuevos vehículos al inventario.
  * Actualizar vehículos: Modificar información de los vehículos existentes.
## Tecnologías Utilizadas
* Lenguaje: PHP
* Base de Datos: MySQL 
* Autenticación: JWT (JSON Web Tokens) para la gestión de usuarios y permisos.
## Endpoints
### Vehículos:
* (GET, POST)`/api/vehicles`  
* (GET, PUT) `/api/vehicles/:id`
### Usuario
* (GET) `usuario/token`
## Filtardo
Los autos se pueden filtrar cuando se llama a (GET) `/api/vehicles`
los parametros por los que se puede filtar son: 
* `año_min` o `año_max`
* `puertas_min` o `puertas_max`
* `hp_min` o `hp_max` 
* `precio_min` o `precio_max`
* `id_distribuidor`
### Ejemplo de uso 
  `/api/vehicles?año_min=2010&puertas_max=2`
## Filtardo
La api permite paginar los resultados, para esto se le tiene que enviar por parametro la cantidad de items(`limit`) que se quiere y otro parametro que representa la pagina (`page`).
### Ejemplo de uso 
  `/api/vehicles?limit=5&page=1`
## Ordenamiento
por ultimo la api admite retornar los datos ordenados que el parametros `orderBy` y tambien se le puede pedir los datos acendentemente o decendentemente con el queryParam `order`.
#### actuamente se puede ordenar por: 
* `price`
* `year`
* `brand`
#### y ordenados de manera:
* `DESC` de descendente 
* `ASC` de acendenete
