<?php
/**
 * Configuración de conexión a MySQL
 * Para XAMPP local
 */

class Database {
    private $host = 'localhost';
    private $db_name = 'tienda';
    private $user = 'root';
    private $pass = ''; // XAMPP no tiene contraseña por defecto
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new mysqli(
                $this->host,
                $this->user,
                $this->pass,
                $this->db_name
            );

            // Verificar si hay error de conexión
            if ($this->conn->connect_error) {
                throw new Exception('Error de conexión: ' . $this->conn->connect_error);
            }

            // Establecer charset
            $this->conn->set_charset("utf8mb4");
            
            return $this->conn;
            
        } catch (Exception $e) {
            echo "Error de Conexión a la Base de Datos: " . $e->getMessage();
            die();
        }
    }
}
?>