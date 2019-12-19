<?php
session_start();
include_once("functions.php");

  include_once 'userposts.php';
  $titles = getAllPostTitles();
  $messages = getAllPostMessages();
  $ids = getid(); 
  $max = sizeof($titles)-1;

  if (!func::checkLoginState($dbh))
{
  
  header("location:forms.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Rocket Board</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/blog-home.css" rel="stylesheet">

</head>

<body>

<?php include 'includes/navbar.php'?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4">Rocket Board
          <!-- <small>Secondary Text</small> -->
        </h1>

        <!-- Blog Post -->
        <?php for($x = 0; $x <= $max; $x++){ ?>
        <div class="card mb-4">
          <div class="card-body">
            <h2 class="card-title"><?php echo $titles[$x]; ?></h2>
            <p class="card-text"><?php echo $messages[$x]; ?></p>
            <a  href="userposts.php?del=<?php echo $ids[$x]; ?>" class="btn btn-primary">Delete Post</a>
          </div>
          <div class="card-footer text-muted">
          </div>
        </div>
        <?php } ?>

        <!-- Blog Post -->  
        <!-- <div class="card mb-4">
          <div class="card-body">
            <h2 class="card-title">Post Title</h2>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
            <a href="#" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            Posted on January 1, 2017 by
            <a href="#">Start Bootstrap</a>
          </div>
        </div> -->

        <!-- Blog Post -->
        <!-- <div class="card mb-4">
          <div class="card-body">
            <h2 class="card-title">Post Title</h2>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
            <a href="#" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            Posted on January 1, 2017 by
            <a href="#">Start Bootstrap</a>
          </div>
        </div> -->

        <!-- Pagination -->
        

      </div>
      <div class="col-md-4">
      <h4 class="my-4"><?php include 'messages.php' ?>
          <!-- <small>Secondary Text</small> -->
        </h4>
      
      </div>



    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <?php include 'includes/footer.php'?>
