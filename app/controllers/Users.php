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
                    $user = $this->userModel->loginWithEmail($data);
                    if($user){
                        createUserSession($user);
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

                // Server side validation
                $errors['first_name'] = minMaxEmpty($form['first_name'], 'First name', 2, 20);
                $errors['last_name'] = minMaxEmpty($form['last_name'], 'Last name', 2, 20);
                $errors['email'] = isValidEmail($form['email']);
                $errors['username'] = minMaxEmpty($form['username'], 'Username', 2, 20);
                $errors['password'] = minMaxEmpty($form['password'], 'Password', 6, 20);
                $errors['confirm_password'] = minMaxEmpty($form['password'], 'Password', 6, 20);
                // Only check if it dosen't already have an error
                if($errors['email'] == ''){
                    if($this->userModel->findUserByEmail($form['email'])){
                        $errors['email'] = 'Email is already registered';
                    }
                }
                if($errors['username'] == ''){
                    if($this->userModel->findUserByUsername($form['username'])){
                        $errors['username'] = 'Username is already registered';
                    }
                }
                if($errors['confirm_password'] == ''){
                    $errors['confirm_password'] = isPasswordSameAsConfirmPassword($form['password'], $form['confirm_password']);
                }
                

                $data = [
                    'form' => $form,
                    'errors' => $errors,
                ];
                
                // TODO check if emails exists
                if(isErrorInErrorArray($errors)){
                    $this->view('users/register', $data);
                } else {
                    $data['form']['password'] = password_hash($data['form']['password'], true);
                    if($this->userModel->register($form)){
                        die('success');
                    } else {
                        die('fail');
                    }
                }

            }
        }
    }