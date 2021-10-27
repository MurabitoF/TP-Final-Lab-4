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
          <span class="btn menu" onclick="openNav()">Menu <i class="fas fa-sort-down"></i></span>
          <div id="mySidenav" class="sidenav">
               <a href="javascript:void(0)" id="closeBtn" class="closebtn" onclick="closeNav()">&times;</a>
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Ver Empresas</a>
               <?php if ($loggedUser->getRole() == "Admin") { ?>
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowAddView">Agregar Empresa</a>


                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Student/ShowAddView">Agregar Alumno</a>

               <?php } else { ?>

                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Student/ShowDataView">Ver mis datos</a>

               <?php } ?>

               <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/LogOut">Log Out</a>
          </div>
     </div>
</nav>
<script>
     function openNav() {
          document.getElementById("mySidenav").style.width = "250px";
     }

     function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
     }
</script>