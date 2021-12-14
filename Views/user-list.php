<?php
require_once('nav.php');
require_once('header.php');

?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Usuarios</h2>
            <?php
            if ($alert) {
            ?>
                <div class="alert alert-<?php echo $alert->getType() ?> text-center fwbold" role="alert"><?php echo $alert->getMessage() ?></div>
            <?php
            }
            ?>
            <table id="userTable" class="table bg-light-alpha">
                <thead>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Borrar</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($userList as $user) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $user->getUsername() ?>
                            </td>
                            <td>
                                <?php echo $user->getRole() ?>
                            </td>
                            <td>
                                <?php
                                if ($_SESSION["loggedUser"]->getRole() == "Admin") {
                                ?>
                                    <a class="btn button-red" href="<?php echo FRONT_ROOT ?>User/RemoveUser?idUser=<?php echo $user->getIdUser() ?>"><i class="fas fa-trash-alt"></i></a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tr>

                </tbody>
            </table>
        </div>
    </section>
</main>

<?php
require_once('footer.php');
?>