<?php
 require_once('controler.php');
 ob_start();

 $c = new controler();
 $catego = $_GET["catego"];
 //unset( $_GET );

 $c->afficher_catego( $catego );

?>