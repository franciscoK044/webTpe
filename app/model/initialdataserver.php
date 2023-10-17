<?php

class InitialDataSeeder {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createTables() {
        // Crear tablas en la base de datos
        $sql = "
        -- Tabla de categorías
        CREATE TABLE IF NOT EXISTS categorias (
            id_categoria INT AUTO_INCREMENT PRIMARY KEY,
            nombre_categoria VARCHAR(255) NOT NULL
        );

        -- Tabla de productos
        CREATE TABLE IF NOT EXISTS productos (
            id_producto INT AUTO_INCREMENT PRIMARY KEY,
            nombre_producto VARCHAR(255) NOT NULL,
            precio DECIMAL(10, 2) NOT NULL,
            modelo VARCHAR(255) NOT NULL,
            id_categoria INT NOT NULL,
            FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
        );
    ";

        try {
            $this->pdo->exec($sql);
            echo "Tablas creadas con éxito.\n";
        } catch (PDOException $e) {
            die("Error al crear las tablas: " . $e->getMessage());
        }
    }

    public function insertInitialData() {
        // Insertar datos iniciales en la base de datos
        $sql = "
            -- Datos iniciales de categorías
            INSERT INTO categorias (nombre_categoria) VALUES
            ('Electrónica'),
            ('Ropa'),
            ('Alimentación');
    
            -- Datos iniciales de productos
            INSERT INTO productos (nombre_producto, precio, modelo, id_categoria) VALUES
            ('Teléfono', 399.99, 'Modelo 1', 1),
            ('Camiseta', 19.99, 'Modelo 2', 2),
            ('Manzanas', 2.99, 'Modelo 3', 3);
    
            -- Puedes agregar más datos iniciales aquí
        ";
    
        try {
            $this->pdo->exec($sql);
            echo "Datos iniciales insertados con éxito.\n";
        } catch (PDOException $e) {
            die("Error al insertar datos iniciales: " . $e->getMessage());
        }
    }
}
?>
