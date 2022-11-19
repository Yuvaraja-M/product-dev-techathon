<?php
    require 'functions.php';
    if(isset($_POST['submit'])) {
        $response = registerUser($_POST['email'],$_POST['username'],$_POST['phno'],$_POST['password'],$_POST['address']);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
         body {
            background-image: url("bc.jpg");
         }
      </style>
</head>
<body>
    <form action="" method="post" autocomplete="off">
        <h2 class="text-center text-info"><u>Sign up</u></h2>
        <div class="container text-center" style="padding-top: 70px;  border-radius: 25px ">
           <h2> <div class="form-group">
                Email: <input type="email" name="email" value="<?php echo @$_POST['email'];?>" required>
            </div>
            <div class="form-group">
                Username: <input type="text" name="username" value="<?php echo @$_POST['username'];?>" required>
            </div>
            <div class="form-group">
                Phone no.: <input type="text" name="phno" value="<?php echo @$_POST['phno'];?>" required>
            </div>
            <div class="form-group">
                Password: <input type="password" name="password" value="<?php echo @$_POST['password'];?>" required>
            </div>
            <div class="form-group">
                DeliveryAddress: <input type="text" name="address" value="<?php echo @$_POST['address'];?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Sign up</button>
        </div>
        </h2>
        <div class="text-center">
        <p>
            Already have an account? <a href="login.php">Login</a>
        </p>
        </div>
<?php
    if(@$response == "Success") {
        ?>
        <p class="success">Registered successfully</p>
        <?php
    } else {
        ?>
        <p class="error"><?php echo @$response; ?></p>
        <?php
    }
?>

    </form>
</body>
</html>