<?php

require_once("../Class/connexion.php");
require_once("../Class/User.php");

$user = new User;

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"]; 

    $user->loginUser($email,$password);

    header("Location: ../index.php");
    exit();
}
