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
                $messageData = $this->messageModel->getAllMessagesFromChatAndUserData($_SESSION['user_id'], $id);
                var_dump($messageData);
                $form = [
                    'body' => '',
                ];

                $errors = [
                    'body' => '',
                    'message' => '',
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
                    'body' => trim($_POST['body']),
                ];

                $errors = [
                    'body' => minMaxEmpty($form['body'], 'The message', 2, 200),
                    'message' => '',
                ];

                // Check if the user recieving the message exists
                if(!$this->userModel->findUserById($id)) {
                    $errors['message'] = 'You are trying to send a message to a user that does not exist';
                }
                // Check if the user sending the message exists
                if(!$this->userModel->findUserById($_SESSION['user_id'])) {
                    $errors['message'] = 'You are trying to send message from an account that was not found in the database';
                }

                $data = [
                    'form' => $form, 
                    'errors' => $errors,
                ];

                // TODO server side validation

                if(isErrorInErrorArray($errors)) {
                    $this->view('messages/create-message', $data);
                } else {
                    $chatId = $this->messageModel->getChatByCompactKey($_SESSION['user_id'], $id);
                    if(!$chatId) {
                        $chatId = $this->messageModel->createChat($_SESSION['user_id'], $id);
                    }
                    
                    $this->messageModel->createMessage($chatId, $form);

                    $this->view('messages/create-message', $data);
                }
            }
        }
    }