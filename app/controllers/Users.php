<?php
    class Users extends Controller{
        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function login(){

            // GET
            if($_SERVER['REQUEST_METHOD'] != 'POST'){
                $this->view('users/login');
            } else {
                // POST
            }
        }

        public function register(){
            // GET
            if($_SERVER['REQUEST_METHOD'] != 'POST'){
                $form = [
                    'first_name' => '',
                    'last_name' => '',
                    'email' => '',
                    'username' => '',
                    'password' => '',
                    'confirm_password' => '',
                ];

                $errors = [
                    'first_name' => '',
                    'last_name' => '',
                    'email' => '',
                    'username' => '',
                    'password' => '',
                    'confirm_password' => '',
                ];

                $data = [
                    'form' => $form,
                    'errors' => $errors,
                ];

                $this->view('users/register', $data);
            } else {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $form = [
                    'first_name' => trim($_POST['firstName']),
                    'last_name' => trim($_POST['lastName']),
                    'email' => trim($_POST['email']),
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['password2']),
                ];

                $errors = [
                    'first_name' => '',
                    'last_name' => '',
                    'email' => '',
                    'username' => '',
                    'password' => '',
                    'confirm_password' => '',
                ];

                // TODO Server side validation
                
                // TODO check if emails exists
                $this->userModel->register($form);
                die();
                if($this->userModel->register($form)){
                    
                } else {
                    
                }
            }
        }
    }