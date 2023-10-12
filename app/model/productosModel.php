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
}