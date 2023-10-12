<?php

    require_once './app/views/authView.phtml';
    require_once './app/model/authModel.php';
    require_once './app/helpers/auhtHelper.php';

    class AuthController{
        private $view;
        private $model;

        function __construct()
        {
            $this->model = new UserModel();
            $this->view = new AuthView();    

        }

        public function showLogin(){
            $this->view->showLogin();
        }

        public function register(){
            $this->view->showRegister();
        }

        public function verifyRegister() {
            if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['rol'])) {
                $userEmail = $_POST['email'];
                $userPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $rol = $_POST['rol'];
        
                // Realiza la inserción del usuario en la base de datos (asegúrate de proteger contra SQL Injection)
                $this->model->insertUser($userEmail, $userPassword, $rol);
        
                // Comprobar si el usuario existe en la base de datos
                $user = $this->model->getByEmail($userEmail);

                //verificar si el email ya esta en la db (hacer)
                
                if ($user) {
                    session_start();
                    $_SESSION["logueado"] = true;
                    $_SESSION['id_user'] = $user->id_user;
                    $_SESSION["email"] = $userEmail;
                    $_SESSION["rol"] = $rol; // Almacena el rol en la sesión
                    
                    header('Location:' .BASE_URL. 'index'); 

                } else {
                    // Error: No se pudo obtener el usuario después del registro
                    $this->view->showError("Error en el registro.");
                }
            } else {
                // Campos incorrectos o faltantes
                $this->view->showError("Datos incorrectos o faltantes.");
            }
        }
        

        public function auth(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'];
                $password = $_POST['password'];
        
                if (empty($email) || empty($password)) {
                    $this->view->showLogin("Faltan completar algunos datos");
                    return;
                }
        
                // Comprobar si el usuario existe en la base de datos
                $user = $this->model->getByEmail($email);
                
                if ($user) {
                    if (password_verify($password, $user->password)) {
                        // La contraseña es correcta, autenticación exitosa

                        // Iniciar sesión
                        session_start();
                        $_SESSION["logueado"] = true;
                        $_SESSION['id_user'] = $user->id_user;
                        $_SESSION["email"] = $email;
                        $_SESSION["rol"] = $user->rol; // Almacena el rol en la sesión
                        
                            header('Location:' .BASE_URL. 'index'); 

                    } else {
                        // Las credenciales son incorrectas
                        $this->view->showLogin("Usuario o contraseña incorrectos");
                    }
                } else {
                    // El usuario no existe
                    $this->view->showLogin("Usuario no encontrado");
                }
            } else {
                // No se envió un formulario POST, mostrar la página de inicio de sesión
                $this->view->showLogin();
            }
        }

        public function checkLoggedIn(){
            session_start();
            if(!isset($_SESSION["id_user"])){     //SI NO ESTA SETEADO EL user (NO HAY USUARIO LOGUEADO)
                header('Location:' .BASE_URL. 'login');   
            }
        }

        public function logout(){
            AuthHelper::logout();
            header('Location:' .BASE_URL. 'login');   
        }
    }