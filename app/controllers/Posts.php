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

        public function post($postId) {
            if($_SERVER['REQUEST_METHOD'] != 'POST'){

                $form = [
                    'post_comment' => ''
                ];

                $errors = [
                    'post_comment' => ''
                ];

                $data = [
                    'form' => $form,
                    'errors' => $errors,
                ];
                $this->view('/posts/individual_post');

                //Get all discussions for the post ID
                $discussions = $this->postModel->postDiscussions($postId);
                if ($discussions) {
                    //Display discussions for the post ID
                    $this->postModel->displayPostDiscussions($discussions, $data);
                } else {
                    //No discussions with post ID found
                    header('Location: ' . URLROOT . "/posts");
                }

            } else {

                if (isLoggedIn()) {

                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                    $form = [
                        'post_comment' => trim($_POST['postComment'])
                    ];

                    $errors = [
                        'post_comment' => ''
                    ];

                    // Server side validation
                    $errors['post_comment'] = minMaxEmpty($form['post_comment'], 'Text', 3, 5000);

                    $data = [
                        'form' => $form,
                        'errors' => $errors,
                    ];

                    if(isErrorInErrorArray($errors)){

                        $this->postModel->displayPostDiscussions($discussions, $data); //TO DO - ERROR DISPLAY HAS TO BE FIXED

                    } else {

                        $commentOutcome = $this->postModel->commentOnPost($form, $postId);
                        if ($commentOutcome) {
                            header('Location: ' . URLROOT . "/posts/post/$postId");
                        } else {
                            die('fail');
                        }
                    }

                } else {
                    die('fail');
                }
            }
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