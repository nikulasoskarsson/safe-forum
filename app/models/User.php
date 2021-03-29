<?php
    class User{
        public function __construct(){
            $this->db = new Database();
        }

        public function loginWithEmail($form){
            $this->db->query('SELECT * FROM users WHERE email = :email LIMIT 1');
            $this->db->bind(':email', $form['user']);
            $row = $this->db->single();

            if($row){
                $hashed_password = $row->password;
                if(password_verify($form['password'], $hashed_password)){
                    return $row;
                } else {
                    die('password does not match');
                }
            } else {
                die('email does not exist');
            }
        }

        public function loginWithUsername($form){
            $this->db->query('SELECT * FROM users WHERE username = :username LIMIT 1');
            $this->db->bind(':username', $form['user']);
            $row = $this->db->single();
            if($row){
                $hashed_password = $row->password;
                if(password_verify($form['password'], $hashed_password)){
                    return $row;
                } else {
                    die('password does not match');
                }
            } else {
                die('username does not exist');
            }
        }

        public function register($form){
            $this->db->query('INSERT INTO 
                              users (first_name, last_name, email, username, password)
                              values (:first_name, :last_name, :email, :username, :password)
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