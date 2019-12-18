<?php 
session_start();
include 'upload.php';
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
  </head>
  <body>
    <div class="testbox">
      <form action="create_post.php" method="POST">
        <div class="banner">
          <h1>Create Post</h1>
        </div>
        <div class="item">
          <p>Title</p>
          <div class="item">
            <input type="text" name="title" id="title" onkeyup = "Validate(this)" placeholder="Catchy Title" required/>
          </div>
        </div>
        <div class="item">
          <p>Body</p>
          <textarea rows="3" name="body" id="body" onkeyup = "Validate(this)" required></textarea>
        </div>
        <?php if (count($errors) > 0) {
                                echo "";
                            } ?>
                            <?php include('errors.php'); ?>
        <div class="btn-block">
          <button type="submit" name="create_post" >Post</button>
        </div>
      </form>
    </div>
    <script>
    function Validate(txt) {
    txt.value = txt.value.replace(/[^a-zA-Z-'\n\r.]+/g, '');
}
    </script>
  </body>
</html>