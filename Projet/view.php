<?php
require_once ('controler.php');
//******************************************Page view**************** */
class view{

    // les paramètres d'affichages
    public $nb_cara = 100;  // nb caractère de descrption d'une recette a afficher dans la page d'accueil
    public $nb_recette_ligne = 4; // nombre de recette a afcher dans une categirie dans page d'accueil
    public $IDRecette = 1; // id de recette a afficher dans la page recette
    public $trie_par = "default";

/********************************** METHODE COMMUNE **********************************/

/*--------------------------------------------------------------------------------------------------- */

public function afficher_entete( $choix )
{ ?> 
    <header>
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

            <?php $this->connecte( $choix ); ?>
        </div>
        <?php
        //echo "<div>CHOIX:".$choix."</div>";
        echo '</header>';
        if( $choix == 1){
            ?>
            <div id ="container_user">
                <div class="user_space">
                        <a href="pref.php">Mes preferences Recettes</a> <br> <br>
                        <a href="Ajouter_recette.php">Ajouter Recette</a> <br> <br>

                        <form method ="POST" action="<?php $controler = new controler(); $controler->logout(); ?>">
                            <button type="submit" name="logout">Deconncete</button>
                        </form>
                </div>
            </div>
            <?php
        }
        ?>

<?php 
}
/****************************************************************************/
        public function logo()
        {?>
            <div class="logo">
                <img src="img/logo2.jpg" alt="">
            </div>
            <?php 
        }
        public function title()
        { ?>
            <div class="title">
                <span>Cuisine Algérienne</span>
            </div>
            <?php 
        }

        public function social_link()
        {?>
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
            <?php 
        }

        public function connecte_space()
        {?>
            <div class="connecte">
                <a href="Login.php" class="" >Se Connecter</a>
                <a href="" class="icon">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>
            <?php 
        }
        public function user_space()
        {          if (!isset($_SESSION)) {  session_start();}

                echo "<button class='username'>"; 
                echo "<span class='' >Bienvenue ".$_SESSION["username"]." et son id = ".$_SESSION["IDUser"]."</span>"; 
                ?><a href="" class="icon">
                    <i class="fa-solid fa-user"></i>
                </a>
                echo "</button>";
                <?php 
        }

/***************************************************************/
public function connecte( $choix )
{ 
        if( $choix == 0){
            ?>
            <div class="connecte">
                <a href="login.php" class="" > Se Connecter</a>
                <a href="" class="icon">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>
            <?php 
        }
        else{
            if( $choix == 1 )
            {
            echo '<div class="user">';
                echo "<button id='compte'>"; 
                if (!isset($_SESSION)) {  session_start();}
                echo "<span class='' >Bienvenue ".$_SESSION['username']."</span>"; 
                ?>
                <a href="" class="icon">
                    <i class="fa-solid fa-user"></i>
                </a>  <br>
                </button> 
            </div>

                <?php 
            }
        }
            
}
/**********************************************************************/


 /* --------------------------------------------------------------------------------------------------- */
    public function afficher_pied()
    { ?>
        <footer>
            <ul class="menuF">
                <li> <a href="index.php">Acceuil</a></li>
                <li> <a href="page_news.php">News</a></li>
                <li> <a href="idee_recettes.php">Idés Recettes</a></li>
                <li> <a href="page_healthy.php">Healthy</a></li>

                <li> <a href="page_saison.php">Saison</a></li>
                <li> <a href="page_fetes.php">Fetes</a></li>
                <li> <a href="page_nutrition.php">Nutrition</a></li>
                <li> <a href="page_contact.php">Contact</a></li>
            </ul>
        </footer>
        </div>
    </body>
    </html>
        
    <?php 
    }

/* --------------------------------------Menu ------------------------------------------------------ */

public function afficher_menu()
{ ?>
      <ul class="menu">
        <li> <a href="index.php">Acceuil</a></li>
        <li> <a href="page_news.php">News</a></li>
        <li> <a href="idee_recettes.php">Idés Recettes</a></li>
        <li> <a href="page_healthy.php">Healthy</a></li>

        <li> <a href="page_saison.php">Saison</a></li>
        <li> <a href="page_fetes.php">Fetes</a></li>
        <li> <a href="page_nutrition.php">Nutrition</a></li>
        <li> <a href="page_contact.php">Contact</a></li>
    </ul>
 <?php 
}

public function titre( $titre )
{ ?>
    <div class="conteneur_titre">
        <span class="titre_generale"><?php echo $titre; ?></span>
    </div>
    <?php
}


/*******************************************************************FIN METHODE COMMUNE*******************************/










//!**********************form d'ajouter d'une nouvelle recette par utlisateur

public function affiche_form_Ajoute_recette()
{
    $this->afficher_Accueil_ajoute();
    $this->affiche_form();
}

public function afficher_Accueil_ajoute()
{
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Cache-Control" content="no-store" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Forme ajoute recette</title>
            <link rel="stylesheet" href="CSS/all.min.css">
            <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
            <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
            <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   

            <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
            <script type="text/javascript" src="js/effectsJQ.js"> </script>
        </head>
        <body >
    <?php 
}

public function affiche_form()
{ ?>

        <div class="container_form">
            <form  
            method = "POST"   
            action="<?php $c=new controler();$c->insertRecette();?>" 
            class="form_admin" id="add_recette" 
            > 
                <div class="titre_generale">Formulaire pour construction d'une Recette</div>
                <?php
                    if (!isset($_SESSION)) {  session_start();}
                    $userID = $_SESSION["IDUser"];
                    echo "<input type='hidden' name='userID' value='$userID'>";
                ?>
                <label>Nom </label> <input type="text" name = "nom" required >
                <label>image </label> <input type="file" name = "img" >
                <label>Video </label> <input type="file" name = "videoR" >

                <label>desciption</label> <input type="text" name = "desciption" >

                <label>Notation(/10) </label> <input type="number" name = "notation" >
                <label>Difficulté(/5, 4: 1:trés facile, 2: facile, 3:moyene, 4:difficile, 5:expert) </label> <input type="number" name = "difficulte" >
                <label>categorie(entree, plat, dessert, boisson)</label> <input type="text" name = "categorie" >

                <label>Temps Preparation(en min) </label> <input type="number" name = "temps_prepa" >
                <label>Temps repos(en min) </label> <input type="number" name = "temps_repos" >
                <label>Temps cuissance(en min) </label> <input type="number" name = "temps_cuiss" >

                <label>Saison(1:printemps, 2:ete, 3:automne, 4:hiver, 5:tout annee) </label> <input type="number" name = "saisonR" >
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
                        <label>Methode de cuissance(methode:bonne 1, sinon 0)</label> <input type="text" name = "meto_1" placeholder = "methode:bonne 1, sinon 0" > 
                        <button type="button" class = "add_meto" >Ajouter</button> 
                        <button type="button" class = "del_meto" >supprimer</button>
                        <br> <br>
                    </div>
                        
                </div>

                <input name="nb_etape" id="nb_etape" type ="hidden" value="1">
                <div id="etapes">
                    <div>
                        <label>Etape</label> <input type="text" name = "etape_1" placeholder=""> 
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
    </body>
</html>

    <?php
}




















/********************************** PAGE ACCUEIL**********************************/
    public function afficher_Accueil( $choix )
    { 
        $this->afficher_head_acceuil();

        $this->afficher_entete( $choix );

        // $this->afficher_rechercheF();

        $this->afficher_diapo();

        $this->afficher_menu();

        $this->titre("Pages des categories des recettes");

        echo '<div id="zone">';
            $this->affiche_zone( $choix  );
        echo "</div>";

        $this->afficher_pied();

    }
    /*----------------------------------------------------------------------*/
    public function afficher_head_acceuil()
    { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Cache-Control" content="no-store" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Guide de Reccette</title>
            <link rel="stylesheet" href="CSS/all.min.css">
            <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
            <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
            <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
            <script type="text/javascript" src="js/effectsJQ.js"> </script>
        </head>
        <body >
            
            <div class="GrandConteneur">
        
    <?php 
    }

