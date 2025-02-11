<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

// Credenciales de Jira
$email = "george.maldonado@siigo.com"; // Reemplaza con tu email de Jira
$api_token = "ATATT3xFfGF0PH1x0iAT6l-ADgYdoKIP4zGS2JQscFuUNS-JUm6hWhBbLYdr0Oos5St6kmvD8FM7lqLV9Z78FfqmsBccjtnasC9KhYKaZWsmqfD3dCBGuwuTuy09EUH7PvGvUZeL52x2ovVrmXVlLNocWe3dYrnUsAsenrFuAbY4MVBQWAZAaxE=CEF7EFD1"; // Reemplaza con tu API Token

$url = "https://siigo.atlassian.net/rest/api/3/project";

// Configuración de la solicitud
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Basic " . base64_encode("$email:$api_token"),
    "Accept: application/json"
]);

$response = curl_exec($ch);
curl_close($ch);

// Enviar respuesta al cliente
echo $response;