<?php
include './classes/user.php';
include './classes/chat.php';
$oUser = new User();
$oChat = new Chat();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
    	<div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php if ($oUser->loggedin() == false) : ?>
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Login</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">Register</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form name="login" id="login-form" action="" method="post" style="display: block;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="loginusername" tabindex="1" class="form-control" placeholder="Username" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="loginpassword" tabindex="2" class="form-control" placeholder="Password">
                                    </div>                                            
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login login-submit" value="Log In">
                                            </div>
                                        </div>
                                    </div>								
                                </form>
                                <form name="register" id="register-form" action="" method="post" style="display: none;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="regusername" tabindex="1" class="form-control" placeholder="Username" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="regpassword" tabindex="2" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="hidden" name="register" value="1">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register submit" value="Register Now">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="chatContainer">
                <div class="chatHeader">
                    <h3>Welcome, <?= $_SESSION['username'] ?></h3>
                    <a href="logout.php" class="btn btn-custom btn-info">Logout</a>
                </div>
                <div class="chatMessage" id="chatMessage">
                <?php foreach ($oChat->getMessages() as $v) :  ?>
                    <p class="cm"><b><?= $v['Username'] ?> </b>says:<br><?= $v['Message'] ?></p>
                <?php endforeach; ?>
                </div>
                    <div class="chatBottom">
                        <textarea class="addMessage" id="addMessage" placeholder="Type your message"></textarea>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/chat.js"></script>
  </body>
</html>