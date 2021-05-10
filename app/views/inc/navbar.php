<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="<?= URLROOT ?>">Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= URLROOT ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT ?>/pages/about"  tabindex="-1" aria-disabled="true">About</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <?php if (isLoggedIn()): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT . '/profiles/' . $_SESSION['username'] ?>" tabindex="-1" aria-disabled="true">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT ?>/users/logout" tabindex="-1" aria-disabled="true">Logout</a>
          </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= URLROOT ?>/users/login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT ?>/users/register">Register</a>
        </li>
        <?php  endif ?>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>