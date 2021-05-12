<?php require(APPROOT . '/views/inc/header.php'); ?>

<div class="container-fluid mt-100">
    <h3 class="text-center">Create a new post</h3>

    <form action="<?= URLROOT ?>/posts/create" method="POST">
        <div class="mb-3">
            <label for="postTitle" class="form-label">Post title</label>
            <input type="text" class="form-control <?= getBootstrapValidationClass($data, 'post_title') ?>" id="postTitle" name="postTitle" value="<?= $data['form']['post_title'] ?>">
            <?php checkAndShowError($data['errors']['post_title']) ?>
        </div>
        
        <div class="mb-3">
            <label for="postText" class="form-label">Text</label>
            <input type="text" class="form-control <?= getBootstrapValidationClass($data, 'post_first_comment') ?>" id="postText" name="postText"value="<?= $data['form']['post_first_comment'] ?>">
            <?php checkAndShowError($data['errors']['post_first_comment']) ?>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

</div>

<?php require(APPROOT . '/views/inc/footer.php'); ?>