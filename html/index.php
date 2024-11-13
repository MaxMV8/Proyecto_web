<?php
// Obtener los parámetros de la URL
$folder = isset($_GET['folder']) ? $_GET['folder'] : '';
$file = isset($_GET['file']) ? $_GET['file'] : '';

// Definir las carpetas permitidas para seguridad
$allowed_folders = ['img', 'css', 'php'];

// Verificar si la carpeta es válida
if (in_array($folder, $allowed_folders) && !empty($file)) {
    // Construir la ruta completa del archivo
    $file_path = __DIR__ . "/$folder/$file";

    // Verificar que el archivo existe
    if (file_exists($file_path)) {
        // Para archivos PHP, ejecutarlo en lugar de mostrarlo
        if ($folder === 'php') {
            include($file_path);
        } else {
            // Enviar el archivo con el tipo MIME correcto
            $mime_type = mime_content_type($file_path);
            header("Content-Type: $mime_type");
            readfile($file_path);
        }
    } else {
        echo "El archivo no existe.";
    }
} else {
    echo "Carpeta o archivo no permitido.";
}
?>

