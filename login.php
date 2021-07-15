<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style1.css" />
</head>
<body>
<?php
require('config.php');
session_start();

if (isset($_POST['username'])){
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `users` WHERE username='$username' and password='".hash('sha256', $password)."'";
    $result = mysqli_query($conn,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){
        $_SESSION['username'] = $username;
        header("Location: index.php");
    }else{
        $message = "Invalid Username";
    }
}
?>
<form class="box" action="" method="post" name="login">
    <h1 class="box-logo box-title">Get Your Instrument</h1>
    <h1 class="box-title">Connexion</h1>
    <input type="text" class="box-input" name="username" placeholder="Username">
    <input type="password" class="box-input" name="password" placeholder="Password">
    <input type="submit" value="Log In " name="submit" class="box-button">
    <p class="box-register">Create new Account? <a href="register.php">Register</a></p>
    <?php if (! empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
</form>
</body>
</html>