    /* -------------------------------------------------------------------------- */

    public function afficher_diapo()
    { ?>
        <div class="diapo">
            <div class="sous_diapo">
            <?php
                $c = new controler();
                $diapos =  $c->get_image_diapo();

                foreach ($diapos as $img) 
                {
                    $i = $img["valeur"];
                    echo "<img src='$i' alt=''>";
                }
            ?>
            </div>
        </div>
        
    <?php 
    }

    /* --------------------------------------------------------------------------------------------------- */
    public function affiche_zone( $choix  )
    {

        $c = new controler();
        $ArrayCatego =  $c->get_categorie();
        foreach($ArrayCatego as $row)
        {   $categorie = $row['IDCatego_nom']; 
            echo '<div class="categorie" id="'.$categorie.'"> ';
                $url = "page_catego.php?catego=$categorie";
                echo "<a href='$url'>Les ".$categorie."s</a>";
                echo '<div class="sous_catego">';
                    echo "<div class='Slider_Left_recettes'>";
                        echo "<button class = 'btn_slide prev'>Precedent</button>";
                        if( $choix == 0){   $this->recettes_categorie($categorie,  $this->nb_recette_ligne, 10); }
                        else{ $this->recettes_categorie_log($categorie,  $this->nb_recette_ligne, 10);  }
                        echo "<button class = 'btn_slide next'>Suivant</button>";
                    echo '</div>'; 
                echo '</div>'; 
            echo '</div>'; 
        }
    }

    
    /* ---------------------------------------------------------------------------------------------------- */

    public function recettes_categorie(string $categorie, int $nbaffiche, int $nb_autres)
    { 
    
        $c = new controler();
        $ArrayRecette =  $c->get_recette_categorie($categorie);
        $nbRecette = 0;
        $indiquateur = 0;

        echo "<div class='groupe_recettes recettes_afficher'>";
        foreach($ArrayRecette as $row)
        {   $nbRecette++; 
            echo "<div class='recette cadre'>";
            echo "<div class='cadre_body'>";
                echo "<span class='titre_recette'>". $row['titre']. "</span>";
                $i = $row["img"];
                echo "<img src='$i' alt='' >";
                $debut_descript = substr( $row['Descript'], 0,  $this->nb_cara  );
                echo "<p class='descript_recette'>".$debut_descript. "</p>"; 
                
                $id = $row['IdR'];  
            
                echo "<a href='page_Recette.php?id=".$id."'> 
                    afficher la suite ...
                </a> ";             
            
            echo "</div>"; 
            echo "</div>"; 

            if( ($indiquateur == 0) && ($nbRecette == $nbaffiche) ) {
                echo "</div>";  //fin div a afficher

                echo "<div class='groupe_recettes recettes_autres'>";
                $indiquateur = 1;
                $nbRecette = 0; 
            }
            if( ($indiquateur == 1) && ($nbRecette == $nb_autres) ) {
                echo "</div>";  //fin div autres
                    break;
            }

        } 
        if( ( ($indiquateur == 1) && ($nbRecette != $nb_autres) ) ) 
        { echo "</div>";  
        }


    }


    public function recettes_categorie_log(string $categorie, int $nbaffiche, int $nb_autres)
    { 
    
        $c = new controler();
        $ArrayRecette =  $c->get_recette_categorie($categorie);
        $nbRecette = 0;
        $indiquateur = 0;

        

        echo "<div class='groupe_recettes recettes_afficher'>";
        foreach($ArrayRecette as $row)
        {   $nbRecette++; 
            echo "<div class='recette cadre'>";
            echo "<div class='cadre_body'>";
                echo "<span class='titre_recette'>". $row['titre']. "</span>";
                $i = $row["img"];
                echo "<img src='$i' alt='' >";
                $debut_descript = substr( $row['Descript'], 0,  $this->nb_cara  );
                echo "<p class='descript_recette'>".$debut_descript. "</p>"; 
                
                $id = $row['IdR']; 

                    if (!isset($_SESSION)) { session_start();}

                    if( isset($_POST["preferer"]) )
                    {  
                        if( isset($_POST["pref"])  )
                        { 
                            $c->prefer_user( $_SESSION["IDUser"] , $_POST["IDrecette"] );
                            unset($_POST);
                        }
                    }
                    if( isset($_POST["noter"]))
                        {
                        if( isset($_POST["IDrecette"]) && isset($_POST["note"]) && (!empty($_POST["note"])))
                        {
                            $c->note_user( $_POST["IDrecette"], $_POST["note"]  );
                            unset($_POST);
                        }
                        }
                
                ?>
            
                <form method="POST" action="">
                <?php  
                echo "<input type='hidden' name='IDrecette' value='$id'>" ; ?>
                    Note recette /10: <input type="number" name="note"  style="width:50px;" >
                    <button name="noter" value="noter" >valider</button>
                </form>
                <form method="POST" action=""> 
                    Preféré<input type="checkbox" name="pref" value="check" >
                    <?php  echo "<input type='hidden' name='IDrecette' value='$id'>" ; ?>
                    <input type="submit" name="preferer" value="valider">
                </form>
                <?php

                echo "<a href='page_Recette.php?id=".$id."'> 
                    afficher la suite ...
                </a> "; 
            
            
            
            echo "</div>"; 
            echo "</div>"; 

            if( ($indiquateur == 0) && ($nbRecette == $nbaffiche) ) {
                echo "</div>";  //fin div a afficher

                echo "<div class='groupe_recettes recettes_autres'>";
                $indiquateur = 1;
                $nbRecette = 0; 
            }
            if( ($indiquateur == 1) && ($nbRecette == $nb_autres) ) {
                echo "</div>";  //fin div autres
                    break;
            }

        } 
        if( ( ($indiquateur == 1) && ($nbRecette != $nb_autres) ) ) 
        { echo "</div>";  
        }

    }
/**************************************FIN PAGE D ACCEUIL**********************************/












/*************************PAGE UNE RECETTE**********************************/

    public function afficher_page_recette( $id , $choix)
    {
        $this->afficher_head_recette();

        $this->afficher_entete( $choix );

        $this->afficher_menu();

        $this->titre("Pages d'une recette");

        $this->affiche_recette( $id );

        $this->afficher_pied();
    }

    public function afficher_head_recette()
    { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Cache-Control" content="no-store" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Page d'une Reccette</title>
            <link rel="stylesheet" href="CSS/all.min.css">
            <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
            <link rel="stylesheet" href="CSS/page_recettes.css">

            <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
            <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
            <script type="text/javascript" src="js/effectsJQ.js"> </script>
        </head>
        <body>
            <div class="GrandConteneur">
        
    <?php 
    }

    /* ---------------------------------------Affiche une recette par ID -------------------------------------------------- */
    public function affiche_recette( $id )
    {
        $c = new controler();
        $recettes =  $c->get_recette( $id );
        
        foreach($recettes as $recette)
        {  
            $this->une_recette( $recette );
        }
    }

    /************** METHODE COMMUNE QUI AFFICHE INFORMATION COMPLET D UNE RECETTE*****/

