<?php
define("PROJECT_PATH", '/Final');
define("COMPLETE_PROJECT_PATH", $_SERVER['DOCUMENT_ROOT'] . PROJECT_PATH);

spl_autoload_register('loader');

function loader($class){
    $route = COMPLETE_PROJECT_PATH;
    $extension = ".php";

    //convert namespace separators to directory separators
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    //build the file path (based on PSR-4 namespace-to-directory mapping)
    $filePath = "{$route}{$class}{$extension}";

    if (file_exists($filePath)) {
        require_once($filePath);
    } elseif (file_exists(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "{$class}{$extension}")) {
        //check the (current) parent directory
        require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "{$class}{$extension}");
    } elseif (file_exists(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "{$class}{$extension}")) {
        //check the (current) grandparent directory
        require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "{$class}{$extension}");
    } else {
        //class file not found
        throw new Exception("Class '{$class}' not found.");
    }
}
?>