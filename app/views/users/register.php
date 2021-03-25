<?php require_once(APPROOT . '/views/inc/header.php') ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h3>Sign up for Forum</h3>
                <p>Please fill out this form to register with us</p>
                <form action="">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First name: <sup>*</sup></label>
                    <input type="text" class="form-control" id="firstName" name="firstName">
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last name: <sup>*</sup></label>
                    <input type="email" class="form-control" id="lastName" name="lastName">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address: <sup>*</sup></label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username: <sup>*</sup></label>
                    <input type="username" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password: <sup>*</sup></label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="password2" class="form-label">Repeat Password: <sup>*</sup></label>
                    <input type="password" class="form-control" id="password2" name="password2">
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