<?php
require_once ('ctl_Admin.php');
class viewAdmin{

/************************************************Page vue admin********************/
    

/* -------------------METHODES COMMUNES A TOUS LES PAGES D ADMISTRATEUR-------------------------------------------------------------------------------- */
    public function afficher_head( $title )
    { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
            <?php 
            echo "<title>".$title."</title>"; 
            ?>

            <link rel="stylesheet" href="CSS/AdminStyle.css">
            <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
            
            
            <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
            <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>  
            
            <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
            <script type="text/javascript" src="js/effectsAdmin.js"> </script> 

            
        </head>
        <body>
            <div class="GrandConteneur">
    <?php 
    }
    /* --------------------------------------------------------------------------------------------------- */
    public function afficher_entete( )
    { ?> 
        <div id="header">
            <div class="logo">
                <img src="img/logo2.jpg" alt="">
            </div>
    
            <div class="title">
                <span>Cuisine Algérienne</span>
            </div>
            <div class="droite">
                <div class="linkSocial">
                    <a href="" class="icon">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
    
                    <a href="" class="icon">
                        <i class="fa-brands fa-instagram"></i>                
                    </a>
    
                    <a href="" class="icon">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </div>
    
                <div class="user">
                        <form action="<?php $controlerAdmin=new controlerAdmin();$controlerAdmin->logout();?>" method="post">
                            <button type="submit" name="logout">Deconnecter</button>
                        </form>
                </div>

            </div>
    </div>

    <?php 
    }

    public function afficher_pied()
    { ?>
        <footer>
        </footer>
        </div> 
        <!-- Fin de grand container -->
    </body>
    </html>
    
    <?php 
    }
    /*---------------------------------------------------------------------------------------------------- */
    public function afficher_menu()
    { ?>
        <ul class="menu">
            <li> <a href="indexAdmin.php">Gestion des recettes</a></li>
            <li> <a href="gestion_News.php">Gestion des « News »</a></li>
            <li> <a href="gestion_users.php">La gestion des utilisateurs</a></li>
            <li> <a href="gestion_ingredients.php">Gestion de la nutrition</a></li>
            <li> <a href="gestion_parametres.php">Paramètres</a></li>
        </ul>

    <?php 
    }

    /* --------------------------------------------------------------------------------------------------- */

    public function afficher_titre( $titre_table)
    { 
        echo "<div class='title'>".$titre_table."</div>";
    }


/**************************************FIN PAGES COMMUNES*********************************************/

/* ----------------------------GESTION DES RECETTES ----------------------------------------- */
    
    public function afficher_site_Admin()
    {
        $this->afficher_head("Page administrateur pour gerer Recettes");
        $this->afficher_entete();
        $this->afficher_menu();
        $this->afficher_titre( "Gestion des Recettes" );
        $this->afficher_body_recettes();
        $this->afficher_pied();
    }
    
    
    public function afficher_body_recettes()
    { ?>
            <div class="Container">
            <?php 
            $this->btn_add();
            $this->tablerecette();
            ?>  
            </div>
    <?php 
    }


