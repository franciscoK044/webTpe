<?php


require_once './app/model/categoriaModel.php';
require_once './app/model/productosModel.php';
require_once './app/views/viewHome.phtml';

    class productosController{
        private $model;
        private $view;
        //private $categoriasModel;

        public function __construct(){
            $this->model = new productosModel();
            //$this->categoriasModel = new categoriasModel();
            $this->view = new viewHome();
        }


        public function showIndex(){

            $this->view->showIndex();

        }

        function showProducts(){
            $products = $this->model->getProduct();
            //$cat = $this->categoriasModel->getCategory();
            //$this->view->viewProduct($products, $cat);
            //$this->view->viewProduct($products);
        }
        
    


        
    }