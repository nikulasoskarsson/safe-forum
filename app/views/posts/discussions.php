<?php require(APPROOT . '/views/inc/header.php'); ?>

<div class="container-fluid mt-100">

  <?php if (isLoggedIn()) {?>
    <div class="d-flex flex-wrap justify-content-between mb-3">
        <div> <a href="<?= URLROOT ?>/posts/create" class="btn btn-shadow btn-wide btn-primary"> <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-plus fa-w-20"></i> </span> New thread </a> </div>
    </div>
  <?php }?>

  <div class="card mb-3">
    <div class="card-header">
      <div class="row w-100">
        <div class="col col-md-6">Topics</div>
        <div class="col">Replies</div>
        <div class="col">Last update</div>
      </div>
    </div>
  </div>

</div>

<?php require(APPROOT . '/views/inc/footer.php'); ?>