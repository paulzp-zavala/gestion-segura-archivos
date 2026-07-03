<?php

class GestorArchivos
{
    private PDO $conexion;
    private string $directorio;

    private array $extensionesPermitidas = ['pdf', 'jpg', 'jpeg', 'png'];
    private array $mimePermitidos = ['application/pdf', 'image/jpeg', 'image/png'];

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
        $this->directorio = UPLOAD_DIR;
    }

    public function subir(array $archivo): string
    {
        if ($archivo['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error al subir el archivo.');
        }

        if ($archivo['size'] > MAX_FILE_SIZE) {
            throw new Exception('El archivo supera el tamaño máximo permitido.');
        }

        $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $this->extensionesPermitidas, true)) {
            throw new Exception('Extensión no permitida.');
        }

        $mime = mime_content_type($archivo['tmp_name']);

        if (!in_array($mime, $this->mimePermitidos, true)) {
            throw new Exception('Tipo MIME no permitido.');
        }

        $nombreOriginal = basename($archivo['name']);
        $nombreServidor = uniqid('archivo_', true) . '.' . $extension;
        $rutaDestino = $this->directorio . $nombreServidor;

        if (!move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
            throw new Exception('No se pudo guardar el archivo.');
        }

        $sql = "INSERT INTO archivos 
                (nombre_original, nombre_guardado, tipo, tamano)
                VALUES 
                (:nombre_original, :nombre_guardado, :tipo, :tamano)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            'nombre_original' => $nombreOriginal,
            'nombre_guardado' => $nombreServidor,
            'tipo' => $mime,
            'tamano' => $archivo['size']
        ]);

        return 'Archivo subido correctamente.';
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM archivos ORDER BY fecha_subida DESC";
        $stmt = $this->conexion->query($sql);
        return $stmt->fetchAll();
    }

    public function obtenerPorId(int $id): array
    {
        $sql = "SELECT * FROM archivos WHERE id = :id LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['id' => $id]);
        $archivo = $stmt->fetch();

        if (!$archivo) {
            throw new Exception('Archivo no encontrado.');
        }

        return $archivo;
    }

    public function eliminar(int $id): string
    {
        $archivo = $this->obtenerPorId($id);

        $ruta = $this->directorio . basename($archivo['nombre_guardado']);

        if (file_exists($ruta)) {
            unlink($ruta);
        }

        $sql = "DELETE FROM archivos WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['id' => $id]);

        return 'Archivo eliminado correctamente.';
    }
}