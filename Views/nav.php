<?php
use Models\User as User;
$loggedUser = $_SESSION['loggedUser'];
?>

<nav class="navbar navbar-expand-lg ">
     <span class="logo">
          <a href="<?php echo FRONT_ROOT ?>Home/index"><img src="img\logo-utn-recruitment.png" alt="logo-utn"></a>
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Ver Empresas</a>
          </li>
          <?php if($loggedUser->getRole() == "Admin"){?>
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
          <?php }?>          
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/logOut">Log Out</a>
          </li>          
     </ul>
</nav>