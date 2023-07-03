<?php
 require_once('controler.php');
 ob_start();

 $c = new controler();
 
 $c->afficher_page_nutrition( );

?>