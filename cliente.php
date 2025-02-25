<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$options = array(
    'location' => 'http://localhost/webservices/appwebservices/server.php',
    'uri' => 'http://localhost/webservices/appwebservices',
    'trace' => 1,
    'exceptions' => true
);

try {
    $client = new SoapClient(NULL, $options);
    $nombre = 'Usuario';

    echo $client->saludar($nombre) . "</br>";

    $num1 = 10;
    $num2 = 5;

    echo "Suma: " . $client->operacion($num1, $num2, 'suma') . "</br>";
    echo "Resta: " . $client->operacion($num1, $num2, 'resta') . "</br>";
    echo "Multiplicación: " . $client->operacion($num1, $num2, 'multiplicacion') . "</br>";
    echo "División: " . $client->operacion($num1, $num2, 'division') . "</br>";

    echo "<h3>Última solicitud SOAP:</h3><pre>" . htmlspecialchars($client->__getLastRequest()) . "</pre>";
    echo "<h3>Última respuesta SOAP:</h3><pre>" . htmlspecialchars($client->__getLastResponse()) . "</pre>";

} catch (SoapFault $e) {
    echo "Error SOAP: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error General: " . $e->getMessage();
}

?>