<?php
    class Profile{
        public function __construct(){
            $this->db = new Database();
        }

        public function getUserData($username){
            $this->db->query('SELECT first_name, last_name, username, email, created_at, url 
                                FROM users LEFT JOIN user_images ON users.id = user_images.user_id WHERE username = :username');
            $this->db->bind(':username', $username);
            $row = $this->db->single();

            return $row;
        }

        public function addUserImg($url){
            $this->db->query('INSERT INTO user_images (user_id, url) VALUES(:user_id, :url) ON DUPLICATE KEY UPDATE url = :url');
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->bind(':url', $url);

            return $this->db->execute();
        }
    }