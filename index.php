<?php 
session_start();
$loggedIn = false;
if(!isset($_SESSION["id"])){
    echo "please register";
}
else{
    echo "welcome again ". $_SESSION["username"];
    $loggedIn = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php  if(!$loggedIn) { ?>
            <a href="pages/login.php">
    <button>login</button>
    </a>
    <a href="pages/register.php">
    <button>register</button>
    </a>
   <?php }?>

</body>
</html>