<?php
 require_once('controler.php');
 ob_start();

 $id = $_GET['id'];

 $c = new controler();
 
 $c->afficher_page_new( $id );

?>