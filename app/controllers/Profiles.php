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
    }