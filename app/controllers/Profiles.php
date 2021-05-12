<?php
    class Profiles extends Controller{
        public function __construct(){
            $this->profileModel = $this->model('Profile');
            $this->userModel = $this->model('User');
        }
        
        public function index($username){
            if(!$this->userModel->findUserByUsername($username)){
                return $this->view('profiles/not-found', $username);
            } else {
                $data = $this->profileModel->getUserData($username);

                return $this->view('profiles/profile', $data);
            }
        }

        public function uploadProfileImage(){
            if($_SERVER['REQUEST_METHOD'] != 'POST'){
                die('posts request only');
            } else {
                $previousImage = $this->profileModel->getImageByUserId($_SESSION['user_id']);
                if($previousImage) {
                    removeSingleImage($previousImage->url);
                }
                $name = uploadSingleImage($_FILES['profile-img']);
                if($this->profileModel->addUserImg($name)) {
                   $this->index($_SESSION['username']);
                }
            }
        }
    }