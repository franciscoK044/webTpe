<?php

require_once './app/model/categoriaModel.php';
require_once './app/views/viewCategoria.phtml';
require_once './app/helpers/auhtHelper.php';

    class categoriasController{
        private $model;
        private $model2;
        private $view;
        private $auth;

        public function __construct(){

            $this->model = new categoriasModel();
            $this->view = new viewCategorias();
            $this->model2 = new productosModel();
            $this->auth = new AuthController();
        }

        function ListCategory(){

            $this->auth->checkLoggedIn();
            $category = $this->model->getCategory();
            $this->view->showCategorys($category);
        }


        function viewCategory($id){                             //es ver producto(cambiar)
            $products = $this->model->getProductWithCategory($id);
            $this->view->viewItem($products);
        }


        function getProduct(){
            $products = $this->model2->getProduct();
        }



        function removeCategory($id){
            $this->model->eliminaCategory($id);
            header("Location:" . BASE_URL . "categorias");
        }



        function addCategory(){
            $nombre_categoria = $_POST['nombre_categoria'];
            
            if (empty($nombre_categoria)){
                $this->view->mostrarError("Debe completar todos los campos");
                return;
            }
            $id = $this->model->insertCategory($nombre_categoria);
            if ($id){
                header("Location:" . BASE_URL . "home");
            }
            else{
                $this->view->mostrarError("error al insertar el usuario");
            }
        }


        function mostrarFormEditCategory($id){
            $this->view->mostrarFormEditCategory($id);
        }


        function modifyCategory(){
            $id = $_POST['id_categoria'];
            $nombre_categoria = $_POST['nombre_categoria'];
        
            if (empty($nombre_categoria)){
                $this->view->mostrarError("No ingreso bien los campos");
            }
            else{
                // Llama a la función actualizarCategoria con el nombre de la categoría y el ID
                $this->model->actualizarCategoria($id,$nombre_categoria);
                header("Location:" . BASE_URL . "categorias");
            }
        }
        
        function viewForm($id){
            $this->view->mostrarForm($id);
        }
    }