    public function btn_add()
    {  ?>
        <button id="btn_add_recette" class="btn_admin green" >Ajouter Recette</button>

        <div class="container_form">
            <form  method = "POST" 
            method = "POST" 
            action="<?php $controlerAdmin=new controlerAdmin();$controlerAdmin->insertRecette();?>" 
            class="form_admin" id="add_recette" 
            >
                <div class="title">Formulaire pour construction d'une Recette</div>

                <label>Nom </label> <input type="text" name = "nom" required >
                <label>image </label> <input type="file" name = "img" >
                <label>Video </label> <input type="file" name = "videoR" >

                <label>desciption</label> <input type="text" name = "desciption" >

                <label>Notation(/10)</label> <input type="number" name = "notation" >
                <label>Difficulté(/5) </label> <input type="number" name = "difficulte" >
                <label>categorie(entree, plat, dessert, boisson)</label> <input type="text" name = "categorie" >

                <label>Temps Preparation(en min)</label> <input type="number" name = "temps_prepa" >
                <label>Temps repos(en min)</label> <input type="number" name = "temps_repos" >
                <label>Temps cuissance(en min)</label> <input type="number" name = "temps_cuiss" >

                <label>Saison(1:printemps, 2:ete, 3:automne, 4:hiver, 5:tout_anne</label> <input type="number" name = "saisonR" >
                <label>Healty(1:healty, 0: Non healty) </label> <input type="number" name = "healthyR" >
                
                <input  name="nb_ing" id="nb_ing" type ="hidden" value="1">
                <div id="ings">
                    <div>
                        <label>Ingredient(quantite:ingredient)</label> <input type="text" name = "ing_1" placeholder="quantite:ingredient"> 
                        <button type="button" class = "add_ingred" >Ajouter</button> 
                        <button type="button" class = "del_ingred" >supprimer</button>
                        <br> <br>
                    </div>
                        
                </div>

                <input name="nb_meto" id="nb_meto" type ="hidden" value="1">
                <div id="metos">
                    <div>
                        <label>Methode de cuissance(methode:bonne 1, sinon 0)</label> <input type="text" name = "meto_1" placeholder="methode:bonne 1, sinon 0"> 
                        <button type="button" class = "add_meto" >Ajouter</button> 
                        <button type="button" class = "del_meto" >supprimer</button>
                        <br> <br>
                    </div>
                        
                </div>

                <input name="nb_etape" id="nb_etape" type ="hidden" value="1">
                <div id="etapes">
                    <div>
                        <label>Etape(le point indique fin d'une etape)</label> <input type="text" name = "etape_1" > 
                        <button type="button" class = "add_etape" >Ajouter</button> 
                        <button type="button" class = "del_etape" >supprimer</button>
                        <br> <br>
                    </div>
                        
                </div>
                

                <div class="btns">
                    <button type="submit" class="btn_admin green" name="add_recette">Valider</button>
                    <button type="annuler" class="btn_admin" id="annuler_add_recette">Annuler</button>
                </div>
                

            </form>
        </div>

        <?php
    }


    public function tablerecette()
    {
        ?>
            <div class="title_table"> Tableax des Recettes</div>

        <div class="wrapper">

            <button id="trie_catego">Trie par categorie</button>
            <button id="trie_notation">Trie par notation</button>
            <button id="trie_TP">Trie par temp de prepration</button>
            <button id="trie_TC">Trie par temp de cuissance</button>
            <button id="trie_TT">Trie par temp totale</button>

            <button id="trie_calories">Trie par nombre de calories</button>
            <button id="trie_sasion">Trie par saison</button>
            
            <Table class="table tableau recettes table-striped table-bordered " id="TableRecettes" 
            data-toggle="table"
            data-search="true"
            >
            
                <thead>
                    <tr>
                        <th scope="col">Modifier</th>
                        <th scope="col">Suprrimer</th>

                        <th scope="col">Nom</th>
                        <th scope="col">img</th>
                        <th scope="col">Video</th>

                        <th scope="col">Description</th>

                        <th scope="col">Ingredients(quantite:ingredient,)</th>

                        <th scope="col">Etapes(etape1.etape2)</th>

                        <th scope="col">Methode cuissance(methode1:bonne ou pas, methode2:)</th>

                        <th scope="col">Notation(/10)</th>
                        <th scope="col">Difficulté(/5)</th>
                        <th scope="col">categorie(entree, plat, dessert, boisson)</th>

                        <th scope="col">Temps Preparation(en min)</th>
                        <th scope="col">Temps repos(en min)</th>
                        <th scope="col">Temps cuissance(en min)</th>

                        <th scope="col">Temps totale(en min)</th>
                        <th scope="col">Nombre de calories(en kcal)</th>

                        <th cope="col">Saison(1:printemps, 2:ete, 3:automne, 4:hiver, 5:tout_anne)</th>
                        <th scope="col">Healthy(1:healty, 0: Non healty)</th>
                        <th scope="col">Ajouter par(IDuser, admin:0)</th>



                        <th scope="col">details</th> 

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $controller = new controlerAdmin();
                    $res = $controller->get_recettes();
                    foreach ($res as $recette) { ?>
                        
                        <tr>
                            
                            <form method="POST" action="<?php $controller=new controlerAdmin();$controller->editRecette();?>">
                                
                                <input type="hidden" name="id" value="<?php echo $recette['IdR'] ?>">

                                <td><button type="submit" name="EditRecette" >Edit</button></td>
                                <td><button name="deleteRecette" onsubmit="<?php $controller=new controlerAdmin();$controller->deleteRecette();?>">Delete</button></td>
                        
                                <th scope="row"><input type="text" name="titre" value="<?php echo $recette["titre"] ?>"></th>
                                <td><input type="text" name="img" value="<?php echo $recette["img"] ?>"></td>
                                <td><input type="text" name="videoR" value="<?php echo $recette["videoR"] ?>"></td>
                                <td><input type="text" name="Descript" value="<?php echo $recette["Descript"] ?>"></td>
                            
                                <!-- recuperation ingrdient  -->  
                                <?php 
                                $id = $recette['IdR'];
                                $ings = $controller->get_ings_recette( $id );
                                $chaine_ings = "";
                                foreach ($ings as $ing) 
                                {
                                    $i= $ing["IDIngredient"];
                                    $q= $ing["quantite"];
                                    $chaine_ings.="$q:$i,";
                                }
                                echo "<td><input type='text' name='ings' value='$chaine_ings'></td>";
                                
                                //etapes                                
                                $etapes = $controller->get_etapes_recette( $id );
                                $chaine_etapes = "";
                                foreach ($etapes as $etape) 
                                {
                                    $e= $etape["descript"];
                                    $chaine_etapes.="$e.";
                                }
                                ?>
                                <td><input type='text' name='etapes' value="<?php echo $chaine_etapes ?>"></td>
                                
                                <?php 
                                //methode                                
                                $methodes = $controller->get_methodes_recette( $id );
                                $chaine_methodes = "";
                                foreach ($methodes as $methode) 
                                {
                                    $m= $methode["methode"];
                                    $b= $methode["bonne"];

                                    $chaine_methodes.="$m:$b,";
                                }
                                echo "<td><input type='text' name='methodes' value='$chaine_methodes'></td>";
                                ?>

                                <td><input type="number" name="notation" value="<?php echo $recette["notation"] ?>"></td>
                                <td><input type="number" name="difficulte" value="<?php echo $recette["difficulte"] ?>"></td>

                                <td><input type="text" name="categorie" value="<?php echo $recette["categorie"] ?>"></td>

                                <td><input type="number" name="Temp_prepa" value="<?php echo $recette["Temp_prepa"] ?>"></td>
                                <td><input type="number" name="Temp_repo" value="<?php echo $recette["Temp_repo"] ?>"></td>
                                <td><input type="number" name="Temp_cuiss" value="<?php echo $recette["Temp_cuiss"] ?>"></td>

                                <td><input type="number" name = "Temp_totale" valeur="1"><?php /*echo $recette["Temp_totale"] */ ?></td>
                                <td><input type="number" name = "calories" valeur="2"><?php /*echo $recette["nb_calories"] */?></td>

                                <td><input type="number" name="saisonR" value="<?php echo $recette["saisonR"] ?>"></td>
                                <td><input type="number" name="healthyR" value="<?php echo $recette["healthyR"] ?>"></td>
                                
                                <td><input type="number" name="ajouter_par" value="<?php echo $recette["ajouter_par"] ?>"></td>

                                <?php
                                $id = $recette['IdR'];
                                echo "<td><a  href='recette_details_Admin.php?id=$id' name='details' class='btn'>Details</a></td>"; 
                                ?>

                                </form> 

                        </tr>
                        <?php
                    }
                        ?>
                </tbody>
            </Table>
        </div>

            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

            <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
            <script>
                $(document).ready(function(){
                    $('#TableRecettes').dataTable();
                });
            </script>  
            

            <br>
        <?php
    }



/* ----------------------------GESTION DES NEWS ----------------------------------------- */
    
public function afficher_gestion_News()
{
    $this->afficher_head("Page administrateur gerer News");
    $this->afficher_entete();
    $this->afficher_menu();
    $this->afficher_titre( "Gestion des News" );
    $this->afficher_body_news();
    $this->afficher_pied();
}


public function afficher_body_news()
{ ?>
        <div class="Container">
        <?php 
        $this->btn_add_news();
        $this->table_News();
        ?>  
        </div>
<?php
}



public function btn_add_news()
{  ?>
    <button id="btn_add_news" class="btn_admin green" >Ajouter News</button>

    <div class="container_form">
        <form method = "POST" 
        action="<?php $controlerAdmin=new controlerAdmin();$controlerAdmin->insertNews();?>" 
        class="form_admin" id="add_news" 
        >
            <div class="title">Formulaire pour construction d'une nouvelle</div>

            <label>Titre </label> <input type="text" name = "titre" >
            <label>image </label> <input type="file" name = "imgN" >  
            <label>desciption</label> <input type="text" name = "descript" >

            <label>video</label> <input type="text" name = "videoN" >
            
            <label>Paragraphe </label> <input type="text" name = "p" >

            <div class="btns">
                <button type="submit" class="btn_admin green" name="add_news">Valider</button>
                <button type="annuler" class="btn_admin" id="annuler_add_news">Annuler</button>
            </div>
            

        </form>
    </div>

    <?php
}


public function table_News()
{
    ?>
        <div class="title_table"> Tableax des News</div>

    <div class="wrapper">


        <Table class="table tableau recettes table-striped" id="TableNews" 
            data-toggle="table"
            data-search="true"  >
        <!-- data-pagination="true" -->
            <thead>
                <tr>
                    <th scope="col">Modifier</th>
                    <th scope="col">Suprrimer</th>

                    <th scope="col">Titre</th>
                    <th scope="col">image</th>
                    <th scope="col">Description</th>

                    <th scope="col">Video</th>

                    <th scope="col">Contenue</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $controller = new controlerAdmin();
                $news = $controller->get_news();
                foreach ($news as $new) { ?>
                    
                    <tr>
                        <form method="POST" action="<?php $controller=new controlerAdmin();$controller->editNews();?>">
                            <input type="hidden" name="IDNews" value="<?php echo $new['IDNews'] ?>">

                            <td><button type="submit" name="EditNews" >Edit</button></td>
                            <td><button name="deleteNews" onsubmit="<?php $controller=new controlerAdmin();$controller->deleteNews();?>">Delete</button></td>

                            <th scope="row"><input type="text" name="titre" value="<?php echo $new["titre"] ?>"></th>
                            <td><input type="text" name="imgN" value="<?php echo $new["imgN"] ?>"></td>
                            <td><input type="text" name="descript" value="<?php echo $new["descript"] ?>"></td>

                            <td><input type="text" name="videoN" value="<?php echo $new["videoN"] ?>"></td>

                            <?php 
                        
                            $paragraphes = $controller->get_new_details( $new["IDNews"] );
                            $chaine= "";
                                foreach ($paragraphes as $p) {
                                    $chaine .= $p["details"];
                                }
                                ?>
                                <td><input type="text" name="p" value="<?php echo $chaine; ?>"></td> 

                            

                            </form> 

                    </tr>
                    <?php
                }
                    ?>
            </tbody>
        </Table>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

            <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
            <script>
                $(document).ready(function(){
                    $('#TableNews').dataTable();
                });
            </script> 
    </div>

        <br>
    <?php
}

















/* ----------------------------GESTION DES PARAMETRES ----------------------------------------- */
    
public function afficher_gestion_parametres()
{
    $this->afficher_head("Page administrateur gerer parametre de site");
    $this->afficher_entete();
    $this->afficher_menu();
    $this->afficher_titre( "Controle des parametres" );
    $this->afficher_body_para();
    $this->afficher_pied();
}


public function afficher_body_para()
{ ?>
        <div class="Container">
        <?php 
        $this->btn_add_para();
        $this->table_para();
        ?>  
        </div>
<?php
}



public function btn_add_para()
{  ?>
    <button id="btn_add_para" class="btn_admin green" >Ajouter Un parametre</button>

    <div class="container_form">
        <form method = "POST" 
        action="<?php $controlerAdmin=new controlerAdmin();$controlerAdmin->insertP();?>" 
        class="form_admin" id="add_para" 
        >
            <div class="title">Formulaire d'ajoute d'une nouveau parametre</div>

            <label>Nom parametre </label> <input type="text" name = "nom" required>
            <label>Sa valeur </label> <input type="text" name = "valeur" >  

            <div class="btns">
                <button type="submit" class="btn_admin green" name="add_para">Valider</button>
                <button type="button" name="annuler" class="btn_admin" id="annuler_add_para">Annuler</button>
            </div> 

        </form>
    </div>

    <?php
}


public function table_para()
{
    ?>
        <div class="title_table">Tableaux des parametres</div>

        <div class="wrapper">

        <Table class="table tableau recettes table-striped" id="TableParas" 
            data-toggle="table"
            data-search="true"  >
        <!-- data-pagination="true" -->
            <thead>
                <tr>
                    <th scope="col">Modifier</th>
                    <th scope="col">Suprrimer</th>

                    <th scope="col">Nom parametre</th>
                    <th scope="col">valeur</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $controller = new controlerAdmin();
                $paras = $controller->get_paras();
                foreach ($paras as $para) { ?>
                    
                    <tr>
                        <form method="POST" action="<?php $controller=new controlerAdmin();$controller->editP();?>">
                            <input type="hidden" name="ID" value="<?php echo $para["ID"]; ?>">

                            <td><button type="submit" name="EditP" >Edit</button></td>
                            <td><button name="deleteP" onsubmit="<?php $controller=new controlerAdmin();$controller->deleteP();?>">Delete</button></td>

                            <th scope="row"><input type="text" name="nom" value="<?php echo $para["nom_parametre"] ?>"></th>
                            <td><input type="text" name="valeur" value="<?php echo $para["valeur"] ?>"></td>
                        </form> 
                    </tr>
                    <?php
                }
                    ?>
            </tbody>
        </Table>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

            <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
            <script>
                $(document).ready(function(){
                    $('#TableParas').dataTable();
                });
            </script> 
    </div>

        <br>
    <?php
}











/* ----------------------------GESTION DES UTILISATEURS ----------------------------------------- */
    
public function afficher_gestion_users()
{
    $this->afficher_head("Page administrateur gerer Utilisateurs");
    $this->afficher_entete();
    $this->afficher_menu();
    $this->afficher_titre( "Gestion des Utilisateurs" );
    $this->afficher_body_users();
    $this->afficher_pied();
}


public function afficher_body_users()
{ ?>
        <div class="Container">
        <?php 
        $this->table_users();
        ?>  
        </div>
<?php 
}


public function btn_add_user()
{  ?>
    <button id="btn_add_user" class="btn_admin green" >Ajouter User</button>

    <div class="container_form">
        <form method = "POST" 
        action="<?php $controlerAdmin=new controlerAdmin();$controlerAdmin->insertUser();?>" 
        class="form_admin" id="add_user" >
            <div class="title">Formulaire pour construction d'un nouveau utlisateur</div>

            <label>Username </label> <input type="text" name = "username" >
            <label>Password </label> <input type="text" name = "pwd" >
            
            <div class="btns">
                <button type="submit" class="btn_admin green" name="add_user">Valider</button>
                <button type="annuler" class="btn_admin" id="annuler_add_user"">Annuler</button>
            </div>

        </form>
    </div>

    <?php
}


public function table_users()
{
    ?>
        <div class="title_table"> Tableaux des Utilisateurs</div>

    <div class="wrapper">


        <Table class="table tableau recettes table-striped" id="TableUsers" 
            data-toggle="table"
            data-search="true"  >
        <!-- data-pagination="true" -->
            <thead>
                <tr>
                    <!-- <th scope="col">Modifier</th> -->
                    <th scope="col">Suprrimer</th>

                    <th scope="col">username</th>
                    <th scope="col">pwd</th>

                    <th scope="col">nom</th>
                    <th scope="col">prenom</th>
                    <th scope="col">sexe</th>

                    <th scope="col">mail</th>
                    <th scope="col">date_naissance</th>

                    <th scope="col">recettes preferes(par nom)</th>
                    <th scope="col">recettes ajouter par celui(par nom)</th>


                </tr>
            </thead>
            <tbody>
                <?php
                $controller = new controlerAdmin();
                $users = $controller->get_users();
                foreach ($users as $user) { ?>
                    
                    <tr>

                        <form method="POST" action="">
                            <input type="hidden" name="IDUser" value="<?php echo $user['IDUser'] ?>">

                            <td><button name="deleteUser" onsubmit="<?php $controller=new controlerAdmin();$controller->deleteUser();?>">Delete</button></td>

                            <th scope="row"><?php echo $user["username"] ?></th>
                            <th scope="row"><?php echo $user["pwd"] ?></th>
                            
                            <td scope="row"><?php echo $user["nom"] ?></td>
                            <td scope="row"><?php echo $user["prenom"] ?></td>
                            <td scope="row"><?php echo $user["sexe"] ?></td>
                            
                            <td scope="row"><?php echo $user["mail"] ?></td>
                            <td scope="row"><?php echo $user["date_naissance"] ?></td>

                            <?php 
                                $id = $user['IDUser'];

                                $prefs = $controller->get_pref_user( $id );
                                $chaine_prefs = "";
                                foreach ($prefs as $pref) 
                                {
                                    $i= $pref["titre"];
                                    $chaine_prefs.="$i,";
                                }
                                echo "<td><input type='text' name='prefs' value='$chaine_prefs'></td>";

                                $ajouters = $controller->get_ajouter_user( $id );
                                $chaine_adds = "";
                                foreach ($ajouters as $ajouter) 
                                {
                                    $i= $ajouter["titre"];
                                    $chaine_adds.="$i,";
                                }
                                echo "<td><input type='text' name='ajoutes' value='$chaine_adds'></td>";
                                ?>

                        
                        </form> 

                    </tr>
                    <?php
                }
                    ?>
            </tbody>
        </Table>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

            <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
            <script>
                $(document).ready(function(){
                    $('#TableUsers').dataTable();
                });
            </script> 
    </div>

        <br>
    <?php
}










//*********************************************PAGE INGREDIENTS
    public function afficher_Admin_ing()
    {
        $this->afficher_head("Page administrateur gerer Ingredients");
        $this->afficher_entete();
        $this->afficher_menu();
        $this->afficher_titre( "Gestion des ingredients et leur informations");
        $this->afficher_body_ingredients();
        $this->afficher_pied();
    }


    public function afficher_body_ingredients()
    { ?>
            <div class="Container">
                <?php 
                $this->btn_add_ings();
                $this->tableings();
                ?>  
            </div>
    <?php 
    }

    public function btn_add_ings( )
    {
        ?>
            <button id="btn_add_ing" class="btn_admin green" >Ajouter Ingredient</button>

            <div class="container_form">
                <form method = "POST" 
                action="<?php $controlerAdmin=new controlerAdmin();$controlerAdmin->insertIng();?>" 
                class="form_admin" id="add_ing">

                    <div class="title">Formulaire pour Ajoute d'un Ingredient</div>

                    <label>Son Nom </label> <input type="text" name = "Nom" required>
                    <label>Sa saison naturelle(printemps, ete, automne ,hiver) </label> <input type="text" name = "saisonI" >
                    <label>Healty(1:healty, 0:non healty)</label> <input type="number" name = "healty" >

                    <label>calories(en kcal)</label> <input type="number" name = "calories_kcal" >
                    <label>glucides(en g)</label> <input type="number" name = "glucides_g" >
                    <label>lipides(en g)</label> <input type="number" name = "lipides_g" >
                    <label>proteines(en g)</label> <input type="number" name = "proteines_g" >
                    <label>vitamines(en mg)</label> <input type="number" name = "vitamines_mg" >

                    <div class="btns">
                        <button type="submit" class="btn_admin green" name="add_ing">Valider</button>
                        <button type="button" class="btn_admin" id="annuler_add_ing">Annuler</button>
                    </div>
                </form>
            </div>
        <?php 
    }

    public function tableings()
    {
        ?>
            <div class="title_table"> Tableax des Ingredients</div>

            <div class="wrapper">

            <Table class="table tableau ings" id="TableIngs" >
                <thead>
                    <tr>
                        <th scope="col">Modifier</th>
                        <th scope="col">Suprrimer</th>

                        <th data-field="nom" scope="col">Nom</th>

                        <th scope="col">Saison naturelle(printemps, ete, automne ,hiver)</th>
                        <th scope="col">healty(1:healty, 0:non healty)</th>

                        <th scope="col">calories(kcal)</th>

                        <th scope="col">glucides(g)</th>
                        <th scope="col">lipides(g)</th>
                        <th scope="col">proteines(g)</th>

                        <th scope="col">vitamines(mg)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $controller = new controlerAdmin();
                    $res = $controller->get_ings();

                    foreach ($res as $ing) 
                    { ?>
                        <tr>
                            <form method="POST" action="<?php $controller=new controlerAdmin();$controller->editIng();?>">
                                <input type="hidDen" name="id" value="<?php echo $ing['IDin'] ?>"> 

                                <td><button type="submit" name="EditIng">Edit</button></td>
                                <td><button name="deleteIng" onsubmit="<?php $controller=new controlerAdmin();$controller->deleteIng();?>">Delete</button></td>
                        
                                <th scope="row"><input type="text" name="Nom" value="<?php echo $ing["IDIng"] ?>"></th>
                                <td><input type="text" name="saisonI" value="<?php echo $ing["NomSaison"] ?>"></td>
                                <td><input type="number" name="healty" value="<?php echo $ing["healty"] ?>"></td>

                                <td><input type="number" name="calories_kcal" value="<?php echo $ing["calories_kcal"] ?>"></td>
                                <td><input type="number" name="glucides_g" value="<?php echo $ing["glucides_g"] ?>"></td>
                                <td><input type="number" name="lipides_g" value="<?php echo $ing["lipides_g"] ?>"></td>

                                <td><input type="number" name="proteines_g" value="<?php echo $ing["proteines_g"] ?>"></td>
                                <td><input type="number" name="vitamines_mg" value="<?php echo $ing["vitamines_mg"] ?>"></td>

                                </form>
                        </tr>
                        <?php
                    }
                        ?>
                </tbody>
            </Table>
            </div>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

        <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#TableIngs').dataTable();
            });
        </script> 
            <br>
        <?php
    }

/***************************************FIN VIEW ADMIN*****************************/
    

}


?>
