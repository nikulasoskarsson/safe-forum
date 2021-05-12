<?php
    class Posts extends Controller{

        public function __construct(){
            echo 'Posts loaded';
        }

        public function index(){
            return $this->view('pages/about');
        }
    }