<?php require(APPROOT . '/views/inc/header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <?php if($data['errors']['message']) : ?>
                <p class="alert alert-danger">
                    <?= $data['errors']['message'] ?>
                </p>
            <?php endif ?>
                <div class="card">
                    <div class="card-header">
                        <h6>New Message</h6>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="body" class="form-label">Body</label>
                                <textarea name="body" class="form-control <?= getBootstrapValidationClass($data, 'body') ?>" rows="12"><?= $data['form']['body'] ?></textarea>
                                <?php checkAndShowError($data['errors']['body']) ?>
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Send" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require(APPROOT . '/views/inc/footer.php'); ?>