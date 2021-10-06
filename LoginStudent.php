<?php 
require('Config\Autoload.php');

use Config\Autoload as Autoload;

Autoload::Start();

use Models\Student as Student;
use DAO\StudentDAO as StudentDAO;

if($_POST){

    if(isset($_POST["username"]) && isset($_POST["password"])){
        
        $username = $_POST["username"]; ///MIRAR SI SE PASA COMO EMAIL O USERNAME
        $password = $_POST["password"]; ///AGREGADA PARA CONTRASEÑA EN UN FUTURO

        $studentDAO = new StudentDAO();
        $user = $studentDAO->GetByUserName($username); ///FUNCION AGREGADA POR MI EN StudentDAO.php

        if($user != null && ($password == $user->getPassword()))
        {
            session_start();

            $loggedUser = new Student();
            $loggedUser->setEmail($username);///VER ESTO
            $loggedUser->setPassword($password);///VER ESTO

            $_SESSION["loggedUser"] = $loggedUser;

            header("Location: Views/student-list.php");
        }
        else{
            echo "<script> if(confirm('Datos incorrectos, vuelva a intentarlo !'));";  
            echo "window.location = 'index.php'; </script>";
        }
    }
    else{
        echo "<script> if(confirm('Hubo un problema al procesar los datos, vuelva a intentarlo !'));";  
        echo "window.location = 'index.php'; </script>";
    }
}
else{
    echo "<script> if(confirm('No es posible procesar informacion si no es por metodo POST !'));";  
    echo "window.location = 'index.php'; </script>";
}

?>