<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style1.css" />
</head>
<body>
<?php
require('config.php');
if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){
    // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    //requéte SQL + mot de passe crypté
    $query = "INSERT into `users` (username, email, password)
              VALUES ('$username', '$email', '".hash('sha256', $password)."')";
    // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){
        echo "<div class='sucess'>
             <h3>Success !!</h3>
             <p>Click here to <a href='login.php'>Connect</a></p>
       </div>";
    }
}else{
    ?>
    <form class="box" action="" method="post">
        <h1 class="box-logo box-title">Get Your Instrument</h1>
        <h1 class="box-title">Register</h1>
        <input type="text" class="box-input" name="username" placeholder="Username" required />
        <input type="text" class="box-input" name="email" placeholder="Email" required />
        <input type="password" class="box-input" name="password" placeholder="Password" required />
        <input type="submit" name="submit" value="Register" class="box-button" />
        <p class="box-register">Already have account? <a href="login.php">Connect here</a></p>
    </form>
<?php } ?>
</body>
</html>