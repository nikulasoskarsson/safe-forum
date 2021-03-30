<?php
    session_start();
    function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
    }