    public function une_recette( $recette )
    {
        $c = new controler();
            echo "<div class='recetteL'>";
            echo "<span class='titre_recette'>". $recette['titre']. "</span>";
            echo "<img src=".$recette['img']." alt='' style= 'width:50%;'>";
            echo "<p class='descript_recette'>". $recette['Descript']. "</p>";         
                
                $id = $recette['IdR'];

                echo "<div class='infos_sup' style = 'width: -webkit-fill-available;'>";

                    // NB CALORIES
                    echo "<div class='calories'>Son nombre de calories totale: ".$recette['caloriesTotale']." kcal</div>";

                    // LES TEMPS
                    echo "<div class='Temp'>";
                        echo "<div class='Temp_prepa'>Temp de preparation = ".$recette['Temp_prepa']." min</div>";
                        echo "<div class='Temp_prepa'>Temp de repos =".$recette['Temp_repo']." min</div>";
                        echo "<div class='Temp_prepa'>Temp de cuissance =".$recette['Temp_cuiss']." min</div>";
                        echo "<div class='Temp_prepa'>Temp Totale =".$recette['Temp_Totale']." min</div>";
                    echo "</div>"; 
                    
                    // NOTE ET DIFF
                        echo "<div class='notation'>Sa Notation: ".$recette['notation']."</div>";
                        echo "<div class='Temp_prepa'>Sa Difficulté:".$recette['difficulte']."</div>";



                echo "<div class='etape_ing'>";
                    // LES INGREDIENTS
                    $Arraycompose =  $c->get_compose( $id );

                    echo "<ul class='ingredient'> Les Ingredients";
                        foreach($Arraycompose as $row2)
                        {   
                            echo "<li >". $row2['quantite']. " ".$row2['IDIngredient']. "</li>";
                        } 
                    echo "</ul>";
                
                    // LES ETAPES
                    $Arrayetapes =  $c->get_etapes( $id );

                    echo "<ul class='etape'> Les Etapes";
                        foreach($Arrayetapes as $row3)
                        {   
                            echo "<li >". $row3['NumEtape']. " ".$row3['descript']. "</li>";
                        } 
                    echo "</ul>";
                echo "</div>";  
            echo "</div>"; 

            echo "</div>";   // FIN RECETTE   
        
    }













/********************************************PAGE UNE NEWS***********************************/


public function afficher_page_new( $id , $choix)
{
    $this->afficher_head_new();

    $this->afficher_entete( $choix );

    $this->afficher_menu();

    $this->titre("Pages d'une News ");

    $this->affiche_new( $id );

    $this->afficher_pied();
}

public function afficher_head_new()
{ ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Cache-Control" content="no-store" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page d'une News</title>
        <link rel="stylesheet" href="CSS/all.min.css">
        <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
        <link rel="stylesheet" href="CSS/page_recettes.css">

        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
        <script type="text/javascript" src="js/effectsJQ.js"> </script>
    </head>
    <body>
        <div class="GrandConteneur">
    
<?php 
}

/* ---------------------------------------Affiche une recette par ID -------------------------------------------------- */
public function affiche_new( $id )
{
    $c = new controler();
    $news =  $c->get_new( $id );
    
    foreach($news as $new)
    {  
        $this->une_new( $new );
    }
}

/************** METHODE COMMUNE QUI AFFICHE INFORMATION COMPLET D UNE NEWS*****/

public function une_new( $new )
{   $c = new controler();
    

        echo "<div class='recetteL'>";

            echo "<span class='titre_recette'>". $new['titre']. "</span>";
            echo "<img src=".$new['imgN']." alt='' style= 'width:50%;'>";
            echo "<p class='descript_recette'>". $new['descript']. "</p>"; 

                $id = $new["IDNews"];
                $details =  $c->get_new_details( $id );

                // paragraphes d'une news
                echo "<div class='infos_sup' style = 'width: -webkit-fill-available;'>";
                foreach ($details as $detail ){
                    echo "<p >".$detail['details']."</p>";
                }
                echo "</div>"; 

        echo "</div>";   // FIN NEWS   
}
































/********************************************PAGE CATEGORIE*********************************/
public function afficher_catego( $catego , $choix){

    $this->afficher_head_page_recettes();

    $this->afficher_entete(  $choix );


    $this->afficher_menu();

    $this->titre("Pages des reccetes de categorie: $catego");

    $this->afficher_contenue_page_catego( $catego , $choix );

    $this->afficher_pied();

}

/* -------------------------------Les sous methodes------------------------------------ */
public function afficher_head_page_recettes()
{ ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Cache-Control" content="no-store" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de tous les Reccettes</title>
        <link rel="stylesheet" href="CSS/all.min.css">
        <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
        <link rel="stylesheet" href="CSS/page_recettes.css">

        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
        <script type="text/javascript" src="js/effectsJQ.js"> </script>
    </head>
    <body>
        <div class="GrandConteneur_recettes">
    
<?php 
}



public  function afficher_contenue_page_recettes()
{ /*?>*/

    echo '<div class="contenue_page_recettes">';
        echo '<div class="triyage_filtre">';
            $this->afficher_triyage_page_recettes();
            $this->afficher_filtrage_page_recettes();
        echo "</div>";

        $this->tous_recettes(  );

    echo "</div>";

}

public  function afficher_triyage_page_recettes( $catego )
{ ?>

    <div class="triyage_page_recettes">

        <span>Trie Par</span>

        <?php
            if (isset($_GET['trier'])) {       $choice_affiche = 1 ; 
                if(isset($_GET['radio']))
                { $this->trie_par = $_GET['radio'] ; 
                    
                }
                
            } 
        ?> 

        <form  method="GET" action="" >
        
            <?php 
                echo "<input type='hidden' name='catego' value='$catego'>"; 
            ?>  

            <input type="radio" name="radio" value="Temp_prepa"><label>temps de préparation</label> <br>
            <input type="radio" name="radio" value="Temp_cuiss"><label >temps de cuisson</label> <br>
            <input type="radio" name="radio" value="Temp_totale"><label >temps Totale</label> <br>

            <input type="radio" name="radio" value="notation"><label>notation</label> <br>

            <input type="radio" name="radio" value="saison"><label >saison</label> <br> 

            <input type="radio" name="radio" value="caloriesTotale"><label>nombre calories</label><br>

            <button><?php echo $this->trie_par; ?> </button>

            <button>Reset</button>

            <input type="submit" name="trier" value ="trie">

        </form>

    </div>

    <?php 
    
}


public  function afficher_filtrage_page_recettes( $catego )
{ ?>

    <div class="filtrage_page_recettes">

        <span>Filtrer Par</span>

        <?php 

        ?> 

        <form  method="GET" action="" >

        <?php echo "<input type='hidden' name='catego' value='$catego'><br>"; 
            ?> 

            <div class="critere">
                <p>temps de préparation(en minute)</p>
                Min<input type="number" name = "min_TP" placeholder="0">
                Max<input type="number" name = "max_TP" placeholder="70">
            </div>
            <div class="critere">
                <p>temps de cuisson(en minute)</p>
                Min<input type="number" name = "min_TC" placeholder="0">
                Max<input type="number" name = "max_TC" placeholder="125">
            </div>
            <div class="critere">
                <p>temps Totale(en minute)</p>
                Min<input type="number" name = "min_TT" placeholder="0">
                Max<input type="number" name = "max_TT" placeholder="125">
            </div>
            <div class="critere">
                <p>Notation(de 1 à 5)</p>
                Min<input type="number" name = "min_note" placeholder="1">
                Max<input type="number" name = "max_note" placeholder="5">
            </div>

            <div class="critere">
                <p>Saison</p>
                <?php
                $c = new controler();
                $saisons =  $c->get_saison( );
                foreach ($saisons as $saison) {
                    echo "<input type='checkbox' name='".$saison["IDSaison"]."' value='".$saison["IDSaison"]."'>".$saison["NomSaison"]."<br>";
                }
                ?>
            </div>

            <div class="critere">
                <p>Nombre de calories(En J)</p>
                Min<input type="number" name = "min_calorie" placeholder="0">
                Max<input type="number" name = "max_calorie" placeholder="1000">
            </div>

            <!-- buttons indique filtrage selectionné -->
            <button>Reset</button> 
            <input type="submit" name="filtrer" value ="filtre">

        </form>

    </div>

    <?php 
}

//--------------------------------------------------------------------------------

