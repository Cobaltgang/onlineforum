  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#"><?php echo 'Welcome ' . $_SESSION['username']?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create_post.php">Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="myposts.php">My Posts</a>
          </li>
          <li class="nav-item">
          <?php  if (isset($_SESSION['username'])) : ?>
          <a class="nav-link" href="logout.php" style="color: red;">Logout</a></li><?php endif ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>