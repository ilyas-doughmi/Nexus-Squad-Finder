<?php

class Friend extends db
{

    private function checkInvitation($sender_id, $receiver_id)
    {
        $query = "SELECT * FROM friend_request WHERE sender_id = :sender_id AND receiver_id = :receiver_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":sender_id", $sender_id);
        $stmt->bindParam(":receiver_id", $receiver_id);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }

        if ($stmt->rowCount() == 0) {
            return true;
        } else {
            return false;
        }
    }
    public function addfriend($sender_id, $receiver_id)
    {
        $query = "INSERT INTO friend_request(sender_id,receiver_id) VALUES(:sender_id,:receiver_id)";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":sender_id", $sender_id);
        $stmt->bindParam(":receiver_id", $receiver_id);

        if ($this->checkInvitation($sender_id, $receiver_id)) {
            try {
                $stmt->execute();
                return "Friend Request sended succ";
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            return "you've already send him inv";
        }
    }

    public function getPendingRequests($user_id){
        $query = "SELECT * FROM friend_request WHERE receiver_id = :user_id AND status = :pending";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":user_id",$user_id);
        $stmt->bindValue(":pending",'pending');

        try{
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function acceptFriendRequest($sender_id,$receiver_id){
        $query = "UPDATE friend_request SET status = :accepted WHERE status = :pending AND sender_id = :sender_id AND
        receiver_id = :receiver_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(":pending",'pending');
        $stmt->bindValue(":accepted",'accepted');
        $stmt->bindParam(":sender_id",$sender_id);
        $stmt->bindParam(":receiver_id",$receiver_id);

        try
        {
            $stmt->execute();
            return "friend requested accepted"; 
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
}
