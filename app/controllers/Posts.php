<?php
    class Posts extends Controller{
        public function __construct(){
            $this->postModel = $this->model('Post');
        }

        public function index() {
            $this->view('/posts/discussions');
            $posts = $this->postModel->returnPagedPosts(0, 20);
            $this->postModel->displayPagedPosts($posts);
        }

        public function create() {
            //GET
            if($_SERVER['REQUEST_METHOD'] != 'POST'){
                $form = [
                    'post_title' => '',
                    'post_first_comment' => '',
                ];

                $errors = [
                    'post_title' => '',
                    'post_first_comment' => '',
                ];

                $data = [
                    'form' => $form,
                    'errors' => $errors,
                ];
                $this->view('/posts/new_post', $data);
            //POST
            } else {

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $form = [
                    'post_title' => trim($_POST['postTitle']),
                    'post_first_comment' => trim($_POST['postText']),
                ];

                $errors = [
                    'post_title' => '',
                    'post_first_comment' => '',
                ];

                // Server side validation
                $errors['post_title'] = minMaxEmpty($form['post_title'], 'Post title', 5, 100);
                $errors['post_first_comment'] = minMaxEmpty($form['post_first_comment'], 'Text', 3, 5000);

                $data = [
                    'form' => $form,
                    'errors' => $errors,
                ];

                if(isErrorInErrorArray($errors)){
                    $this->view('posts/new_post', $data);
                } else {
                    $post = $this->postModel->createForumPost($form);
                    if($post){
                        header('Location: ' . URLROOT . "/posts"); //Re-do for direct new post redirect.
                    } else {
                        die('fail');
                    }
                }
            }
        }
               


    }