    public  function afficher_contenue_page_catego( $catego , $choix)
    { /*?>*/

        echo '<div class="contenue_page_catego_recettes">';

            echo '<div class="triyage_filtre">';
                $this->afficher_triyage_page_recettes( $catego );
                $this->afficher_filtrage_page_recettes( $catego  );
            echo "</div>";

            echo '<div class="recettes_catego">';
                $this->affichage_recettes_categ( $catego , $choix);
            echo "</div>";

            //$this->afficher_filtrage_page_recettes();
        echo "</div>";

    }

    public function affiche_catego_recettes( $ArrayRecette,   $nbaffiche)
    { 
    
        $nbRecette = 0;
        
        echo "<div class='ligne_recettes'>";
        foreach($ArrayRecette as $row)
        {   $nbRecette++; 
            echo "<div class='recetteFixe cadre'>";
            echo "<div class='cadre_body'>";
                echo "<span class='titre_recette'>". $row['titre']. "</span>";
                echo "<img src=".$row['img']." alt='' >";
                $debut_descript = substr( $row['Descript'], 0,  $this->nb_cara  );
                echo "<p class='descript_recette'>".$debut_descript. "</p>"; 
                $id = $row['IdR'];  
            
                echo "<a href='page_Recette.php?id=".$id."'> 
                    afficher la suite ...
                </a> ";             
            
            echo "</div>"; 
            echo "</div>"; 

            if( ($nbRecette == $nbaffiche) ) {
                echo "</div>";  //fin div a afficher

                echo "<div class='ligne_recettes'>";
                $nbRecette = 0; 
            }
            

        } 
        if(($nbRecette != $nbaffiche) ) 
        { echo "</div>";  
        }

    }


    public function affiche_catego_recettes_log( $ArrayRecette,   $nbaffiche)
    { 
    
        $nbRecette = 0;
        
        echo "<div class='ligne_recettes'>";
        foreach($ArrayRecette as $row)
        {   $nbRecette++; 
            echo "<div class='recetteFixe cadre'>";
            echo "<div class='cadre_body'>";
                echo "<span class='titre_recette'>". $row['titre']. "</span>";
                echo "<img src=".$row['img']." alt='' >";
                $debut_descript = substr( $row['Descript'], 0,  $this->nb_cara  );
                echo "<p class='descript_recette'>".$debut_descript. "</p>"; 
                $id = $row['IdR'];  
            
                if (!isset($_SESSION)) { session_start();}

                    if( isset($_POST["preferer"]) )
                    {  
                        if( isset($_POST["pref"])  )
                        { 
                            $c->prefer_user( $_SESSION["IDUser"] , $_POST["IDrecette"] );
                            unset($_POST);
                        }
                    }
                    if( isset($_POST["noter"]))
                        {
                        if( isset($_POST["IDrecette"]) && isset($_POST["note"]) && (!empty($_POST["note"])))
                        {
                            $c->note_user( $_POST["IDrecette"], $_POST["note"]  );
                            unset($_POST);
                        }
                        }
                
                ?>
            
                <form method="POST" action="">
                <?php  
                echo "<input type='hidden' name='IDrecette' value='$id'>" ; ?>
                    Note recette /10: <input type="number" name="note"  style="width:50px;" >
                    <button name="noter" value="noter" >valider</button>
                </form>
                <form method="POST" action=""> 
                    Preféré<input type="checkbox" name="pref" value="check" >
                    <?php  echo "<input type='hidden' name='IDrecette' value='$id'>" ; ?>
                    <input type="submit" name="preferer" value="valider">
                    <!-- <button name="preferer" value="preferer">valider</button> -->
                </form>
                <?php

                echo "<a href='page_Recette.php?id=".$id."'> 
                    afficher la suite ...
                </a> ";             
            
            echo "</div>"; 
            echo "</div>"; 

            if( ($nbRecette == $nbaffiche) ) {
                echo "</div>";  //fin div a afficher

                echo "<div class='ligne_recettes'>";
                $nbRecette = 0; 
            }
            

        } 
        if(($nbRecette != $nbaffiche) ) 
        { echo "</div>";  
        }

    }





    public  function affichage_recettes_categ( $catego , $choix)
{ 
    $choice_affiche = 0 ;
    if (isset($_GET['trier'])) {   $choice_affiche = 1 ;  }
    else{
        if (isset($_GET['filtrer'])) { 
            $choice_affiche = 2 ; 
            $array_index= array(); $array_value = array();
            if( isset($_GET['min_TP'])  && (!empty( $_GET["min_TP"] ) ) ){
                echo "selct min TP";
                $array_index[] = 11;
                $array_value[] = $_GET['min_TP'];
            }
            if( isset($_GET['max_TP']) && (!empty( $_GET["max_TP"] ) ) ){
                $array_index[] = 12;
                $array_value[] = $_GET['max_TP'];
            }
            if( isset($_GET['min_TC']) && (!empty( $_GET["min_TC"] ) ) ){
                $array_index[] = 21;
                $array_value[] = $_GET['min_TC'];
            }
            if( isset($_GET['max_TC']) && (!empty( $_GET["max_TC"] ) ) ){
                echo "selct max TC";
                $array_index[] = 22;
                $array_value[] = $_GET['max_TC'];
            }

            if( isset($_GET['min_TT']) && (!empty( $_GET["min_TT"] ) ) ){
                $array_index[] = 31;
                $array_value[] = $_GET['min_TT'];
            }
            if( isset($_GET['max_TT']) && (!empty( $_GET["max_TT"] ) )  ){
                $array_index[] = 32;
                $array_value[] = $_GET['max_TT'];
            }


            if( isset($_GET['min_note']) && (!empty( $_GET["min_note"] ) ) ){
                $array_index[] = 41;
                $array_value[] = $_GET['min_note'];
            }
            if( isset($_GET['max_note']) && (!empty( $_GET["max_note"] ) )  ){
                $array_index[] = 42;
                $array_value[] = $_GET['max_note'];
            }

            if( isset($_GET['min_calorie']) && (!empty( $_GET["min_calorie"] ) ) ){
                $array_index[] = 61;
                $array_value[] = $_GET['min_calorie'];
            }
            if( isset($_GET['max_calorie']) && (!empty( $_GET["max_calorie"] ) )  ){
                $array_index[] = 62;
                $array_value[] = $_GET['max_calorie'];
            }

            $array_saisons = array();

            for ($i=1; $i <= 5; $i++) { 
                if( isset($_GET["$i"]) && (!empty( $_GET["$i"] ) )  ){
                    $array_saisons[] = $_GET["$i"];
                }
            }

            if(  0 < sizeof( $array_saisons ) ){
                $array_index[] = $array_saisons ;
                $array_value[] = "5";
            }
            

        } 

        else {  $trie = "dafault" ; }
    } // fin else
    
    $trie = $this->trie_par;
    
    $c = new controler();

    //echo $choice_affiche ;

    if (  $choice_affiche == 0) {
        $recettes =  $c->get_recette_categorie($catego);
    } 
    else{
        if( $choice_affiche == 1)
        {
        if(  (strcmp($trie , "Temp_prepa" ) == 0) || (strcmp($trie , "Temp_cuiss" ) == 0)  )
        {
            $recettes =  $c->get_catego_recettes_trie_simple( $catego, $trie, 0 );
        
        }
        else{
            switch ($trie) {

                case 'notation':
                    $recettes =  $c->get_catego_recettes_trie_simple( $catego, $trie, 1 );
                    break;
                
                case 'Temp_totale':
                    $recettes =  $c->get_catego_recettes_trie_calculable( $catego, 0 );
                    break;

                case 'saison':
                    $recettes =  $c->get_recettes_catego_trie_saison( $catego );
                    break;
                
                case 'caloriesTotale':
                    $recettes =  $c->get_catego_recettes_trie_calories($catego,  0 );
                    break;
                
            }

        }

    }// fin triyage
    else{ 
        if( $choice_affiche == 2 ){
            $recettes =  $c->get_catego_recettes_filter( $catego, $array_index, $array_value );
        }
    }

    } // fin cas edfent de default 
    

    if( $choix == 0 ){ $this->affiche_catego_recettes( $recettes , 4); }
    else{ if($choix == 1 ){$this->affiche_catego_recettes_log( $recettes , 4);} }
}







/* ---------------------------------------Affiche tous les  recette -------------------------------------------------- */
    public  function tous_recettes(  )
    {
        $trie = $this->trie_par;
        //echo $trie; 
        $c = new controler();

        
        if ( strcmp($trie , "default" ) == 0) {
            $recettes =  $c->get_tous_recettes();
        } 
        else {
            if( (strcmp($trie , "categorie" ) == 0) || (strcmp($trie , "Temp_prepa" ) == 0) || (strcmp($trie , "Temp_cuiss" ) == 0)  )
            {
                $recettes =  $c->get_tous_recettes_trie_simple($trie, 0 );
            }
            else{
                switch ($trie) {

                    case 'notation':
                        $recettes =  $c->get_tous_recettes_trie_simple($trie, 1 );
                        break;
                    
                    case 'Temp_totale':
                        $recettes =  $c->get_tous_recettes_trie_calculable( 0 );
                        break;

                    case 'saison':
                        //$recettes =  $c->get_tous_recettes_trie_saison( 0 );
                        break;
                    
                    case 'caloriesTotale':
                        $recettes =  $c->get_tous_recettes_trie_calories( 0 );
                        break;
                    
                }

            }

        }
        
        
        $this->recettes( $recettes );
    }

