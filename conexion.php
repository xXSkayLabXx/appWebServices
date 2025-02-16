<?php
	
require('config.php');

/**
 * CLase para conexión a Base de Datos
 */
class Conexion
{
	
	protected $db;

	public function __construct()
	{
		$this->db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

		if($this->db->connect_errno){
			echo "Falló al conectar con la Base de Datos ".$this->db->connect_errno;
			return;
		}

		$this->db->set_charset(DB_CHARSET);
	}
}

?>