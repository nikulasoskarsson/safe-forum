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
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'user' => trim($_POST['user']),
                    'password' => trim($_POST['password']),
                    'user_error' => '',
                    'password_error' => '',
                ];

                // Handle email login
                if(filter_var($data['user'], FILTER_VALIDATE_EMAIL)){
                    if($this->userModel->loginWithEmail($data)){
                        die('success');
                    } else {
                        die('fail');
                    }
                } else{
                    if($this->userModel->loginWithUsername($data)){
                        die('success');
                    } else {
                        die('fail');
                    }
                }
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
                // POST
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

                $form['password'] = password_hash($form['password'], true);
                
                // TODO check if emails exists
                if($this->userModel->register($form)){
                    die('success');
                } else {
                    die('fail');
                }
            }
        }
    }