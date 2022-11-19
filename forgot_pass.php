<?php
    require 'functions.php';
    if(isset($_POST['submit'])) {
        $response = passwordReset($_POST['email']);
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
        <h2 class="text-center text-info"><u>Reset Password</u></h2>
        <div class="container text-center" style="padding-top: 70px;  border-radius: 25px ">
            <div>
                Email: <input type="text" name="email" value="<?php echo @$_POST['email'];?>">
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        
        <p>
            <br>
            <a href="login.php"><u>Back to login page</u></a>
        </p>
        </div>
<?php
    if(@$response == "Success") {
        ?>
        <p class="success">Password reset link sent to your email</p>
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
