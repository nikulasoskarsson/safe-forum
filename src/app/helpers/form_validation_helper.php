<?php
    function minMaxEmpty($field, $fieldName, $min, $max){
        if(empty($field)){
            return "$fieldName cannot be empty";
        }
        else if(strlen($field) < $min){
            return "$fieldName must be at leat $min characters long";
        }
        else if(strlen($field) > $max){
            return "$fieldName cannot be longer then $max characters long";
        } else{
            return '';
        }
    }

    function isValidEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 'Must enter a legitimate email address';
        } else {
            return '';
        }
    }

    function isPasswordSameAsConfirmPassword($password, $confirmPassword){
        if($password != $confirmPassword){
            return 'Not same as the original password';
        } else {
            return '';
        }
    }

    function isErrorInErrorArray($errorArray){
        foreach($errorArray as $error){
            if(!empty($error)){
                return true;
            }
        }
        return false;
    }