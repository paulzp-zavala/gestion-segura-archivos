<?php
$ocultar_encabezado = true;

require_once '../includes/header.php';

$usuarioApache = $_SERVER['PHP_AUTH_USER'] ?? 'No identificado';
?>

<section class="admin-page">

    <div class="admin-card">

        <div class="admin-icon">
            🔒
        </div>

        <span class="admin-label">
            Área protegida
        </span>

        <h2>Panel de Administración</h2>

        <p class="admin-description">
            Acceso autorizado mediante autenticación básica de Apache
            utilizando los archivos <strong>.htaccess</strong> y
            <strong>.htpasswd</strong>.
        </p>

        <div class="admin-info">

            <div class="admin-row">
                <span>Sección:</span>
                <strong>Administración</strong>
            </div>

            <div class="admin-row">
                <span>Método:</span>
                <strong>Basic Authentication</strong>
            </div>

            <div class="admin-row">
                <span>Servidor web:</span>
                <strong>Apache 2.4</strong>
            </div>

            <div class="admin-row">
                <span>Usuario autenticado:</span>
                <strong>
                    <?php echo htmlspecialchars($usuarioApache); ?>
                </strong>
            </div>

            <div class="admin-row">
                <span>Estado:</span>
                <strong class="admin-status">
                    Acceso autorizado
                </strong>
            </div>

        </div>

        <div class="admin-warning">
            Esta zona es exclusiva para personal autorizado.
        </div>

<div class="admin-actions">

    <a href="/gestion_archivos_seguro/index.php"
       class="admin-button">

        <i class="fa-solid fa-house"></i>

        Volver al sistema

    </a>

    <a href="/gestion_archivos_seguro/logout_admin.php"
       class="admin-button secondary">

        <i class="fa-solid fa-right-from-bracket"></i>

        Finalizar acceso administrativo

    </a>

</div>

    </div>

</section>

<?php
require_once '../includes/footer.php';
?>