<?php
$ocultar_encabezado = true;

require_once __DIR__ . '/includes/header.php';
?>

<section class="admin-page">

    <div class="admin-card">

        <div class="admin-icon">
            🚪
        </div>

        <span class="admin-label">
            Acceso administrativo
        </span>

        <h2>Acceso administrativo finalizado</h2>

        <p class="admin-description">
            Ha salido del panel de administración.
        </p>

        <div class="admin-warning">

            <strong>Importante:</strong>

            <p>
                La autenticación básica de Apache es administrada por el
                navegador. Por esta razón, las credenciales pueden permanecer
                activas mientras la ventana del navegador continúe abierta.
            </p>

            <p>
                Para que Apache vuelva a solicitar el usuario y la contraseña,
                cierre completamente el navegador o utilice una ventana privada.
            </p>

        </div>

        <div class="admin-actions">

            <a href="/gestion_archivos_seguro/index.php"
               class="admin-button">

                Volver al sistema

            </a>

        </div>

    </div>

</section>

<?php
require_once __DIR__ . '/includes/footer.php';
?>