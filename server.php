<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require('conexion.php');

class serverSoap extends Conexion {
    
    public function saludar($name) {
        return "Hola, " . $name . "!";
    }

    /**
     * Método recursivo para realizar operaciones básicas
     * @param float $num1 Primer número
     * @param float $num2 Segundo número
     * @param string $operacion Tipo de operación: suma, resta, multiplicacion, division
     * @return float|string Resultado de la operación o mensaje de error
     */
    public function operacion($num1, $num2, $operacion) {
        if (!in_array($operacion, ['suma', 'resta', 'multiplicacion', 'division'])) {
            return "Operación no válida. Usa: suma, resta, multiplicacion, division.";
        }

        if ($operacion === 'division' && $num2 == 0) {
            return "Error: No se puede dividir por cero.";
        }

        switch ($operacion) {
            case 'suma':
                return $num2 == 0 ? $num1 : $this->operacion($num1 + 1, $num2 - 1, 'suma');
            case 'resta':
                return $num2 == 0 ? $num1 : $this->operacion($num1 - 1, $num2 - 1, 'resta');
            case 'multiplicacion':
                return $num2 == 1 ? $num1 : $num1 + $this->operacion($num1, $num2 - 1, 'multiplicacion');
            case 'division':
                return $num1 < $num2 ? 0 : 1 + $this->operacion($num1 - $num2, $num2, 'division');
        }
    }
}

$options = array('uri' => 'http://localhost/webservices/appwebservices/');
$server = new SoapServer(NULL, $options);
$server->setClass('serverSoap');

header("Content-Type: text/xml; charset=utf-8");
$server->handle();

?>