# PT - Siroko

## Descripción del proyecto

Este proyecto forma parte de una Prueba Técnica para la empresa Siroko. Consiste en una aplicación web que permite a los
usuarios añadir productos a un carrito de la compra y realizar la compra de los mismos.

Dentro de las funcionalidades que se han implementado se encuentran:

- Añadir productos al carrito de la compra.
- Modificar la cantidad de productos añadidos al carrito.
- Eliminar productos del carrito de la compra.
- Visualizar la cantidad de productos añadidos al carrito.
- Realizar la compra de los productos del carrito.

## Tecnologías utilizadas

- Vue para el desarrollo del frontend.
- Laravel para el desarrollo del backend.
- Laravel Sail para la gestión de los comandos de Laravel.
- MySQL como base de datos.
- Docker para la gestión de los contenedores.
- TailwindCSS para el diseño del frontend.

## Arquitectura del proyecto

El proyecto consta de un frontend desarrollado en Vue utilizando TailwindCSS para el diseño y utilizando los estilos
base de un proyecto de Laravel.

El backend está desarrollado en Laravel y se basa en una arquitectura hexagonal, donde se separan las capas de
aplicación, dominio e infraestructura.

## Instalación

Para instalar el proyecto es necesario tener instalado Docker y Docker Compose. Una vez instalado, es necesario copiar
él .env.example a .env y modificar las variables de entorno necesarias para la aplicación.

Una vez realizado esto, es necesario ejecutar el siguiente comando para levantar los contenedores de la aplicación:

```bash
docker-compose up -d
```

Este comando levantará los contenedores de la aplicación y creará la base de datos con los datos necesarios para el
funcionamiento de la misma.

Una vez levantados los contenedores, es necesario ejecutar las migraciones y los seeders para crear la base de datos y
los datos necesarios para el funcionamiento de la aplicación. Para ello, es utilizaremos sail para ejecutar los comandos
de Laravel:

```bash
./vendor/bin/sail artisan migrate --seed
```

En mi caso cuento con un alias para sail, por lo que el comando sería:

```bash
sail artisan migrate --seed
```

Este paso es recomendable, ya que sail es básico para el desarrollo de Laravel y es necesario para ejecutar los comandos
de Laravel.

Una vez realizados estos pasos, nos quedará arrancar el frontend de la aplicación. Para ello, es necesario instalar las
dependencias de la aplicación y arrancar el servidor de desarrollo. Para ello, ejecutaremos los siguientes comandos:

```bash
npm install
```

Una vez instaladas las dependencias, arrancaremos el servidor de desarrollo con el siguiente comando:

```bash
npm run dev
```

Una vez realizado este paso, la aplicación estará lista para ser utilizada. Para acceder a la aplicación, es necesario
abrir un navegador y acceder a la siguiente URL: http://localhost
