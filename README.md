# Gestión Segura de Archivos

Proyecto desarrollado por Paul Zavala para la asignatura de Desarrollo Web de la Universidad Técnica Particular de Loja (UTPL).

## Descripción

Sistema web desarrollado en PHP que permite subir, listar, descargar y eliminar archivos de forma segura. El proyecto aplica Programación Orientada a Objetos (POO), autenticación de usuarios, conexión a base de datos mediante PDO y medidas de seguridad para el manejo de archivos.

## Objetivo

Implementar un módulo de gestión de archivos usando PHP, MySQL/MariaDB y POO, aplicando validaciones de seguridad para evitar riesgos asociados a la carga y manipulación de archivos en un entorno web.

## Funcionalidades

- Inicio de sesión de usuario administrador.
- Protección de páginas mediante sesión.
- Subida de archivos desde formulario web.
- Validación de extensión permitida: PDF, JPG, JPEG y PNG.
- Validación de tipo MIME.
- Límite de tamaño máximo de 5 MB.
- Renombrado seguro de archivos en el servidor.
- Listado de archivos registrados.
- Descarga segura mediante PHP.
- Eliminación segura de archivos.
- Registro de acciones en tabla de logs.
- Dashboard con estadísticas.
- Buscador en tiempo real.
- Gráfico de distribución de archivos.
- Modo claro y oscuro.
- Drag & Drop con vista previa.
- Interfaz responsive.

## Tecnologías utilizadas

- PHP 8.2
- MariaDB / MySQL
- PDO
- HTML5
- CSS3
- JavaScript
- Font Awesome
- SweetAlert2
- Chart.js
- AOS Animation
- XAMPP
- phpMyAdmin
- Visual Studio Code

## Estructura del proyecto

```text
gestion_archivos_seguro/
│
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── app.js
│   └── img/
│
├── classes/
│   └── GestorArchivos.php
│
├── includes/
│   ├── auth.php
│   └── config.php
│
├── logs/
│
├── uploads/
│   ├── .htaccess
│   └── index.php
│
├── descargar.php
├── eliminar.php
├── index.php
├── login.php
├── logout.php
├── subir.php
└── README.md
