<?php

class Database {
    private $pdo;

    public function __construct() {
        // Configuración de la base de datos
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        $user = DB_USER;
        $password = DB_PASSWORD;
        $email = DB_EMAIL;

        try {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error en la conexión a la base de datos: ' . $e->getMessage());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }
}

// Crear una instancia de la clase Database
$database = new Database();
$pdo = $database->getPdo();

// En este punto, tienes una conexión a la base de datos PDO ($pdo) que puedes utilizar para interactuar con la base de datos.

?>
