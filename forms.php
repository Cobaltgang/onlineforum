<?php
include 'server.php';

?>
<!DOCTYPE html>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="js/validation.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="Anonymous_emblem.png" alt="" />
                <h3>Welcome</h3>
                <p>Register to acces the Forum</p>
            </div>
            <div class="col-md-9 register-right">
                <div class=" login-container">
                    <div class="row">
                        <div class="col-md-6 login-form-1">
                            <h3>Login</h3>
                            <form action="forms.php" method="POST">
                            
                                <div class="form-group">
                                    <input type="text" class="form-control" type="text" name="username" id = "txt" onkeyup = "Validate(this)" placeholder="username" required placeholder="Username"
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Your Password *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="login_user" class="btnSubmit" value="Login" />
                                </div>
                                <div class="form-group">
                                    <a href="#" class="ForgetPwd">Forget Password?</a>
                                </div>
                                <?php if (count($errors) > 0) {
                                echo "Error Logging in";
                            } ?>
                            <?php include('errors.php'); ?>
                            <?php include 'messages.php' ?>
                            </form>
                        </div>
                        <div class="col-md-6 login-form-2">
                            <h3>Register</h3>
                            <form action="forms.php" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" type="text" name="username" id = "txt" onkeyup = "Validate(this)" placeholder="username" required placeholder="Username"
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <input required type="text" class="form-control" minlength="4" type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id = "email"  onkeyup="emailCheck();" placeholder="Your Email *"
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <input required name="password" type="password" class="form-control" minlength="8" maxlength="16" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password" onkeyup="strong()" placeholder="Password"
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <input required name="cpassword" type="password" class="form-control inputpass" minlength="8" maxlength="16" placeholder="Enter again to validate"  id="cpassword" onkeyup="checksimilarity();" />
                                </div>
                                <div class="form-group" id ="match">
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="submit" name = "reg_user"  class="btnSubmit" value="Submit"/>
                                </div>
                                <div id="match">
                                    <p id ="1"></p>
                                    <p id="2"></p>
                                    <p id="3"></p>
                                    <p id="4"></p>
                                    <p id="5"></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php

    ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script>

    </script>
</body>