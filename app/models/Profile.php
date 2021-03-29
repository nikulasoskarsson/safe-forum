<?php
    class Profile{
        public function __construct(){
            $this->db = new Database();
        }

        public function getUserData($username){
            $this->db->query('SELECT * FROM users WHERE username = :username');
            $this->db->bind(':username', $username);
            $row = $this->db->single();

            return $row;
        }
    }