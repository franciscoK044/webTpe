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

    public function insertUser($email,$password, $rol){
        $query = $this->db->prepare('INSERT INTO users(email,password,rol) VALUES (?,?,?)');
        $query->execute([$email,$password,$rol]);
    }
    public function getByRol($rol){
        $query = $this->db->prepare('SELECT * FROM users WHERE rol = ?');
        $query->execute([$rol]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    function getCategory(){
            
        $query = $this->db->prepare('SELECT * FROM categoria');
        $query->execute();
        //tareas es un arreglo de tareas
        $category = $query->fetchAll(PDO::FETCH_OBJ);

        return $category;
    }
}
