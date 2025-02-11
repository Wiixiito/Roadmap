<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../dompdf/autoload.inc.php'; // Subimos un nivel y luego accedemos a dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

// Obtener los datos del certificado desde la solicitud POST
$nombre = $_POST['nombre'];
$nombre_alumno = $_POST['nombre_alumno'];
$email = $_POST['email'];

// URL de la página imprimible del certificado
$certificado_url = "https://productoappa.shop/ProductoApp/certificado.html?nombre=" . urlencode($nombre) . "&nombre_alumno=" . urlencode($nombre_alumno);

// Mapear los nombres de los meses en español
$meses = [
    'January' => 'enero',
    'February' => 'febrero',
    'March' => 'marzo',
    'April' => 'abril',
    'May' => 'mayo',
    'June' => 'junio',
    'July' => 'julio',
    'August' => 'agosto',
    'September' => 'septiembre',
    'October' => 'octubre',
    'November' => 'noviembre',
    'December' => 'diciembre'
];
$mesActual = $meses[date("F")];
$fechaFormateada = date("d") . " de " . $mesActual . " de " . date("Y");

$mensaje_felicitacion = "
<p>¡Felicidades <strong>$nombre_alumno</strong>!</p>
<p>Has completado el curso <strong>$nombre</strong> con éxito. Aquí tienes tu certificado de finalización.</p>
";

// Contenido del correo electrónico
$certificado_html = "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Certificado de Logro</title>
</head>
<body style='max-width: 900px; margin: 0 auto; background-color: #ffffff; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3); padding: 20px; box-sizing: border-box;'>
    <div style='max-width: 900px; margin: 0 auto; background-color: #348feb; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3); padding: 20px; box-sizing: border-box;'>
        <div style='max-width: 900px; margin: 0 auto; background-color: #348feb; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3); padding: 20px; box-sizing: border-box;'>
            <div style='text-align: center;'>
                <img src='https://productoappa.shop/ProductoApp/fotos/logoblanco.png' alt='Logo izquierdo' style='width: 200px; height: 140px; margin-bottom: 20px;'>
              <h4 style='color: white;'>CERTIFICADO DE FINALIZACIÓN</h4>
                <p style='color: white;'>Por su destacada participación y dedicación en este curso otorgamos el certificado de:</p>
                <h1 style='color: white;'>$nombre</h1>
            </div>
            <div style='text-align: center;'>
                <img src='https://productoappa.shop/ProductoApp/fotos/win.png' alt='Logo izquierdo' style='width: 200px; height: 180px; margin: 20px 0;'>
                <p style='color: white;'>Instructores: Producto Siigo Latam</p>
                <h2 style='color: white;'>$nombre_alumno</h2>
                <p style='color: white;'>Fecha: $fechaFormateada</p>
                <img src='https://productoappa.shop/ProductoApp/fotos/proposito.png' alt='Imagen adicional' style='width: 300px; height: 120px; margin-top: 40px;'>
            </div>
        </div>
    </div>
</body>
</html>

";

$mensaje_completo = $mensaje_felicitacion . $certificado_html;

// Generar PDF usando Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($certificado_html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$pdf_content = $dompdf->output();

// Configurar el correo electrónico con archivo adjunto
$from = "productoapp@productoappa.shop";
$boundary = md5("random"); // define boundary with a md5 hashed value

$headers = "From:" . $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

$body = "--$boundary\r\n";
$body .= "Content-Type: text/html; charset=UTF-8\r\n";
$body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$body .= $mensaje_completo . "\r\n\r\n";

$body .= "--$boundary\r\n";
$body .= "Content-Type: application/pdf; name=\"certificado.pdf\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n";
$body .= "Content-Disposition: attachment; filename=\"certificado.pdf\"\r\n\r\n";
$body .= chunk_split(base64_encode($pdf_content)) . "\r\n\r\n";

$body .= "--$boundary--";

if (mail($email, "Certificado de Logro", $body, $headers)) {
    echo "The email message was sent.";
} else {
    echo "Failed to send the email message.";
}
?>
