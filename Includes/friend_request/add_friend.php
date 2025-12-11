<?php 
session_start();
    require_once("../../Class/connexion.php");
    require_once("../../Class/Friend.php");
    $sender_id = $_SESSION["id"];
    $friendObj = new Friend;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $reciver_id = $_POST["receiver_id"];
        if($friendObj->addfriend($sender_id,$reciver_id)){
            echo "friend request sended";
        }
        else{
            echo "problem!";
        }        
    }
?>