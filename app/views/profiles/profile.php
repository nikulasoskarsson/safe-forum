<?php require_once(APPROOT . '/views/inc/header.php') ?>
<?php var_dump($data) ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-body text-center">
                <label for="profile-img">
                    <img
                        style="height:135px; width:135px; object-fit:cover;" 
                        class="mx-auto img-thumbnail rounded-circle" 
                        src="<?= URLROOT . '/public/assets/img/profiles/' . ($data->url ? $data->url  : 'default.jpg' )?>" 
                        alt="Profile image"
                    >
                </label>
                <form action="<?= URLROOT ?>/profiles/uploadProfileImage" method="POST" enctype="multipart/form-data">
                    <input type="file" style="display:none;" name="profile-img" id="profile-img">
                    <button class="btn btn-success">Upload</button>
                </form>
                <h3><?= "$data->first_name $data->last_name"?></h3>
                <h6 class="lead"><?= $data->username ?></h6>
                <p class="text-primary">Last online 23 days ago</p>
                <div class="div-flex">
                    <button class="btn btn-success">Follow <i class="fas fa-user-plus"></i></button>
                    <a href="<?= URLROOT . "/messages/new/$data->user_id" ?>" class="btn btn-info text-white">Message <i class="fas fa-envelope"></i> </a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Member since</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">June 12 2019</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Posts</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">5</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Comments</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">25</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Upvotes</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">500</div>
                </div>
            </div>
        </div>
    </div>
<?php require_once(APPROOT . '/views/inc/footer.php') ?>