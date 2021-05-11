<?php require(APPROOT . '/views/inc/header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6>New Message</h6>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="<?= $data['form']['title'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="body" class="form-label">Body</label>
                                <textarea name="body" class="form-control" rows="12"><?= $data['form']['body'] ?></textarea>
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