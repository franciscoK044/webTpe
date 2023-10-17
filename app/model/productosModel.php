<?php

    class productosModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=based_tpe;charset=utf8','root','');
        }   
        
    //obtiene toda la lista de tareas de la base de dato;
    function getProduct(){
        
        $query = $this->db->prepare('SELECT * FROM producto');
        $query-> execute();
        //tareas es un arreglo de tareas
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    function getProductByID($id_producto) {
        $query = $this->db->prepare('SELECT * FROM producto  WHERE id_producto = ?');
        $query->execute([$id_producto]);
        $productByID = $query->fetch(PDO::FETCH_OBJ);
    
        return $productByID;
    }

    function insertProtucto($nombre_producto, $modelo, $precio, $id_categoria){
        $query = $this->db->prepare('INSERT INTO productos (nombre_producto, modelo, precio, id_categoria VALUES(?,?,?,?)');
        $query-> execute([$nombre_producto, $modelo, $precio, $id_categoria]);
        return $this->db->lastInsertId();
    }

    function eliminarProducto($id){
        
        $producto= $this->db->prepare("DELETE FROM productos WHERE id_producto= ?");
        $producto->execute(array($id));
        

    }

    function updateProductos($id_productos, $nombre_producto, $modelo, $precio, $id_categoria){
        $consulta = $this->db->prepare('UPDATE productos SET (nombre_producto, modelo, precio, id_categoria) = ? WHERE id_producto = ?');
        $consulta->execute([$id_productos, $nombre_producto, $modelo, $precio, $id_categoria]);
    }

}