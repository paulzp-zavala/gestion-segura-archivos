<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Gestión Segura de Archivos</title>

    <!-- Hoja de estilos -->
    <link rel="stylesheet"
          href="/gestion_archivos_seguro/assets/css/style.css?v=4">

</head>

<body>

<?php if (empty($ocultar_encabezado)): ?>

<header class="topbar">

    <div class="topbar-content">

        <div>

            <h1>Gestión Segura de Archivos</h1>

            <p>
                Proyecto Seguridad Web - Apache
            </p>

        </div>

        <div class="user-box">

            <a href="/gestion_archivos_seguro/index.php"
               class="theme-btn">
                Inicio
            </a>

            <a href="/gestion_archivos_seguro/logout.php"
               class="logout-btn">
                Cerrar sesión
            </a>

        </div>

    </div>

</header>

<?php endif; ?>

<main>