<?php
    class Users extends Controller{
        private $loginType;

        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function login(){

            // GET
            if($_SERVER['REQUEST_METHOD'] != 'POST'){
                $form = [
                    'user' => '',
                    'password' => '',
                ];

                $errors = [
                    'user' => '',
                    'password' => '',
                ];

                $data = [
                    'form' => $form,
                    'errors' => $errors,
                ];

                $this->view('users/login', $data);
            } else {
                // POST
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $form = [
                    'user' => trim($_POST['user']),
                    'password' => trim($_POST['password']),
                ];

                $errors = [
                    'user' => '',
                    'password' => '',
                ];

                // Server side validation
                $errors['user'] = minMaxEmpty($form['user'], 'Username or email', 2, 40); // TODO handle differnet validation for email and username
                $errors['password'] = minMaxEmpty($form['password'], 'Password', 6, 20);

                // Check if user is logging in with username or email and if that username or email is in the db
                if(filter_var($form['user'], FILTER_VALIDATE_EMAIL)){
                    if(!$this->userModel->findUserByEmail($form['user'])){
                        $errors['user'] = 'Email not found';
                    } else {
                        $this->loginType = 'email';
                    }
                } else {
                    if(!$this->userModel->findUserByUsername($form['user'])){
                        $errors['user'] = 'Username not found';
                    } else {
                        $this->loginType = 'username';
                    }
                }

                $data = [
                    'form' => $form,
                    'errors' => $errors,
                ];

                if(isErrorInErrorArray($data['errors'])){
                    $this->view('users/login', $data);
                } else {
                    if($this->loginType == 'email'){
                        $user = $this->userModel->loginWithEmail($form);
                    } else {
                        $user = $this->userModel->loginWithUsername($form);
                    }
                    if(!$user){
                        $data['errors']['password'] = 'Password is not correct';
                        $this->view('users/login', $data);
                    } else {
                        createUserSession($user);
                        die('success');
                        // TODO redirect to posts page
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
                    $form['password'] = password_hash($data['form']['password'], true);
                    
                    if($this->userModel->register($form)){
                        die('success');
                    } else {
                        die('fail');
                    }
                }

            }
        }
    }