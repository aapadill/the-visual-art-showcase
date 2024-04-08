<?php
define("project_path", '/Final');
define("root_path", $_SERVER['DOCUMENT_ROOT'] . project_path);

spl_autoload_register('loader');

function loader($class){
    $route = root_path . project_path;
    $extension = ".php";
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $class = str_replace('/', DIRECTORY_SEPARATOR, $class);

    //a) tries to find the file in root/project_path
    $filePath = "{$route}{$class}{$extension}";
    if (file_exists($filePath)) {
        require_once($filePath);
        return;
    }

    //b) tries to find the file in (current) parent directory
    $filePath = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "{$class}{$extension}";
    if (file_exists($filePath)){
        require_once($filePath);
        return;
    }

    //c) tries to find the file in (current) grandpa directory
    $filePath = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "{$class}{$extension}";
    if (file_exists($filePath)){
        require_once("{$route}{$class}{$extension}");
        return;
    }

    echo $class;
}
?>