<?php
    class Users extends Controller{
        public function __construct(){

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
            if(!$_SERVER['REQUEST_METHOD'] != 'POST'){
                $this->view('users/register');
            } else {
                // POST
            }
        }
    }