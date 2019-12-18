<?php 
session_start();
include 'functions/posts.php';
if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: forms.php');
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Create Post</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style3.css" crossorigin="anonymous">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>NCI Forum</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/blog-home.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'includes/navbar.php'?>
    <div class = "container"></div>
    <div class="testbox card-body">
      <form action="create_post.php" method="POST">
        <div class="banner">
          <h1>Create Post</h1>
        </div>
        <div class="item">
          <p>Title</p>
          <div class="item">
            <input type="text" name="title" id="title" placeholder="Catchy Title" required/>
          </div>
        </div>
        <div class="item">
          <p>Body</p>
          <textarea rows="3" name="body" id="body" required></textarea>
        </div>
        <?php if (count($errors) > 0) {
                                echo "";
                            } ?>
                            <?php include('errors.php'); ?>
        <div class="btn-block">
          <button type="submit" name="create_post" >Post</button>
        </div>
        <?php include 'messages.php' ?>
      </form>
    </div>
    </div>
    <script>
    function Validate(txt) {
    txt.value = txt.value.replace(/[^a-zA-Z-'\n\r.]+/g, '');
}
    </script>
 <?php include 'includes/footer.php'?>