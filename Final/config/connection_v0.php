<?php
define('host', 'localhost');
define('user_database', 'root');
define('password_database', null);
define('database', 'VisualArtShowcaseDB');

//opens a connection to a specified DB
function openConnection() {
    $connection = mysqli_connect(host, user_database, password_database, database);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " .  mysqli_connect_error();
        exit();
    }
    return $connection;
}

//executes a sql query
function executeQuery($connection, $sql){
    //in here, $result in only an instance of the mysqli_result class
    $results = mysqli_query($connection, $sql);
    mysqli_close($connection);
    return $results;
}

//cleans the string array before the query to avoid code-injection
function cleanData($connection, $value){
    if (is_string($value)){
        return mysqli_real_escape_string($connection, $value);
    } elseif(is_array($value)){
        $result = [];
        foreach($value as $key => $value2){
            $result[$key] = cleanData($connection, $value2);
        }
        return $result;
    } else {
        return $value;
    }
}
?>