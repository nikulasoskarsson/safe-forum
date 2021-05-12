<?php 
    class Messages extends Controller {
        public function __construct() {
            $this->messageModel = $this->model('Message');
            $this->userModel = $this->model('User');
        }
        // All messages
        public function index() {
            $this->view('messages/all-messages');
        }

        public function new($id) {
            if($_SERVER['REQUEST_METHOD'] != 'POST') {
                $form = [
                    'title' => '',
                    'body' => '',
                ];

                $errors = [
                    'title' => '',
                    'body' => '',
                ];

                $data = [
                    'form' => $form, 
                    'errors' => $errors,
                ];
                
                $this->userModel->findUserById($id) 
                    ?  $this->view('messages/create-message', $data) 
                    : $this->view('messages/user-not-found');
            } else {
                // POST
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $form = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                ];

                $errors = [
                    'title' => '',
                    'body' => '',
                ];

                $data = [
                    'form' => $form, 
                    'errors' => $errors,
                ];

                // TODO server side validation

                if(isErrorInErrorArray($errors)) {
                    // TODO load view with errors
                } else {
                    $this->messageModel->createMessage($form, $id);
                }
            }
        }
    }