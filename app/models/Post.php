<?php
    class Post{
        public function __construct(){
            $this->db = new Database();
        }

        //Get posts by limit
        public function returnPagedPosts($start, $end) {
            $this->db->query('SELECT * FROM posts LIMIT :start, :end');
            $this->db->bind(':start', $start);
            $this->db->bind(':end', $end);
            $posts = $this->db->resultSet();
            return $posts;
        }

        //Display returned posts
        public function displayPagedPosts($posts) {
            echo '
            <div class="container">
                <div class="container-fluid mt-100" id="postsContainer">';
            foreach ($posts as $row) {

                //Prepare post creator info
                $this->db->query('SELECT first_name, last_name, username FROM users WHERE id = :id');
                $this->db->bind(':id', $row->user_id);
                $creator = $this->db->single();
                $creatorProfile = URLROOT . '/profiles/' . $creator->username;

                //Get post replies count
                $this->db->query('SELECT count(*) r FROM comments WHERE post_id = :post_id');
                $this->db->bind(':post_id', $row->id);
                $repliesCount = $this->db->single();

                echo "
                <div class='card mb-3'>
                    <div class='card-header'>
                        <div class='row w-100'>
                            <div class='col col-md-6'> <a href='TODO POSTLINK' class='text-big'>$row->title</a>
                                <div class='text-muted small mt-1'>Created at $row->date&nbsp;·&nbsp; <a href='$creatorProfile' class='text-muted'>$creator->first_name $creator->last_name</a></div>
                            </div>
                            <div class='col'>$repliesCount->r</div>
                            <div class='col'>
                                <div class='line-height-1 text-truncate'>X day ago</div> <a href='javascript:void(0)' class='text-muted small text-truncate'>by xxx TODO</a>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
            echo '
            </div> 
                </div>';
        }

        //Create new forum post
        public function createForumPost($form){
    
            $date = date('Y-m-d H:i');

            //Insert first post
            $this->db->query('INSERT INTO 
                posts (title, user_id, date)
                values (:title, :user_id, :date)
            ');
            $this->db->bind(':title', $form['post_title']);
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->bind(':date', $date);

            $sucess = $this->db->execute();

            $firstCommentId = $this->db->lastInsertId();
            //Insert first posts comment
            if ($sucess) {
                $this->db->query('INSERT INTO 
                comments (post_id, user_id, date, comment)
                values (:post_id, :user_id, :date, :comment)
                ');
                $this->db->bind(':post_id', $firstCommentId);
                $this->db->bind(':user_id', $_SESSION['user_id']);
                $this->db->bind(':date', $date);
                $this->db->bind(':comment', $form['post_first_comment']);
                return $outcome = $this->db->execute();
            }
        }

    }