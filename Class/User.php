<?php
class User extends db {

    public function registerUser($username, $email, $password, $pfp_image, $game_playing, $rank) {


        $password_hash = password_hash($password,PASSWORD_DEFAULT);
        $query = "INSERT INTO users (user_name, email, password, profile_img, game_playing, rank)
                  VALUES (:username, :email, :password, :pfp_image, :game, :rank)";
        
        $stmt = $this->connect()->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password_hash);
        $stmt->bindParam(":pfp_image", $pfp_image);
        $stmt->bindParam(":game", $game_playing);
        $stmt->bindParam(":rank", $rank);

        return $stmt->execute();
    }

    public function loginUser($email,$password){
        $query = "SELECT * FROM users WHERE email =:email";
        $stmt= $this->connect()->prepare($query);
        $stmt->bindParam(":email",$email);
        $stmt->execute();

        if($stmt->rowCount() === 0){
            return "Email Not Found";
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!password_verify($password,$user["password"])){
            return "Password Incorrect";
        }

        session_start();
        $_SESSION["id"] = $user["id"];
        $_SESSION["username"] = $user["user_name"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["profile"] = $user["profile_img"];
        $_SESSION["rank"] = $user["rank"];
    }

    public function getUserInfo($user_id){
        $query = "SELECT * FROM users WHERE id = :user_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":user_id",$user_id);
        try{
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

}
