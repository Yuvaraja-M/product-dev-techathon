<?php
    require 'functions.php';
    if(isset($_POST['submit'])) {
        $response = loginUser($_POST['username'],$_POST['password']);
    }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
         body {
            background-image: url("bc.jpg");
         }
      </style>
</head>
<body>
    <form action="" method="post" autocomplete="off">
        <h2 class="text-center text-info"><u>Log in</u></h2>
        <br>
        <br>
        <div class="container text-center" style="padding-top: 70px;  border-radius: 25px ">
            <h2><div class="form-group">
                Username: <input type="text" name="username" value="<?php echo @$_POST['username'];?>" required>
            </div>
            <div class="form-group">
                Password: <input type="password" name="password" value="<?php echo @$_POST['password'];?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </h2>
        </div>
        <div class="text-center">
        <p>
            Don't have an account? <a href="index.php">Sign up</a>
        </p>
        <p>
            Forgot password? <a href="forgot_pass.php">Reset</a>
        </p>
        <p class="error"><?php echo @$response; ?></p>
        </div>
    </form>
</body>
</html>
