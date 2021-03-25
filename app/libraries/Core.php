<?php
    // App core class
    // Creates URL & loads core controller
    // URL FORMAT - /controller/method/param
    class Core{
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            $url = $this->getUrl();

            // Look in controllers for controller for the first index in the url array
            if(file_exists(__DIR__ . '/../controllers/' . ucwords($url[0]) . '.php')){
                // If exists, set as controller
                $this->currentController = ucwords($url[0]);
                // Unset 0 index
                unset($url[0]);
            }
            // Require the controller
            require_once(__DIR__ . "/../controllers/$this->currentController.php");

            // Instantiate controller class
            $this->currentController = new $this->currentController;

            // Check for the second part of the url
            // Should be the method that gets loaded from the controller
            if(isset($url[1])){
                // Check to see if method exists in controller
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    // Unset 1 index
                    unset($url[1]);
                }
            }

            // Get params
            $this->params = $url ? array_values($url) : [];

            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/'); // If the url ends with a slash remove it
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url); // ['controller', 'method', 'params']
                return $url;
            }
        }
    }