# Investigacion-ISW-521

# Server-Side Rendering (SSR)

## Descripción técnica:

Aplicación web que explica qué es el **Server-Side Rendering (SSR)** y, al
mismo tiempo, es un ejemplo funcional de esta técnica. Está construida con
**HTML, CSS y PHP** .El archivo `index.php`
combina HTML fijo con un pequeño bloque de PHP que se ejecuta en el
servidor antes de responder, calculando tres datos en tiempo real (hora
del render, ID de petición y un contador guardado en disco). El navegador
recibe el documento ya completo, sin necesidad de JavaScript para ver el
contenido.

## Requisitos:

- **PHP 7.4 o superior** instalado.

## Pasos para ejecutar:

1. Abre una terminal y ubícate dentro de la carpeta del proyecto:
   ```bash
   cd ssr-php
   ```
2. Levanta el servidor de desarrollo integrado de PHP:
   ```bash
   php -S localhost:8000
   ```
3. Abre el navegador en:
   ```
   http://localhost:8000
   ```
4. Para detener el servidor, vuelve a la terminal y presiona `Ctrl + C`.

## Estudiante:

Raquel AG