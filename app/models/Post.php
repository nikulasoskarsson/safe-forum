<?php
    class Post{
        public function __construct(){
            $this->db = new Database();
        }

        //Create a comment in a post

        public function commentOnPost($form, $postId) {
            $date = date('Y-m-d H:i:S');

            $this->db->query('INSERT INTO 
            comments (post_id, user_id, date, comment)
            values (:post_id, :user_id, :date, :comment)
            ');
            $this->db->bind(':post_id', $postId);
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->bind(':date', $date);
            $this->db->bind(':comment', $form['post_comment']);
            return $outcome = $this->db->execute();
        }

        //Get individual post dicussions
        public function postDiscussions($postId) {
            $this->db->query('SELECT * FROM comments where post_id = :post_id');
            $this->db->bind(':post_id', $postId);
            $discussions = $this->db->resultSet();
            return $discussions;
        }

        //Display invidual post dicussions
        public function displayPostDiscussions($discussions, $data) {?> 
            <div class="container">
                <div class="container-fluid mt-100" id="discussionsContainer">
                    <?php
                    foreach ($discussions as $row) {
                    
                    $postDate = substr($row->date, 0, -3);

                    //Get creator info
                    $this->db->query('SELECT first_name, last_name, username, created_at, id FROM users WHERE id = :id');
                    $this->db->bind(':id', $row->user_id);
                    $creator = $this->db->single();
                    $creatorProfile = URLROOT . '/profiles/' . $creator->username;
                    $creatorRegisterDate = substr($creator->created_at, 0, -8);

                    //Get total posts
                    $this->db->query('SELECT count(*) r FROM posts WHERE user_id = :user_id');
                    $this->db->bind(':user_id', $creator->id);
                    $postsCount = $this->db->single();
                    
                    //Get total comments
                    $this->db->query('SELECT count(*) r FROM comments WHERE user_id = :user_id');
                    $this->db->bind(':user_id', $creator->id);
                    $commentsCount = $this->db->single();


                    //Display creator info & comment
                    echo "
                        <div class='row w-100'>
                            <div class='col-md-12'>
                                <div class='card mb-4'>
                                    <div class='card-header'>
                                        <div class='media flex-wrap w-100 align-items-center'> <img src='' class='d-block ui-w-40 rounded-circle' alt=''>
                                            <div class='media-body ml-3'> <a href='$creatorProfile'>$creator->first_name $creator->last_name</a>
                                            <div class='text-muted small'>$postDate</div>
                                            </div>
                                        </div>
                                        <div class='text-muted small ml-3'>
                                            <div>Member since <strong>$creatorRegisterDate</strong></div>
                                            <div><strong>$postsCount->r</strong> posts</div>
                                            <div><strong>$commentsCount->r</strong> comments</div>
                                        </div>
                                    </div>
                                    <div class='card-body'>
                                        <p>$row->comment</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";

                    }
                    if (isLoggedIn()) { ?>
                        <div class= "row w-100">
                            <form action="<?= URLROOT ?>/posts/post/<?= $row->post_id ?>" method="POST">
                                <div class="mb-3">
                                    <textarea class="form-control <?= getBootstrapValidationClass($data, 'post_comment') ?>" 
                                        id="postComment" name="postComment" rows="3" placeholder="Share your thoughts" value="<?= $data['form']['post_comment'] ?>"></textarea>
                                    <?php checkAndShowError($data['errors']['post_comment']) ?>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php }; ?>
                </div> 
            </div>
        <?php
        }

        //Get posts by limit
        public function returnPagedPosts($start, $end) {
            $this->db->query('SELECT * FROM posts ORDER BY date DESC LIMIT :start, :end');
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

                $postCreationDate = substr($row->date, 0, -3);

                //Prepare post creator info
                $this->db->query('SELECT first_name, last_name, username FROM users WHERE id = :id');
                $this->db->bind(':id', $row->user_id);
                $creator = $this->db->single();
                $creatorProfile = URLROOT . '/profiles/' . $creator->username;

                //Get post replies count
                $this->db->query('SELECT count(*) r FROM comments WHERE post_id = :post_id');
                $this->db->bind(':post_id', $row->id);
                $repliesCount = $this->db->single();
                $postLink = URLROOT . '/posts/post/' . $row->id;

                //Get last post comment info
                $this->db->query('SELECT user_id, comment, MAX(date) r FROM comments WHERE post_id = :post_id');
                $this->db->bind(':post_id', $row->id);
                $lastComment = $this->db->single();

                //Get last comment user
                $this->db->query('SELECT first_name, last_name, username FROM users WHERE id = :id');
                $this->db->bind(':id', $lastComment->user_id);
                $lastCommentor = $this->db->single();
                $lastCommentorProfile = URLROOT . '/profiles/' . $lastCommentor->username;
                $lastCommentTime = substr($lastComment->r, 0, -3);

                //Get total posts number
                $this->db->query('SELECT COUNT(id) total FROM posts');
                $totalPosts = $this->db->single();
                $totalPages = ceil($totalPosts->total/10);

                echo "
                <div class='card mb-3'>
                    <div class='card-header'>
                        <div class='row w-100'>
                            <div class='col col-md-6'> <a href='$postLink' class='text-big'>$row->title</a>
                                <div class='text-muted small mt-1'>Created at $postCreationDate &nbsp;·&nbsp; <a href='$creatorProfile' class='text-muted'>$creator->first_name $creator->last_name</a></div>
                            </div>
                            <div class='col'>$repliesCount->r</div>
                            <div class='col'>
                                <div class='line-height-1 text-truncate'>$lastCommentTime</div> <a href='$lastCommentorProfile' class='text-muted small text-truncate'>$lastCommentor->first_name $lastCommentor->last_name</a>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            } ?>
                <div class="d-flex flex-wrap justify-content-between mb-3">
                    <div> 
                        <?php if ($_SESSION['pageNumber'] != 1) { ?>
                        <a href="<?= URLROOT ?>/posts/page/<?= $_SESSION['pageNumber'] - 1?>" class="btn btn-shadow btn-wide btn-primary"> 
                            <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-minus fa-w-20"></i> </span> Previous page 
                        </a> 
                        <?php } ?>
                    </div>
                    <span> Page <?=$_SESSION['pageNumber']?> out of <?=$totalPages?> </span>
                    <div> 
                        <?php if ($_SESSION['pageNumber'] != $totalPages) { ?>
                            <a href="<?= URLROOT ?>/posts/page/<?= $_SESSION['pageNumber'] + 1?>" class="btn btn-shadow btn-wide btn-primary"> 
                                <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-plus fa-w-20"></i> </span> Next page 
                            </a>
                        <?php } ?>
                    </div>
                </div>
                </div>
            </div>
        <?php ;
        }

        //Create new forum post
        public function createForumPost($form){
    
            $date = date('Y-m-d H:i:s');

            //Insert first post
            $this->db->query('INSERT INTO 
                posts (title, user_id, date)
                values (:title, :user_id, :date)
            ');
            $this->db->bind(':title', $form['post_title']);
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->bind(':date', $date);

            $sucess = $this->db->execute();

            $firstPosdId = $this->db->lastInsertId();
            //Insert first posts comment
            if ($sucess) {
                $this->db->query('INSERT INTO 
                comments (post_id, user_id, date, comment)
                values (:post_id, :user_id, :date, :comment)
                ');
                $this->db->bind(':post_id', $firstPosdId);
                $this->db->bind(':user_id', $_SESSION['user_id']);
                $this->db->bind(':date', $date);
                $this->db->bind(':comment', $form['post_first_comment']);
                $outcome = $this->db->execute();
                if ($outcome) {
                    return $firstPosdId;
                } else {
                    return false;
                }
            }
        }

    }