    public function recettes( $recettes )
    {
    echo "<div class='recettes_page_recettes'>";
        $nb_recettes = 0;
        echo "<div class='groupe_recettes'>";
        foreach($recettes as $recette)
        {  
            $nb_recettes++;
        
            $this->recette( $recette );
            if($nb_recettes == $this->nb_recette_ligne ){
                echo "</div>";  echo "<div class='groupe_recettes'>"; 
                $nb_recettes = 0;
            }
        
        }
        echo "</div>";
    echo "</div>";
    }


    public function recette( $row )
    {
            echo "<div class='recetteC cadre'>";
            echo "<div class='cadre_body'>";
                echo "<span class='titre_recette'>". $row['titre']. "</span>";
                echo "<img src=".$row['img']." alt='' >";
                $debut_descript = substr( $row['Descript'], 0,  $this->nb_cara  );
                echo "<p class='descript_recette'>".$debut_descript. "</p>"; 
                $id = $row['IdR'];  
                echo "<a href='page_Recette.php?id=".$id."'> 
                    afficher la suite ...
                </a> "; 
                    
            echo "</div>"; 
            echo "</div>"; 
    
    }

    

    






















/***************************************** PAGE IDEES RECETTES ***********************************/
public function afficher_idee_recettes( $choix  )
    {
        $this->afficher_head_page_idee_recettes();

        $this->afficher_entete( $choix );

        $this->afficher_menu();

        $this->titre("Page idees des recettes");

        $this->afficher_forme();

        $this->afficher_contenue_page_idee_recettes( $choix );

        $this->afficher_pied();

    }

    public function afficher_head_page_idee_recettes()
    { 
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Cache-Control" content="no-store" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Page idee Reccettes</title>
            <link rel="stylesheet" href="CSS/all.min.css">
            <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
            <link rel="stylesheet" href="CSS/page_recettes.css">

            <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
            <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
            <script type="text/javascript" src="js/effectsJQ.js"> </script>
        </head>
        <body>
            <div class="GrandConteneur page_idee_recettes">
        
    <?php 
    }



    public function afficher_forme()
    { 
        ?>
        <!-- Partie de formule 1  -->
        <div class="Form_rech">
        <button  name="idee_recette" id="btn_rech">Rechercher Recettes par ingredients:</button>

        <form action="" id="form_nb_ingredient" method = "POST">
        <input  class="input_simple" type="number" name="nb_ingredient_idee_recette" placeholder="introduit nombre d'ingredient à indiquer">
        <button class= "btn_simple" id="btn_affiche_idee_recette" type="submit" name="afficher_form_ing">Afficher</button>
        </form>
        </div>
        
        <?php 
        /* afficahge de formulaire d'ingredient*/
        if( isset($_POST['afficher_form_ing']) )
        { $nb_ing = $_POST['nb_ingredient_idee_recette'];
            if( $nb_ing > 0 ){
                $url = $_SERVER['PHP_SELF'] ; 
                //echo $url ; 
                echo '<form method="GET" action="" id="form_ingredient">'; 
                for ($i=1; $i <= $nb_ing; $i++) 
                { 
                    echo '<label class= "label_form_ing">ingredient'.$i.'</label>'; 
                    echo '<input class= "label_input_ing" type="text" name = "ing'.$i.'">';  
                    echo '<br>';
                }
                echo '<button type="submit" name="Proposer" id="btn_rech_idee_recette">Rechercher</button> ';
                echo '</form>';
            }
            
        }

        /* Traitement d'affichage */


    }

    public function afficher_contenue_page_idee_recettes( $choix )
    {
        echo '<div class="contenue_page_catego_recettes">';

            echo '<div class="triyage_filtre">';
                $this->afficher_triyage_page_idee_recettes(  );
                $this->afficher_filtrage_page_idee_recettes(  );
            echo "</div>";

            echo '<div class="recettes_catego">';
                $this->affichage_recettes_idee_recetes( $choix  );
            echo "</div>";

            //$this->afficher_filtrage_page_recettes();
        echo "</div>";
    }




    public  function afficher_triyage_page_idee_recettes(  )
    { ?>

        <div class="triyage_page_recettes">

            <span>Trie Par</span>

            <?php
                if (isset($_GET['trier'])) {       $choice_affiche = 1 ; 
                    if(isset($_GET['radio']))
                    { $this->trie_par = $_GET['radio'] ; 
                        
                    }
                    
                } 
            ?> 

            <form  method="GET" action="" >
            
                <!-- <input type="radio" name="radio" value="categorie"><label >categorie</label> <br> -->
                
                <input type="radio" name="radio" value="categorie"><label>categorie</label> <br>

                <input type="radio" name="radio" value="Temp_prepa"><label>temps de préparation</label> <br>
                <input type="radio" name="radio" value="Temp_cuiss"><label >temps de cuisson</label> <br>
                <input type="radio" name="radio" value="Temp_totale"><label >temps Totale</label> <br>

                <input type="radio" name="radio" value="notation"><label>notation</label> <br>

                <input type="radio" name="radio" value="saison"><label >saison</label> <br> 

                <input type="radio" name="radio" value="caloriesTotale"><label>nombre calories</label><br>

                <button><?php echo $this->trie_par; ?> </button>

                <button>Reset</button>

                <input type="submit" name="trier" value ="trie">

            </form>

        </div>

        <?php 
        
    }

    public  function afficher_filtrage_page_idee_recettes(  )
    { ?>

        <div class="filtrage_page_recettes">

            <span>Filtrer Par</span>

            <?php 

            ?> 

            <form  method="GET" action="" >

                <div class="critere">
                    <p>Categorie</p>
                    <?php
                    $c = new controler();
                    $categories =  $c->get_categorie( );
                    foreach ($categories as $categorie) {
                        echo "<input type='checkbox' name='10".$categorie["IDCatego"]."' value='".$categorie["IDCatego_nom"]."'>".$categorie["IDCatego_nom"]."<br>";
                    }
                    ?>
                </div>
            
                <div class="critere">
                    <p>temps de préparation(en minute)</p>
                    Min<input type="number" name = "min_TP" placeholder="0">
                    Max<input type="number" name = "max_TP" placeholder="70">
                </div>
                <div class="critere">
                    <p>temps de cuisson(en minute)</p>
                    Min<input type="number" name = "min_TC" placeholder="0">
                    Max<input type="number" name = "max_TC" placeholder="125">
                </div>
                <div class="critere">
                    <p>temps Totale(en minute)</p>
                    Min<input type="number" name = "min_TT" placeholder="0">
                    Max<input type="number" name = "max_TT" placeholder="125">
                </div>
                <div class="critere">
                    <p>Notation(de 1 à 5)</p>
                    Min<input type="number" name = "min_note" placeholder="1">
                    Max<input type="number" name = "max_note" placeholder="5">
                </div>

                <div class="critere">
                    <p>Saison</p>
                    <?php
                    $c = new controler();
                    $saisons =  $c->get_saison( );
                    foreach ($saisons as $saison) {
                        echo "<input type='checkbox' name='20".$saison["IDSaison"]."' value='".$saison["IDSaison"]."'>".$saison["NomSaison"]."<br>";
                    }
                    ?>
                </div>

                <div class="critere">
                    <p>Nombre de calories(En J)</p>
                    Min<input type="number" name = "min_calorie" placeholder="0">
                    Max<input type="number" name = "max_calorie" placeholder="1000">
                </div>

                <!-- buttons indique filtrage selectionné -->
                <button>Reset</button> 
                <input type="submit" name="filtrer" value ="filtre">

            </form>

        </div>

        <?php 
    }




