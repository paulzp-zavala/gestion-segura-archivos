<?php

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/classes/GestorArchivos.php';

$gestor = new GestorArchivos($conexion);
$archivos = $gestor->listar();

$totalArchivos = count($archivos);
$totalBytes = 0;

foreach ($archivos as $archivo) {
    $totalBytes += $archivo['tamano'];
}

$totalMB = round($totalBytes / 1024 / 1024, 2);

$usuario = $_SESSION['usuario_nombre'];
$rol = $_SESSION['usuario_rol'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestión Segura de Archivos</title>

    <link rel="stylesheet"
          href="/gestion_archivos_seguro/assets/css/style.css?v=5">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css"
          rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<header class="topbar">
    <div>
        <h1>
            <i class="fa-solid fa-shield-halved"></i>
            Gestión Segura de Archivos
        </h1>

        <p>Panel privado de administración</p>
    </div>

    <div class="user-box">
        <span>
            <i class="fa-solid fa-user"></i>
            <?php echo limpiar($usuario); ?>
        </span>

        <button id="themeToggle"
                class="theme-btn"
                title="Cambiar modo">
            <i class="fa-solid fa-moon"></i>
        </button>

        <a href="logout.php"
           class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            Cerrar sesión
        </a>
    </div>
</header>

<main>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="mensaje toast-message">
            <i class="fa-solid fa-circle-check"></i>

            <?php
            echo limpiar($_SESSION['mensaje']);
            unset($_SESSION['mensaje']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error toast-message">
            <i class="fa-solid fa-triangle-exclamation"></i>

            <?php
            echo limpiar($_SESSION['error']);
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <section class="dashboard"
             data-aos="fade-up">

        <div class="card-info">
            <div class="icon blue">
                <i class="fa-solid fa-folder"></i>
            </div>

            <div>
                <h3 class="counter"
                    data-target="<?php echo $totalArchivos; ?>">
                    <?php echo $totalArchivos; ?>
                </h3>

                <p>Archivos registrados</p>
            </div>
        </div>

        <div class="card-info">
            <div class="icon green">
                <i class="fa-solid fa-hard-drive"></i>
            </div>

            <div>
                <h3><?php echo $totalMB; ?> MB</h3>
                <p>Espacio utilizado</p>
            </div>
        </div>

        <div class="card-info">
            <div class="icon orange">
                <i class="fa-solid fa-user-shield"></i>
            </div>

            <div>
                <h3><?php echo limpiar($usuario); ?></h3>
                <p><?php echo limpiar($rol); ?></p>
            </div>
        </div>

        <div class="card-info admin-access-card">
            <div class="icon admin-color">
                <i class="fa-solid fa-lock"></i>
            </div>

            <div class="admin-access-content">
                <h3>Área administrativa</h3>

                <p>Protegida por Apache</p>

                <a href="/gestion_archivos_seguro/administracion/"
                   class="admin-access-btn">
                    <i class="fa-solid fa-shield-halved"></i>
                    Ingresar al panel
                </a>
            </div>
        </div>

    </section>

    <section class="card upload-card"
             data-aos="fade-up">

        <h2>
            <i class="fa-solid fa-cloud-arrow-up"></i>
            Subir Archivo
        </h2>

        <p>
            Formatos permitidos:
            <strong>PDF, JPG, JPEG y PNG</strong>.
            Tamaño máximo: <strong>5 MB</strong>.
        </p>

        <form action="subir.php"
              method="POST"
              enctype="multipart/form-data"
              class="upload-form"
              id="uploadForm">

            <label class="upload-box"
                   id="dropArea">

                <i class="fa-solid fa-file-arrow-up"></i>

                <span id="uploadText">
                    Arrastra un archivo aquí o haz clic para seleccionar
                </span>

                <small>PDF • JPG • JPEG • PNG</small>

                <input type="file"
                       name="archivo"
                       id="archivoInput"
                       required>
            </label>

            <div id="previewBox"
                 class="preview-box"></div>

            <button type="submit">
                <i class="fa-solid fa-upload"></i>
                Subir archivo
            </button>

        </form>

    </section>

    <section class="card"
             data-aos="fade-up">

        <div class="section-header">

            <h2>
                <i class="fa-solid fa-folder-open"></i>
                Archivos Registrados
            </h2>

            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text"
                       id="buscador"
                       placeholder="Buscar archivo...">
            </div>

        </div>

        <?php if (empty($archivos)): ?>

            <p class="empty">
                <i class="fa-regular fa-folder-open"></i>
                No existen archivos registrados.
            </p>

        <?php else: ?>

            <div class="table-container">

                <table id="tablaArchivos">

                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Archivo</th>
                        <th>Tipo</th>
                        <th>Tamaño</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Descargar</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($archivos as $archivo): ?>

                        <tr>
                            <td>
                                <?php echo $archivo['id']; ?>
                            </td>

                            <td>
                                <i class="fa-solid fa-file"></i>

                                <?php
                                echo limpiar($archivo['nombre_original']);
                                ?>
                            </td>

                            <td>
                                <?php echo limpiar($archivo['tipo']); ?>
                            </td>

                            <td>
                                <?php
                                echo number_format(
                                    $archivo['tamano'] / 1024,
                                    2
                                );
                                ?> KB
                            </td>

                            <td>
                                <?php
                                echo limpiar($archivo['fecha_subida']);
                                ?>
                            </td>

                            <td>
                                <span class="status">
                                    <i class="fa-solid fa-circle-check"></i>
                                    Disponible
                                </span>
                            </td>

                            <td>
                                <a class="btn-download"
                                   href="descargar.php?id=<?php echo $archivo['id']; ?>">
                                    <i class="fa-solid fa-download"></i>
                                </a>
                            </td>

                            <td>
                                <a class="btn-delete delete-link"
                                   href="eliminar.php?id=<?php echo $archivo['id']; ?>">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>

    </section>

    <section class="card chart-card"
             data-aos="fade-up">

        <h2>
            <i class="fa-solid fa-chart-pie"></i>
            Distribución de archivos
        </h2>

        <canvas id="graficoArchivos"></canvas>

    </section>

</main>

<footer>
    <p>
        <strong>Paul Andrés Zavala Palomeque</strong> |
        Proyecto de Desarrollo Web - UTPL |
        <?php echo date('Y'); ?>
    </p>
</footer>

<script>
const chartData = {
    pdf: <?php
        echo count(
            array_filter(
                $archivos,
                fn($a) => str_contains($a['tipo'], 'pdf')
            )
        );
    ?>,

    imagenes: <?php
        echo count(
            array_filter(
                $archivos,
                fn($a) => str_contains($a['tipo'], 'image')
            )
        );
    ?>
};
</script>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script src="assets/js/app.js"></script>

<script>
AOS.init({
    duration: 800,
    once: true
});
</script>

</body>
</html>