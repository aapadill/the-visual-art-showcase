<?php
namespace Models;
require_once('../config/autoloader.php');
use Models\Connection;


class User {
    private $userId;
    private $username;
    private $email;
    private $password;
    private $profilePicture;
    private $name;
    private $bio;
    private $location;
    private $roleId;
    
    public function __construct($userData = []) {
        $this->userId = $userData['user_id'] ?? 0;
        $this->username = htmlentities($userData['username'] ?? '');
        $this->email = htmlentities($userData['email'] ?? '');
        $this->password = htmlentities($userData['password'] ?? '');
        $this->profilePicture = htmlentities($userData['profile_picture'] ?? '');
        $this->name = htmlentities($userData['name'] ?? '');
        $this->bio = htmlentities($userData['bio'] ?? '');
        $this->location = htmlentities($userData['location'] ?? '');
        $this->roleId = $userData['role_id'] ?? 1;
    }

    public static function consultar($userId = 0, $username = '') {
        $sql = "
            SELECT *
            FROM
                Users U
            WHERE 1 = 1
        ";

        $params = [];
        if (!empty($userId)) {
            $sql .= " AND user_id = :user_id";
            $params['user_id'] = $userId;
        }

        if (!empty($username)) {
            $sql .= " AND username = :username";
            $params['username'] = $username;
        }
        
        $connection = new Connection();
        $results = $connection->runQuery($sql, $params);

        $userData = $results->fetch();
        return new User($userData);
    }
}
