<?php
    function getBootstrapValidationClass($data, $filedName){
        if(!empty($data['errors'][$filedName])){
            return 'is-invalid';
        }
        // Form has been submitted and there was no error
        else if(!empty($data['form'][$filedName])){
            return 'is-valid';
        } else {
            return '';
        }
    }

    function checkAndShowError($field){
        if(!empty($field)){
            echo "<p class='text-danger'>$field</p>";
        }
    }