<?php require(APPROOT . '/views/inc/header.php'); ?>

<div class="container-fluid mt-100">

    <div class="d-flex flex-wrap justify-content-between mb-3">
        <div> <a href="<?= URLROOT ?>/posts" class="btn btn-shadow btn-wide btn-primary"> <span class="btn-icon-wrapper pr-2 opacity-7"> </span> Back to posts </a> </div>
    </div>

    <h3 class="text-center mb-2">Create a new post</h3>

    <form action="<?= URLROOT ?>/posts/create" method="POST">
        <input type="hidden" value="<?= $_SESSION['csrf'] ?>" name="csrf_token">
        <div class="mb-3">
            <input type="text" class="form-control <?= getBootstrapValidationClass($data, 'post_title') ?>" id="postTitle" name="postTitle" placeholder="Post title" value="<?= $data['form']['post_title'] ?>">
            <?php checkAndShowError($data['errors']['post_title']) ?>
        </div>
        
        <div class="mb-3">
            <textarea 
                type="text" class="form-control <?= getBootstrapValidationClass($data, 'post_first_comment') ?>" placeholder="Share your thoughts" rows = "6" id="postText" 
                name="postText"value="<?= $data['form']['post_first_comment'] ?>"></textarea>
            <?php checkAndShowError($data['errors']['post_first_comment']) ?>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">Post</button>
            </div>
        </div>
    </form>

</div>

<?php require(APPROOT . '/views/inc/footer.php'); ?>