<?php
    require_once('ctl_Admin.php');
    ob_start();
    $c = new controlerAdmin();
    $c->afficher_gestion_parametres();
?>