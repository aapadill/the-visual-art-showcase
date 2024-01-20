<?php
namespace Controllers;
use Models\User;

class Session {
    public function __construct() {
        session_start();
    }

    public function getSesion() {
        return $_SESSION;
    }

    public function insert($key, $value){
        $_SESSION[$key] = $value;
    }

    public function get($key){
        $keys = explode('.', $key);
        $res = $_SESSION;

        $i = 0;
        while (isset($res) && $i < count($keys)) {
            $res = $res[$keys[$i]] ?? null;
            $i++;
        }
        return $res;
    }
}