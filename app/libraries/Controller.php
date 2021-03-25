<?php
    // Base controller
    // Loads the models and views
    class Controller{
        // Load model
        public function model($model){
            // Require model file
            require_once(__DIR__ . "/../models/$model.php");
            var_dump(new $model);
            // Instantiate model
            return new $model();
        }
        
        // Load view
        public function View($view, $data = []){
            // Check for the view file
            if(file_exists(__DIR__ . "/../views/$view.php")){
                require_once(__DIR__ . "/../views/$view.php");
            }
            else{
                // View does not exist
                die('View does not exist');
            }
        }
    }