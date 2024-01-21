<?php
namespace Controllers;

class File {
    /**
     * Saves the image uploaded by the user
     * in the path $path with the name 
     * $imageName
     *
     * @param $image Array with the data of the uploaded image
     * @param $path Path where the image will be saved
     * @param $imageName optional name that will be given to the uploaded file
     *
     * @return boolean|string of the uploaded file if the upload was successful
     */
    public static function loadImage($image, $path, $imageName = '') {
        if (!in_array($image['type'], ['image/jpeg', 'image/png'])) {
            return false; // or handle the error
        }

        if ($image['size'] > 50000000) { // 50MB size limit
            return false; //or handle the error 
        }

        $info = pathinfo($image['name']);
        $ext = $info['extension'];

        if (!empty($imageName)) {
            $nameImage = "$imageName.$ext";
        } else {
            $nameImage = uniqid() . ".$ext";
        }

        $finalPath = "$path/$nameImage";

        if (is_uploaded_file($image['tmp_name'])) {
            if (move_uploaded_file($image['tmp_name'], $finalPath)) {
                return $finalPath;
            } else {
                return false; //or handle the error
            }
        } else {
            return false; //or handle the error
        }
    }
}
