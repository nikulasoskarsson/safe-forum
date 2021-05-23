<?php require_once(APPROOT . '/views/inc/header.php') ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h3>Sign up for Forum</h3>
                <p>Please fill out this form to register with us</p>
                <form action="<?= URLROOT ?>/users/register" method="POST">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First name: <sup>*</sup></label>
                    <input type="text" class="form-control <?= getBootstrapValidationClass($data, 'first_name') ?>" id="firstName" name="firstName" value="<?= $data['form']['first_name'] ?>">
                    <?php checkAndShowError($data['errors']['first_name']) ?>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last name: <sup>*</sup></label>
                    <input type="text" class="form-control <?= getBootstrapValidationClass($data, 'last_name') ?>" id="lastName" name="lastName" value="<?= $data['form']['last_name'] ?>">
                    <?php checkAndShowError($data['errors']['last_name']) ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address: <sup>*</sup></label>
                    <input type="email" class="form-control <?= getBootstrapValidationClass($data, 'email') ?>" id="email" aria-describedby="emailHelp" name="email" value="<?= $data['form']['email'] ?>">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    <?php checkAndShowError($data['errors']['email']) ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username: <sup>*</sup></label>
                    <input type="text" class="form-control <?= getBootstrapValidationClass($data, 'username') ?>" id="username" name="username" value="<?= $data['form']['username'] ?>">
                    <?php checkAndShowError($data['errors']['username']) ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password: <sup>*</sup></label>
                    <input type="password" class="form-control <?= getBootstrapValidationClass($data, 'password') ?>" id="password" name="password" value="<?= $data['form']['password'] ?>">
                    <?php checkAndShowError($data['errors']['password']) ?>
                </div>
                <div class="mb-3">
                    <label for="password2" class="form-label">Repeat Password: <sup>*</sup></label>
                    <input type="password" class="form-control <?= getBootstrapValidationClass($data, 'confirm_password') ?>" id="password2" name="password2" value="<?= $data['form']['confirm_password'] ?>">
                    <?php checkAndShowError($data['errors']['confirm_password']) ?>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms">
                    <label class="form-check-label" for="terms">I have read and agree to the terms and conditions</label>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col text-end">
                        <a href="<?= URLROOT ?>/users/login" class="btn btn-light btn-block">Already have an account? Sign in</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php require_once(APPROOT . '/views/inc/footer.php') ?>