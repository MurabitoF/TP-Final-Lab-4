<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        }
        
        public function logOut()
        {
            session_start();
            session_destroy();
        
            header("Location: ../index.php");
        }
    }
?>