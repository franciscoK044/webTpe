<?php

    class productosModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=db_tecnotandil;charset=utf8','root','');
        }   
        
    function getProduct(){
        
        $query = $this->db->prepare('SELECT * FROM producto');
        $query-> execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    function getProductWithCategory($id_producto) {
        $query = $this->db->prepare('
            SELECT p.*, c.nombre_categoria 
            FROM producto AS p 
            INNER JOIN categoria AS c ON p.id_categoria = c.id_categoria 
            WHERE p.id_producto = :id_producto'
        );
    
        $query->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $query->execute();
        $productWithCategory = $query->fetch(PDO::FETCH_OBJ);
    
        return $productWithCategory;
    }

    function insertProducto($nombre_producto, $modelo, $precio, $id_categoria){
        $query = $this->db->prepare('INSERT INTO producto (nombre_producto, modelo, precio, id_categoria) VALUES (?,?,?,?)');
        $query->execute([$nombre_producto, $modelo, $precio, $id_categoria]);
        return $this->db->lastInsertId();
    }
    

    function eliminarProducto($id){
        
        $producto= $this->db->prepare("DELETE FROM producto WHERE id_producto= ?");
        $producto->execute(array($id));
        

    }

    function updateProductos($id_producto, $nombre_producto, $modelo, $precio, $id_categoria){
        $consulta = $this->db->prepare('UPDATE producto SET nombre_producto=?, modelo=?, precio=?, id_categoria=? WHERE id_producto = ?');
        $consulta->execute(array($nombre_producto, $modelo, $precio, $id_categoria, $id_producto));
    }


}