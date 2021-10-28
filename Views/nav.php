<?php

use Models\User as User;

$loggedUser = $_SESSION['loggedUser'];
?>

<nav class="navbar navbar-expand-lg justify-content-end">
     <div class="container-fluid">
          <span class="logo">
               <a class="navbar-brand" href="<?php echo FRONT_ROOT ?>User/ShowHomeView">
                    <img src="http://localhost/TP-Final-Lab-4/Views/img/logo-utn-recruitment.png" alt="logo-utn">
               </a>
          </span>
          <span class="btn menu" onclick="openNav()">Menu <i class="fas fa-sort-down"></i></span>
          <div id="mySidenav" class="sidenav">
               <span id="menu-text" class="user-select-none">Menu</span>
               <a href="javascript:void(0)" id="closeBtn" class="closebtn" onclick="closeNav()">&times;</a>
               <div class="menu-button">
                    <a href="<?php echo FRONT_ROOT ?>Company/ShowListView">Ver Empresas</a>
               </div>
               
               <?php if ($loggedUser->getRole() == "Admin") { ?>
                    <div class="menu-button">
                         <a href="<?php echo FRONT_ROOT ?>Company/ShowAddView">Agregar Empresa</a>
                    </div>
                    <div class="menu-button">
                         <a href="<?php echo FRONT_ROOT ?>JobOffer/ShowAdminListView">Ver Publicaciones</a>
                    </div>
                    <div class="menu-button">
                         <a href="<?php echo FRONT_ROOT ?>Student/ShowAddView">Agregar Alumno</a>
                    </div>
               <?php } else { ?>
                    <div class="menu-button">
                         <a href="<?php echo FRONT_ROOT ?>Student/ShowDataView">Ver mis datos</a>
                    </div>
                    <div class="menu-button">
                         <a href="<?php echo FRONT_ROOT ?>JobOffer/ShowStudentListView">Ver Publicaciones</a>
                    </div>
               <?php } ?>
               <div class="menu-button">
                    <a href="<?php echo FRONT_ROOT ?>User/LogOut">Log Out</a>
               </div>
               <div class="buttons">
                    <div>
                         <a class="btn button-blue" href="https://sicu.mdp.utn.edu.ar/datos/index.php">SICU</a>
                    </div>
                    <div>
                         <a class="btn button-blue" href="https://campus.mdp.utn.edu.ar/">Campus</a>
                    </div>
                    <div>
                         <a class="btn button-blue" href="https://utn.edu.ar/es/">UTN</a>
                    </div>
               </div>
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