<?php
    class User{
        public function __construct(){
            $this->db = new Database();
        }

        public function loginWithEmail($form){
            $this->db->query('SELECT * FROM users WHERE email = :email LIMIT 1');
            $this->db->bind(':email', $form['user']);
            $row = $this->db->single();
            $hashed_password = $row->password;

            if(password_verify($form['password'], $hashed_password)){
                return $row;
            } else {
                return false;
            }
        }

        public function loginWithUsername($form){
            $this->db->query('SELECT * FROM users WHERE username = :username LIMIT 1');
            $this->db->bind(':username', $form['user']);
            $row = $this->db->single();
            $hashed_password = $row->password;

            if(password_verify($form['password'], $hashed_password)){
                return $row;
            } else {
                return false;
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

        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);
            $row = $this->db->single();

            return $row ? true : false;
        }

        public function findUserByUsername($username){
            $this->db->query('SELECT * FROM users WHERE username = :username');
            $this->db->bind(':username', $username);
            $row = $this->db->single();

            return $row ? true : false;
        }
    }