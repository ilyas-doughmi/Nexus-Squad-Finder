<?php
session_start();
    require_once("../../Class/connexion.php");
    require_once("../../Class/Friend.php");
    $receiver_id = $_SESSION["id"];
    $friendObj = new Friend;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sender_id = $_POST["sender_id"];
        $result = $friendObj->acceptFriendRequest($sender_id,$receiver_id);
        echo $result;
    }