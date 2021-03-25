<?php
    // Load config
    require_once(__DIR__ . '/config/config.php');
    // load libraries
    // require_once(__DIR__ . '/libraries/Core.php');
    // require_once(__DIR__ . '/libraries/Controller.php');
    // require_once(__DIR__ . '/libraries/Database.php');

    // Autoload core libraries
    spl_autoload_register(function($className){
        require_once(__DIR__ . "/libraries/$className.php");
    });

    