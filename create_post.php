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
      <form action="/">
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
        
        <div class="btn-block">
          <button type="submit" href="/">Post</button>
        </div>
      </form>
    </div>
  </body>
</html>