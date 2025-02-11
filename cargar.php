<?php
// Verificar si se recibió un archivo
if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
    // Ruta donde se guardará la imagen (ruta absoluta)
    $uploadDir = __DIR__ . "/uploads/";

    // Nombre del archivo
    $fileName = basename($_FILES["image"]["name"]);

    // Ruta completa del archivo
    $uploadPath = $uploadDir . $fileName;

    // Mover el archivo de la ubicación temporal a la ruta de carga
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath)) {
        // La imagen se ha guardado correctamente
        echo "La imagen se ha guardado correctamente en: " . $uploadPath;
    } else {
        // Error al mover el archivo
        echo "Error al guardar la imagen.";
    }
} else {
    // Error al recibir la imagen
    echo "Error al recibir la imagen.";
}
?>
