<?php
    class Message {
        public function __construct() {
            $this->db = new Database();
        }

        public function createMessage($form, $toUserId) {
            $this->db->query('INSERT INTO messages(id, from_user_id, to_user_id, title, body, timestamp)
                                VALUES(null, :fromUserId, :toUserId, :title, :body, :timestamp)');
            $this->db->bind(':fromUserId', $_SESSION['user_id']);
            $this->db->bind(':toUserId', $toUserId);
            $this->db->bind(':title', $form['title']);
            $this->db->bind(':body', $form['body']);
            $this->db->bind(':timestamp', time());

            $this->db->execute();
        }
    }