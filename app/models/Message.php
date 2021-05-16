<?php
    class Message {
        public function __construct() {
            $this->db = new Database();
        }
        public function getChatByCompactKey($fromUserId, $toUserId) {
            $this->db->query('SELECT * FROM chats WHERE from_user_id = :fromUserId AND to_user_id = :toUserId');
            $this->db->bind(':fromUserId', $fromUserId);
            $this->db->bind(':toUserId', $toUserId);

            $row = $this->db->single();
            return $row ? $row->id : false;
        }

        public function createChat($fromUserId, $toUserId) {
            $this->db->query("INSERT INTO chats (from_user_id, to_user_id) VALUES(:fromUserId, :toUserId)");
            $this->db->bind(':fromUserId', $fromUserId);
            $this->db->bind(':toUserId', $toUserId);

            return $this->db->execute() ? $this->db->lastInsertId() : false;
        }

        public function createMessage($chatId, $form) {
            $this->db->query('INSERT INTO messages(chat_id, body, timestamp)
                                VALUES(:chatId, :body, :timestamp)');
            $this->db->bind(':chatId', $chatId);
            $this->db->bind(':body', $form['body']);
            $this->db->bind(':timestamp', time());

            $this->db->execute();
        }

        public function getAllLatestMessages($id) {
            
        }

        public function getAllMessagesFromChatAndUserData($fromUserId, $toUserId) {
            $this->db->query('SELECT * FROM chats LEFT OUTER JOIN messages ON chats.id = messages.chat_id 
                                WHERE from_user_id = :fromUserId AND to_user_id = :toUserId');
            $this->db->bind(':fromUserId', $fromUserId);
            $this->db->bind(':toUserId', $toUserId);

            $rows = $this->db->execute();
            return $rows ? $this->db->resultSet() : false;
        }
    }