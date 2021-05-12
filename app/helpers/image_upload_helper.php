<?php
    function uploadSingleImage($file){
        $allowedExtensions = array(
            'jpg', 'jpeg', 'png'
        );

        $name = $file['name'];
        $tmpName = $file['tmp_name'];
        $size = $file['size'];
        $error = $file['error'];
        $type = $file['type'];

        $extension = strtolower(explode('.', $name)[1]);
        if(!in_array($extension, $allowedExtensions)){
            echo 'not in array';
            return false;
        }
        // else if($error === 0){
        //     echo 'error';
        //     return false;
        // }
       
        $uniqueImgName = uniqid('', true) . ".$extension";
        $destination = ASSETS . "/img/profiles/$uniqueImgName";
        move_uploaded_file($tmpName, $destination);
        
        return $uniqueImgName;
    }