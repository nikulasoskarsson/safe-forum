<?php
    class User{
        public function __construct(){
            $this->db = new Database();
        }

        public function login(){
            
        }

        public function register($form){
            $this->db->query('INSERT INTO 
                              users (first_name, last_name, email, username, password)
                              values (:first_name, :last_name, :email, :username: :password)
                            ');

            $this->db->bind(':first_name', $form['first_name']);
            $this->db->bind(':last_name', $form['last_name']);
            $this->db->bind(':email', $form['email']);
            $this->db->bind(':username', $form['username']);
            $this->db->bind(':password', $form['password']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }
    }