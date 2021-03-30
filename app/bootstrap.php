<?php
    // Load config
    require_once(__DIR__ . '/config/config.php');
    // Load helpers
    require_once(__DIR__ . '/helpers/form_validation_helper.php');
    require_once(__DIR__ . '/helpers/session_helper.php');
    require_once(__DIR__ . '/helpers/ui_helper.php');
    // Autoload core libraries
    spl_autoload_register(function($className){
        require_once(__DIR__ . "/libraries/$className.php");
    });

    