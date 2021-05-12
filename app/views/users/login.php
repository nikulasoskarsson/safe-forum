<?php require_once(APPROOT . '/views/inc/header.php') ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h3>Login to forum</h3>
                <p>Login to be able to post, comment and upvote</p>
                <form action="<?= URLROOT ?>/users/login" method="POST">
                <div class="mb-3">
                    <label for="user" class="form-label">Email address or username</label>
                    <input type="text" class="form-control <?= getBootstrapValidationClass($data, 'user') ?>" id="user" name="user" value="<?= $data['form']['user'] ?>">
                    <?php checkAndShowError($data['errors']['user']) ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control <?= getBootstrapValidationClass($data, 'password') ?>" id="password" name="password"value="<?= $data['form']['password'] ?>">
                    <?php checkAndShowError($data['errors']['password']) ?>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms">
                    <label class="form-check-label" for="terms">Keep me signed in</label>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col text-end">
                        <a href="<?= URLROOT ?>/users/register" class="btn btn-light btn-block">Don't have an account? Register</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php require_once(APPROOT . '/views/inc/footer.php') ?>