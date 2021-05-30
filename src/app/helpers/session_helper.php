<?php
    session_start();
    if(empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }

    function validateToken($csrfToken) {
        return $_SESSION['csrf'] == $csrfToken;
    }

    function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
    }

    function destroyUserSession() {
        unset($_SESSION['user_id']);
    }

    function isLoggedIn() {
        return isset($_SESSION['user_id']) ? true : false;
    }

    function pageSession() {
        $_SESSION['pageNumber'] = 1;
    }