    public  function affichage_recettes_idee_recetes(  $choix )
    { 
        $choice_affiche = 0 ;
        
        if (isset($_GET['trier'])) {   $choice_affiche = 1 ;  }
        else{
            if (isset($_GET['filtrer'])) 
                    { 
                        $choice_affiche = 2 ; 
                        $array_index= array(); $array_value = array();
                        if( isset($_GET['min_TP'])  && (!empty( $_GET["min_TP"] ) ) ){
                            $array_index[] = 11;
                            $array_value[] = $_GET['min_TP'];
                        }
                        if( isset($_GET['max_TP']) && (!empty( $_GET["max_TP"] ) ) ){
                            $array_index[] = 12;
                            $array_value[] = $_GET['max_TP'];
                        }
                        if( isset($_GET['min_TC']) && (!empty( $_GET["min_TC"] ) ) ){
                            $array_index[] = 21;
                            $array_value[] = $_GET['min_TC'];
                        }
                        if( isset($_GET['max_TC']) && (!empty( $_GET["max_TC"] ) ) ){
                            //echo "selct max TC";
                            $array_index[] = 22;
                            $array_value[] = $_GET['max_TC'];
                        }
            
                        if( isset($_GET['min_TT']) && (!empty( $_GET["min_TT"] ) ) ){
                            $array_index[] = 31;
                            $array_value[] = $_GET['min_TT'];
                        }
                        if( isset($_GET['max_TT']) && (!empty( $_GET["max_TT"] ) )  ){
                            $array_index[] = 32;
                            $array_value[] = $_GET['max_TT'];
                        }
            
            
                        if( isset($_GET['min_note']) && (!empty( $_GET["min_note"] ) ) ){
                            $array_index[] = 41;
                            $array_value[] = $_GET['min_note'];
                        }
                        if( isset($_GET['max_note']) && (!empty( $_GET["max_note"] ) )  ){
                            $array_index[] = 42;
                            $array_value[] = $_GET['max_note'];
                        }
            
                        if( isset($_GET['min_calorie']) && (!empty( $_GET["min_calorie"] ) ) ){
                            $array_index[] = 61;
                            $array_value[] = $_GET['min_calorie'];
                        }
                        if( isset($_GET['max_calorie']) && (!empty( $_GET["max_calorie"] ) )  ){
                            $array_index[] = 62;
                            $array_value[] = $_GET['max_calorie'];
                        }
            
                        $array_saisons = array();
            
                        for ($i=1; $i <= 5; $i++) { 
                            if( isset($_GET["20$i"]) && (!empty( $_GET["20$i"] ) )  ){
                                $array_saisons[] = $_GET["20$i"];
                            }
                        }
                        if(  0 < sizeof( $array_saisons ) )
                        {
                            $array_index[] = $array_saisons ;
                            $array_value[] = "7";
                        }

                        $array_categories = array();
            
                        for ($i=1; $i <= 4; $i++) 
                        { 
                            if( isset($_GET["10$i"]) && (!empty( $_GET["10$i"] ) )  ){
                                $array_categories[] = $_GET["10$i"];
                            }
                        }
                        if(  0 < sizeof( $array_categories ) )
                        {
                            $array_index[] = $array_categories ;
                            $array_value[] = "5";
                        }
                    } 
    
            else {  
                
                if(isset($_GET['Proposer']))
                { $choice_affiche =3;

                    $Ingredients = array();
                    for ($j=1; $j <= sizeof( $_GET ) -1 ; $j++) 
                    { 
                        $ing = $_GET["ing$j"];
                        if(! empty($ing))
                        {
                            $Ingredients[]= $_GET["ing$j"] ; 
                        }
                    }
        
                }
        
                else{
                    $trie = "dafault" ; }
            } // fin else de teste tous les cas
        }
        $trie = $this->trie_par;
        
        $c = new controler();
    
        //echo $choice_affiche ;
    
    switch ($choice_affiche ) {
        case 0:  
            $date = date('20y-m-d');
            $recettes =  $c->get_recettes_saison_actuelle_miex_note(  );
            break;

        case 1 : 
                if( (strcmp($trie , "categorie" ) == 0) || (strcmp($trie , "Temp_prepa" ) == 0) || (strcmp($trie , "Temp_cuiss" ) == 0)  )
                    {
                        $recettes =  $c->get_recettes_trie_simple(  $trie, 0 );
                    }
                    else{
                        switch ($trie) {

                            case 'notation':
                                $recettes =  $c->get_recettes_trie_simple(  $trie, 1 );
                                break;
                            
                            case 'Temp_totale':
                                $recettes =  $c->get_recettes_trie_calculable(   0 ) ; 
                                break;

                            case 'saison':
                                $recettes =  $c->get_recettes_trie_saison( );
                                break;
                            
                            case 'caloriesTotale':
                                $recettes =  $c->get_recettes_trie_calories(  0 );
                                break;
                            
                        }

                    }
            break;

        case 2 : $recettes =  $c->get_recettes_filter(  $array_index, $array_value );
            break;

        case 3 : { 
            $para = $c->get_porcent_ing(); 
            $recettes = $c->idee_recettes( $Ingredients , $para); 
        }

            break;
    }
        
    
         // fin cas edfent de default 
        

        if( $choix == 0 ){ $this->affiche_catego_recettes( $recettes , 4); }
        else{ if($choix == 1 ){$this->affiche_catego_recettes_log( $recettes , 4);} }
}




























/*****************************************PAGE RECETTES PREFERNACES***************************/


public function afficher_recettes_pref( )
{ 

    $this->afficher_head_recettes_preferances();

    $this->afficher_entete( 1 );

    $this->titre("Page des recettes préférers");

    $this->afficher_contenue_page_recettes_pref();

    $this->afficher_pied();
}

/************************************************ debut ***********************************/
public function afficher_head_recettes_preferances()
{ ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Cache-Control" content="no-store" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page Reccetes preferances</title>
        <link rel="stylesheet" href="CSS/all.min.css">
        <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
        <link rel="stylesheet" href="CSS/page_recettes.css">

        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
        <script type="text/javascript" src="js/effectsJQ.js"> </script>
    </head>
    <body>
        <div class="GrandConteneur_recettes_pref">
    
<?php 
}

public  function afficher_contenue_page_recettes_pref()
{ /*?>*/

    echo '<div class="contenue_page_recettes_pref">';

        $c = new controler();

        if (!isset($_SESSION)) {  session_start();}

        $recettes =  $c->get_recettes_pref( $_SESSION["IDUser"] );

        $this->recettes(   $recettes  );

    echo "</div>";

}













/*********************************PAGE SAISON**************************/

public function afficher_page_saison( $choix  )
    {
        $this->afficher_head_page_saison();

        $this->afficher_entete( $choix );

        $this->afficher_menu();

        $this->titre("Page des recettes contenant des ingrédients naturellement de saison");

        $this->afficher_contenue_page_saison( $choix );

        $this->afficher_pied();

    }

