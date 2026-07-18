<?php
$ocultar_encabezado = true;

require_once 'includes/header.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

/*
|--------------------------------------------------------------------------
| Datos simulados para demostrar la URL amigable
|--------------------------------------------------------------------------
| En una aplicación real, estos datos se consultarían desde la base de datos.
*/

$archivos = [
    1 => [
        'nombre' => 'Reglamento_interno.pdf',
        'tipo' => 'Documento PDF',
        'tamano' => '1.8 MB',
        'estado' => 'Disponible',
        'fecha' => '10 de julio de 2026'
    ],
    2 => [
        'nombre' => 'Manual_seguridad_web.pdf',
        'tipo' => 'Documento PDF',
        'tamano' => '2.4 MB',
        'estado' => 'Disponible',
        'fecha' => '11 de julio de 2026'
    ],
    3 => [
        'nombre' => 'Informe_APE_seguridad.docx',
        'tipo' => 'Documento Word',
        'tamano' => '850 KB',
        'estado' => 'Disponible',
        'fecha' => '12 de julio de 2026'
    ]
];

$archivo = ($id !== false && $id !== null && isset($archivos[$id]))
    ? $archivos[$id]
    : null;
?>

<section class="archivo-page">

    <div class="archivo-card">

        <span class="archivo-label">
            URL amigable
        </span>

        <h2>Detalle del archivo</h2>

        <?php if ($archivo): ?>

            <div class="archivo-id">
                <?php echo htmlspecialchars((string) $id); ?>
            </div>

            <div class="archivo-datos">

                <div class="archivo-fila">
                    <span>Nombre:</span>
                    <strong>
                        <?php echo htmlspecialchars($archivo['nombre']); ?>
                    </strong>
                </div>

                <div class="archivo-fila">
                    <span>Tipo:</span>
                    <strong>
                        <?php echo htmlspecialchars($archivo['tipo']); ?>
                    </strong>
                </div>

                <div class="archivo-fila">
                    <span>Tamaño:</span>
                    <strong>
                        <?php echo htmlspecialchars($archivo['tamano']); ?>
                    </strong>
                </div>

                <div class="archivo-fila">
                    <span>Estado:</span>
                    <strong class="estado-disponible">
                        <?php echo htmlspecialchars($archivo['estado']); ?>
                    </strong>
                </div>

                <div class="archivo-fila">
                    <span>Fecha de carga:</span>
                    <strong>
                        <?php echo htmlspecialchars($archivo['fecha']); ?>
                    </strong>
                </div>

            </div>

            <div class="reescritura-info">
                <p>
                    El usuario ingresó:
                </p>

                <code>
                    /gestion_archivos_seguro/archivo/<?php echo htmlspecialchars((string) $id); ?>
                </code>

                <p>
                    Apache la reescribió internamente como:
                </p>

                <code>
                    archivo.php?id=<?php echo htmlspecialchars((string) $id); ?>
                </code>
            </div>

        <?php else: ?>

            <div class="archivo-no-encontrado">
                <h3>Archivo no disponible</h3>

                <p>
                    El identificador solicitado no corresponde a un archivo
                    registrado en esta demostración.
                </p>
            </div>

        <?php endif; ?>

        <a href="/gestion_archivos_seguro/index.php"
           class="error-button">
            Volver al inicio
        </a>

    </div>

</section>

<?php
require_once 'includes/footer.php';
?>