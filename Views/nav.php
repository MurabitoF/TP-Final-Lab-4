<?php

use Models\User as User;

$loggedUser = $_SESSION['loggedUser'];
?>

<nav class="navbar navbar-expand-lg ">
     <div class="container-fluid">
          <span class="logo">
               <a class="navbar-brand" href="<?php echo FRONT_ROOT ?>User/ShowHomeView">
                    <img src="http://localhost/TP-Final-Lab-4/Views/img/logo-utn-recruitment.png" alt="logo-utn">
               </a>
          </span>
          <ul class="navbar-nav ms-auto>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Ver Empresas</a>
               </li>
               <?php if ($loggedUser->getRole() == "Admin") { ?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowAddView">Agregar Empresa</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>Student/ShowAddView">Agregar Alumno</a>
                    </li>
               <?php } else { ?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>Student/ShowDataView">Ver mis datos</a>
                    </li>
               <?php } ?>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/LogOut">Log Out</a>
               </li>
          </ul>
     </div>
</nav>