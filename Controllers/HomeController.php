<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
        
    }
?>