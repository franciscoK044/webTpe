<?php
require_once './app/controller/productosController.php';
require_once './app/controller/categoriasController.php';
require_once './app/controller/authController.php';
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home';
    if (isset ($_GET['action'])){
        $action = $_GET['action'];
    }

// mostrar    ->        productoController->showProducts();
// agregar   ->         categoriaController->addCategoy();
// eliminar/:ID  ->     categoriaController->removeCategory($id); 
// finalizar/:ID  ->    categoriaController->finishTask($id);
// about ->             aboutController->showAbout();
// login ->             authContoller->showLogin();
// logout ->            authContoller->logout();
// auth                 authContoller->auth(); // toma los datos del post y autentica al usuario






    $params = explode('/', $action);
    switch ($params[0]) {
        case 'login':
            $controller = new AuthController();
            $controller->showLogin(); 
            break;
        case 'auth' :
            $controller = new AuthController();
            $controller->auth();
            break;
        case 'logout':
            $controller = new AuthController();
            $controller->logout();
            break;
        case 'register' :
            $controller = new AuthController();
            $controller->register();
            break;
        case 'verifyRegister' :
            $controller = new AuthController();
            $controller->verifyRegister();
            break;

        case 'index':
            $controller = new productosController();
            $controller->showIndex();
            break;
        
        case 'productos':
            $controller= new productosController();
            $controller->showProducts();
            break;
            
        case 'verProducto':
            $controller= new productosController();
            $controller->viewProductoID($params[1]);
            break;
            
        case 'agregarProducto' :
            $controller = new productosController();
            $controller->addProducto();
            break;

        case 'eliminarProducto' :
            $controller = new productosController();
            $controller->removeProducto($params[1]);
            break;
            
        case 'modificarProducto' :
            $controller = new productosController();
            $controller->mostrarFormEditProductos($params[1]);
            break;
        
        case 'enviarFormEditProduct' :
            $controller = new productosController();
            $controller-> modifyProducto();
            break;

        case 'categorias' :
            $controller = new categoriasController();
            $controller->ListCategory();
            break;
        case 'verCategoria' :
            $controller = new productosController();
            $controller->viewCategory($params[1]);
            break;
        case 'eliminar' :
            $controller = new categoriasController();
            $controller->removeCategory($params[1]);
            break;
        case 'agregar' :
            $controller = new categoriasController();
            $controller->addCategory();
            break;
        case 'modificar' :
            $controller = new categoriasController();
            $controller->mostrarFormEditCategory($params[1]);
            break;
        case 'enviarFormEditCategory' :
            $controller = new categoriasController();
            $controller->modifyCategory();
            break;
        default :
            $controller = new productosController();
            $controller->showIndex();
            break;
    }