<!DOCTYPE html>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="style2.css">
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
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lname" placeholder="Your Email *"
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="lpassword"
                                        placeholder="Your Password *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btnSubmit" value="Login" />
                                </div>
                                <div class="form-group">
                                    <a href="#" class="ForgetPwd">Forget Password?</a>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 login-form-2">
                            <h3>Register</h3>
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Username"
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" placeholder="Your Email *"
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btnSubmit" value="Register" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php
    if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["cpassword"])) {
        $password = test_input($_POST["password"]);
        $cpassword = test_input($_POST["cpassword"]);
        if (strlen($_POST["password"]) <= '8') {
            $passwordErr = "Your Password Must Contain At Least 8 Characters!";
        }
        elseif(!preg_match("#[0-9]+#",$password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Number!";
        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
        }
        elseif(!preg_match("#[a-z]+#",$password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
        }
    }
    elseif(!empty($_POST["password"])) {
        $cpasswordErr = "Please Check You've Entered Or Confirmed Your Password!";
    } else {
         $passwordErr = "Please enter password   ";
    }
    ?>
</body>