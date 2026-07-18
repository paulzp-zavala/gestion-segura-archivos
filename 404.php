<?php
http_response_code(404);

// Oculta el encabezado y el menú en esta página
$ocultar_encabezado = true;

require_once 'includes/header.php';
?>

<section class="error-page">

    <div class="error-card">

        <div class="error-icon">
            ⚠
        </div>

        <span class="error-code">
            ERROR 404
        </span>

        <h2>
            Recurso no encontrado
        </h2>

        <p>
            La página solicitada no existe, fue movida o la dirección ingresada es incorrecta.
        </p>

        <div class="error-actions">

            <a href="/gestion_archivos_seguro/index.php"
               class="error-button">
                Volver al inicio
            </a>

            <a href="/gestion_archivos_seguro/login.php"
               class="error-button secondary">
                Iniciar sesión
            </a>

        </div>

        <small class="error-help">
            Si considera que se trata de un error del sistema,
            comuníquese con el administrador.
        </small>

    </div>

</section>

<?php
require_once 'includes/footer.php';
?>
