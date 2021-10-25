<?php
use Controllers\UserController as UserController;

$userController = new UserController;

if(isset($_SESSION['loggedUser'])){
    if( isset($_SESSION['lastActivity']) && (time() - $_SESSION['lastActivity'] > 60*15) ){
        $userController->LogOut();
    }else{
        session_regenerate_id(true);
        $_SESSION['lastActivity'] = time();
    }
} else {
    $userController->ShowLogInView();
}