    public function afficher_head_page_saison()
    { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Cache-Control" content="no-store" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Page de tous les Reccettes contient ingredinets de saison</title>
            <link rel="stylesheet" href="CSS/all.min.css">
            <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
            <link rel="stylesheet" href="CSS/page_recettes.css">

            <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
            <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
            <script type="text/javascript" src="js/effectsJQ.js"> </script>
        </head>
        <body>
            <div class="GrandConteneur_recettes">
        
    <?php 
    }


    public  function afficher_contenue_page_saison( $choix  )
    { /*?>*/

        echo '<div class="contenue_page_catego_recettes">';

            echo '<div class="triyage_filtre">';
                $this->afficher_filtrage_page_saison( );
            echo "</div>";

            echo '<div class="recettes_catego">';

                $this->affichage_recettes_saison(  $choix );
            echo "</div>";

            
        echo "</div>";

    }

    public  function afficher_filtrage_page_saison(  )
    { ?>

        <div class="filtrage_page_recettes">

            <span>Filtrer Par</span>

            <?php 
            ?> 

            <form  method="GET" action="" >

                <div class="critere">
                    <p>Saison</p>
                    <?php
                    $c = new controler();
                    $saisons =  $c->get_saison( );
                    $taille = 0;
                    foreach ($saisons as $saison) {
                        echo "<input type='checkbox' name='".$saison["NomSaison"]."' value='".$saison["IDSaison"]."'>".$saison["NomSaison"]."<br>";
                        $taille++;
                    }
                    echo "<input type='hidden' name='0' value='$taille'>";
                    ?>
                </div>

                <!-- buttons indique filtrage selectionné -->
                <button>Reset</button> 
                <input type="submit" name="filtrer_saison" value ="filtre">

            </form>

        </div>

        <?php 
    }



    public  function affichage_recettes_saison(  $choix )
    { 
        $choice_affiche = 0 ;
        
        $c = new controler();

            if (isset($_GET['filtrer_saison'])) 
                    { //echo " filter saison";

                        $array_value = array();

                        $c = new controler();
                        $saisons =  $c->get_saison( );

                        foreach ($saisons as $saison) 
                        {   $nomsaison = $saison["NomSaison"];
                            if( isset($_GET["$nomsaison"]) && (!empty( $_GET["$nomsaison"] ) )  )
                            {
                                $array_value[] = $_GET["$nomsaison"];
                            }
                        }

                        $recettes = $c->get_recettes_saison( $array_value ); 
                        
                    } 
                    // fin filtre
    
            else {  
                $recettes = $c->get_recettes_saison_actuelle( );
            } // fin else de teste tous les cas
        
        

        if( $choix == 0 ){ $this->affiche_catego_recettes( $recettes , 4); }
        else{ if($choix == 1 ){$this->affiche_catego_recettes_log( $recettes , 4);} }

}




















/*******************************PAge healty*****************************************************/

    public function afficher_page_healthy( $choix  )
    {
        $this->afficher_head_page_healthy();

        $this->afficher_entete( $choix );

        $this->afficher_menu();

        $this->titre("Page des recettes classe healthy");

        $this->afficher_contenue_page_healthy( $choix );

        $this->afficher_pied();
    }

    public function afficher_head_page_healthy()
    { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Cache-Control" content="no-store" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Page healty</title>
            <link rel="stylesheet" href="CSS/all.min.css">
            <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
            <link rel="stylesheet" href="CSS/page_recettes.css">

            <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
            <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
            <script type="text/javascript" src="js/effectsJQ.js"> </script>
        </head>
        <body>
            <div class="GrandConteneur_recettes">
        
    <?php 
    }


    
    public  function afficher_contenue_page_healthy( $choix )
    { /*?>*/

        $c = new controler();
        $recettes =  $c->get_recettes_healty( );

        if( $choix == 0 ){ $this->affiche_catego_recettes( $recettes , 4); }
        else{ if($choix == 1 ){$this->affiche_catego_recettes_log( $recettes , 4);} }


    }
    











//**********************************************Page nutrition******************** */

    public function afficher_page_nutrition(  $choix )
    {
        $this->afficher_head_page_nutri();

        $this->afficher_entete( $choix );

        $this->afficher_menu();

        $this->afficher_contenue_page_nutri();

        $this->afficher_pied();

    }

    public function afficher_head_page_nutri()
    { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Cache-Control" content="no-store" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Page nutriment</title>
            
            <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
            <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>  
            
            <link rel="stylesheet" href="CSS/all.min.css">
            <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
            <link rel="stylesheet" href="CSS/page_recettes.css">


            <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
            <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
            <script type="text/javascript" src="js/effectsJQ.js"> </script>
        </head>
        <body>
            <div class="GrandConteneur_recettes">
        
    <?php 
    }


    
    public  function afficher_contenue_page_nutri()
    { /*?>*/

        echo "<div class='contenu_page_nutri'>";
            $c = new controler();
            $ingredients =  $c->get_ingredients_And_infos( );
            $this->affiche_ing_info( $ingredients   );
        echo "</div>";

    }


    public function affiche_ing_info( $ingredients )
    { 
        echo"<div class='title_ing'>Tableaux des ingrediants et ses informations nutriments</div>
        <table id='tablesIngs'>
            <thead>
                <th>Nom d'aliment</th>
                <th>Son type</th>

                <th>class healthy</th>
                <th>Son saison naturelle</th>

                <th>calories (kcal)</th>
                <th>glucides (g)</th>
                <th>lipides (g)</th>
                <th>protein (g)</th>
                <th>vitamines (mg)</th>
            </thead> ";
        
        echo "<tbody>";
        foreach ($ingredients as $ingredient) {
            echo "<tr>";
                echo "<th>$ingredient[IDIng]</th>"; 
                echo "<td>$ingredient[type]</td>"; 

                //healthy
                if( $ingredient['healty'] == 1 ){
                    echo "<td class='H' >Healty</td>";
                }
                else{
                    echo "<td class='NH' >Not Healty</td>";
                }

                //saison
                    echo "<td>$ingredient[NomSaison]</td>"; 
                

                // infos nutriments
                if( !isset($ingredient['calories_kcal'])  ){
                    echo "<td class='pas_definie'>Pas definie</td>";
                }
                else{
                    echo "<td>$ingredient[calories_kcal]</td>"; 
                }


                if( !isset($ingredient['glucides_g'])  ){
                    echo "<td class='pas_definie'>Pas definie</td>";
                }
                else{
                    echo "<td>$ingredient[glucides_g]</td>"; 
                }
                if( !isset($ingredient['lipides_g'])  ){
                    echo "<td class='pas_definie'>Pas definie</td>";
                }
                else{
                    echo "<td>$ingredient[lipides_g]</td>"; 
                }
                if( !isset($ingredient['proteines_g'])  ){
                    echo "<td class='pas_definie'>Pas definie</td>";
                }
                else{
                    echo "<td>$ingredient[proteines_g]</td>"; 
                }


                if( !isset($ingredient['vitamines_mg'])  ){
                    echo "<td class='pas_definie'>Pas definie</td>";
                }
                else{
                    echo "<td>$ingredient[vitamines_mg]</td>"; 
                }

            echo "</tr>";
        }

        echo"</tbody>
        </table>";
        ?>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

            <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
            <script>
                $(document).ready(function(){
                    $('#tablesIngs').dataTable();
                });
            </script>
        <?php

    
    }








/**************************************** PAGE CONTACT *****************************/
public function afficher_page_contact( $choix )
    {
        $this->afficher_head_page_contact();

        $this->afficher_entete( $choix );

        $this->afficher_menu();

        $this->afficher_contenue_page_contact();

        $this->afficher_pied();

    }

