<?php

class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=based_tpe;charset=utf8', 'root', '');
    }

    public function getByEmail($email) {
        $query = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    //public function getUserByEmail($email) {
    //    $query = $this->db->prepare('SELECT * FROM users WHERE email = ?');
    //    $query->execute([$email]);
    
    //    return $query->fetch(PDO::FETCH_OBJ);
    //}

    public function insertUser($email,$password){
        $query = $this->db->prepare('INSERT INTO users(email,password) VALUES (?,?)');
        $query->execute([$email,$password]);
    }
    public function getByRol($rol){
        $query = $this->db->prepare('SELECT * FROM users WHERE rol = ?');
        $query->execute([$rol]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    //function insertProducto($nombre,$precio,$id_categoria){
        // Inserta los datos en la tabla de productos
    //    $query = $this->db->prepare("INSERT INTO producto (nombre_producto, precio, id_categoria) VALUES (?, ?, ?)");
    //    $query->execute([$nombre, $precio, $id_categoria]);
    //}

    //function getCategory(){
            
     //   $query = $this->db->prepare('SELECT * FROM categoria');
     //   $query->execute();
     //   //tareas es un arreglo de tareas
     //   $category = $query->fetchAll(PDO::FETCH_OBJ);

     //   return $category;
   // }
}
