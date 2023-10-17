<?php


require_once './app/model/categoriaModel.php';
require_once './app/model/productosModel.php';
require_once './app/views/viewHome.phtml';

    class productosController{
        private $model;
        private $view;
        private $id;
        private $categoriasModel;

        public function __construct(){
            $this->model = new productosModel();
            $this->categoriasModel = new categoriasModel();
            $this->view = new viewHome();
            session_start();
        }


        public function showIndex(){

            $this->view->showIndex();

        }

        function showProducts(){
            $products = $this->model->getProduct();
            $categorias= $this->categoriasModel-> getCategory();
            $this->view->viewProducts($products,$categorias);
        }

        function mostrarFormEditCategory($id_categoria){
            $categoria = $this->model->getCategoryById($id_categoria);
            $this->view->mostrarFormEditCategory($id_categoria, $categoria->nombre_categoria);
        }

        function viewProductoID($id_producto){                            
            $products = $this->model->getProductByID($id_producto);
            $categoria = $this->categoriasModel->getCategoryById($products -> id_categoria);
            $this->view->viewProductoID($id_producto, $products -> nombre_producto, $products -> precio, $products -> modelo , $categoria -> nombre_categoria);
        }

        function addProducto(){
            if ($_SERVER ['REQUEST_METHOD']=== 'POST'){

                $nombre_producto = $_POST['nombre_producto'];
                $modelo = $_POST['modelo'];
                $precio = $_POST['precio'];
                $nombre_categoria = $_POST['nombre_categoria'];

                $categoria = $this->categoriasModel->getCategoryByNombre($nombre_categoria);

                
                $id = $this->model->insertProtucto($nombre_producto, $modelo, $precio, $categoria);
                if ($id){
                   header("Location:" . BASE_URL . "productos");
                }
                else{
                    $this->view->mostrarError("error al insertar el usuario");
                }
           }
        }

        function removeProducto($id_producto){
            $this->model->eliminarProducto($id_producto);
            header("Location:" . BASE_URL . "productos");
        }

        function mostrarFormEditProductos($id_producto){
            $producto = $this->model->getProductByID($id_producto);
            $this->view->mostrarFormEditProducto($id_producto, $producto -> $nombre_producto, $producto -> $modelo, $producto -> $precio , $producto -> $id_categoria);
        }

        function modifyProducto(){
            $id = $_POST['id_producto'];
            $nombre_producto = $_POST['nombre_producto'];
            $modelo = $_POST['modelo'];
            $precio = $_POST['precio'];
            $nombre_categoria = $_POST['nombre_categoria'];

    
                $this->model->updateProducto($id,$nombre_producto, $modelo, $precio, $categoria);
                header("Location:" . BASE_URL . "productos");
            }
        
    }