    public function afficher_head_page_contact()
    { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Cache-Control" content="no-store" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Page contact</title>
            <link rel="stylesheet" href="CSS/all.min.css">
            <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
            <link rel="stylesheet" href="CSS/page_recettes.css">

            <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
            <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
            <script type="text/javascript" src="js/effectsJQ.js"> </script>
        </head>
        <body>
            <div class="GrandConteneur_recettes">
        
    <?php 
    }


    
    public  function afficher_contenue_page_contact()
    { ?>

        <div class='contenu_page_contact'>
            <div class="sous_entete">
                <div class="title">Contact</div>
                <p class="contact">Bienvunue dans notre site web qui vous propose et vous montre des recettes de cuisine Algérien de entres, plat , dessert et boisson, ainsi que les informations sur differents ingredients utlisés
                Vous pouvez nos contactez en tout momnt, et en attent vos evaluation de site et tout type de questions et remarques</p>
            </div>
            <div class="Form_mail">
                <div class="Email">
                    <div class="cercle">
                        <i class='fa-regular fa-envelope'></i>
                    </div>
                    <span>jk_essaheli@esi.dz</span> 
                </div>

                <form id='contact' action=''>

                    <input type="text" placeholder='Nom'>
                    <input type="email" placeholder='Email'>
                    <input type="text" placeholder='Message...'>

                    <div class="send">
                        <button>Envoyer</button>
                    </div>

                </form>
            </div>
            
        </div>

        <?php 
    }





/**************************************** PAGE NEWS *****************************/
public function afficher_page_news( $choix )
    {
        $this->afficher_head_page_news();

        $this->afficher_entete( $choix  );

        $this->afficher_menu();

        $this->titre("Pages des News");

        $this->afficher_contenue_page_news();

        $this->afficher_pied();

    }

    public function afficher_head_page_news()
    { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Cache-Control" content="no-store" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Page news</title>
            <link rel="stylesheet" href="CSS/all.min.css">
            <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
            <link rel="stylesheet" href="CSS/page_recettes.css">

            <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
            <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
            <script type="text/javascript" src="js/effectsJQ.js"> </script>
        </head>
        <body>
            <div class="GrandConteneur_recettes">
        
    <?php 
    }


    
    public  function afficher_contenue_page_news()
    { 
        echo "<div class='page_news'>";
                $c = new controler();
                $news =  $c->get_news( );
                $this->affiche_news( $news , 4 );

                $array_nom  = array();
                $array_nom[] = 'Rechta';
                $array_nom[] = 'Bghir Algerien';

                $recettes =  $c->get_nb_recettes( $array_nom );
                $this->affiche_catego_recettes( $recettes , 4);
        echo "</div>";
    
    }

    public  function affiche_news( $news , int $nbaffiche)
    { 
        $nbNews = 0;
        
        echo "<div class='ligne_recettes'>";
        foreach($news as $new)
        {   $nbNews++; 
            echo "<div class='recette cadre'>";
            echo "<div class='cadre_body'>";
                echo "<span class='titre_recette'>". $new['titre']. "</span>";
                echo "<img src=".$new['imgN']." alt='' >";

                $video = $new['videoN'] ; 
                // echo "<video width='320' height='240' autoplay>
                // <source src='$video' type='video/mp4'>
                // </video>";

                $debut_descript = substr( $new['descript'], 0,  $this->nb_cara  );
                echo "<p class='descript_recette'>".$debut_descript. "</p>"; 
                
                $id = $new['IDNews'];  
            
                echo "<a href='page_New.php?id=".$id."'> 
                    afficher details ...
                </a> "; 
            
            
            echo "</div>"; 
            echo "</div>"; 

            if( ($nbNews == $nbaffiche) ) {
                echo "</div>";  //fin div a afficher

                echo "<div class='ligne_recettes'>";
                $nbNews = 0; 
            }
            

        } 
        if(($nbNews != $nbaffiche) ) 
        { echo "</div>";  
        }
    }







/**************************************** PAGE FETE ********************************/

    public function afficher_page_fete($choix  )
    {
        $this->afficher_head_page_fete();

        $this->afficher_entete( $choix );

        $this->afficher_menu();

        $this->titre("Page des recettes qui sont habituellement faites pour les différentes fêtes");

        $this->afficher_contenue_page_fete( $choix);

        $this->afficher_pied();

    }

    public function afficher_head_page_fete()
    { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Cache-Control" content="no-store" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Page de tous les Reccettes et ses fetes</title>
            <link rel="stylesheet" href="CSS/all.min.css">
            <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
            <link rel="stylesheet" href="CSS/page_recettes.css">

            <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
            <script type="text/javascript" src="js/jquery-3.6.1.min.js"> </script>
            <script type="text/javascript" src="js/effectsJQ.js"> </script>
        </head>
        <body>
            <div class="GrandConteneur_recettes">
        
    <?php 
    }


    
    public  function afficher_contenue_page_fete( $choix )
    { /*?>*/

        echo '<div class="contenue_page_catego_recettes">';

            echo '<div class="triyage_filtre">';
                $this->afficher_filtrage_page_fete( );
            echo "</div>";

            echo '<div class="recettes_catego">';

            $fate_default = "Aid";
                $this->affichage_recettes_fete( $choix  );
            echo "</div>";

            
        echo "</div>";

    }

    public  function afficher_filtrage_page_fete(  )
    { ?>

        <div class="filtrage_page_recettes">

            <span>Filtrer Par</span>

            <?php 
            ?> 

            <form  method="GET" action="" >

                <div class="critere">
                    <p>Type de Fete</p>
                    <?php
                    $c = new controler();
                    $fetes =  $c->get_fete( );
                    $taille = 0;
                    foreach ($fetes as $fete) {
                        echo "<input type='checkbox' name='".$fete["IDF"]."' value='".$fete["IDF"]."'>".$fete["IDFete_nom"]."<br>";
                        $taille ++;
                    }
                    echo "<input type='hidden' name='0' value='$taille'>";

                    ?>
                </div>

                <!-- buttons indique filtrage selectionné -->
                <button>Reset</button> 
                <input type="submit" name="filtrer" value ="filtre">

            </form>

        </div>

        <?php 
    }



    public  function affichage_recettes_fete(  $choix )
    { 
        $choice_affiche = 0 ;
        
        $c = new controler();

            if (isset($_GET['filtrer'])) 
                    { //echo " filter ";
                        $choice_affiche = 1 ; 
                        
                        $array_value = array();

                        for ($i=1; $i <= $_GET["0"]; $i++) { 
                            if( isset($_GET["$i"]) && (!empty( $_GET["$i"] ) )  ){
                                $array_value[] = $_GET["$i"];
                            }
                        }

                        $recettes = $c->get_recettes_fete( $array_value ); 
                        
                    } 
                    // fin filtre
    
            else {  
                $recettes = $c->get_tous_recettes( );
            } // fin else de teste tous les cas
        
        

            if( $choix == 0 ){ $this->affiche_catego_recettes( $recettes , 4); }
            else{ if($choix == 1 ){$this->affiche_catego_recettes_log( $recettes , 4);} }
            
}




/* -------------------------TRUC SUPPLEMENTAIRES--------------------------------------------------------------------------- */

public function controlle_Recettes()
{  // va lire les crithere de trie et filtrage et va passe tableau au cettes, ou par defaut afficher selon catergorie nrml
            
    $c = new controler();
    $ArrayCategorie =  $c->get_categorie();
    $this->affiche_recettes( $ArrayCategorie );
}


/* --------------------------------------------------------------------------------------------------- */


/* --------------------------------------------Recherche et filtrage------------------------------------------------------- */

    public function afficher_rechercheF()
    { ?>
        <div class="recheFiltre">
            <form method="POST" action="" class="rech">
                <input type="text" class="reche" placeholder="recherche par titre de recette">
                <button id="bare_rech">Recherche</button>
            </form>

        </div>

        <?php 
    }




//******************************************* */ FIN DE VIEW 
}
?>
