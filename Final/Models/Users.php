<?php
namespace Models;
require_once('../config/autoloader.php');

use Models\DatabaseConnection;

namespace Models;

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
    
    /**
     * Initializes class properties based on input array.
     * 
     * @param array $userData
     *   An array with the following structure:
     *   [
     *       'user_id' => 'user_idValue',
     *       'username' => 'usernameValue',
     *       'email' => 'emailValue',
     *       'password' => 'passwordValue',
     *       'profile_picture' => 'profilePictureValue',
     *       'name' => 'nameValue',
     *       'bio' => 'bioValue',
     *       'location' => 'locationValue',
     *       'role_id' => 'roleIdValue'
     *   ]
     */
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
}
