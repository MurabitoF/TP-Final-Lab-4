<?php
if(isset($_SESSION['loggedUser'])){
    if( isset($_SESSION['lastActivity']) && (time() - $_SESSION['lastActivity'] > 60*1) ){
        session_unset();   
        session_destroy();
        header('Location: ../index.php');
    }else{
        session_regenerate_id(true);
        $_SESSION['lastActivity'] = time();
    }
} else {
    header("Location: ../index.php");
}