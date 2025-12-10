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

}
