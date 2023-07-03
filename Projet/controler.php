<?php
require_once ('model.php');
require_once ('view.php');
require_once ('loginView.php');

//**************************************Controleeur**************************** */

class controler{

    public $v ;
    public $m ;

    /*------------------------------------------------From view ---------------------------------------*/
    function __construct() {
        $this->v = new view();
        $this->m = new model();
    }

//************************************Page gestion de profile utlisateur**************************/

/*****************************************Login et inscription *******************************************/

public function login(){
    $res = array();
        if(isset($_POST["login"])){
            $username= ($_POST['username']);
            $password= ($_POST['password']);
            $m=new model();
            $res=$m->login($username, $password);
            unset($_POST);
            $cpt = 0; 
            foreach ($res as $result ){
                $cpt ++; 
                if( $cpt > 0 ){
                    $user = $result ; 
                }
            }
            if(  $cpt > 0){
                session_start();
                $_SESSION["username"] = $username;
                $_SESSION["IDUser"] = $user["IDUser"];
                header("Location:index.php");
            }
        
        }
        return $res; 
}

public function logout(){
    if(isset($_POST['logout'])){
        unset($_SESSION['username']);
        unset($_SESSION['IDUser']);
        session_destroy();
        unset($_POST);
        header("Refresh:0");
    }
}

public function inscrer(){

    if(isset($_POST['inscrer'])){

        $nom = $_POST["nom"] ; 
        $prenom = $_POST["prenom"] ;

        $m = $_POST["mail"];
        $mail = !empty( $m ) ? "$m" : NULL; 

        $s = $_POST["sexe"];
        $sexe = !empty( $s ) ? "$s" : NULL; 

        $d = $_POST["date_naissance"];
        $date_naissance = !empty( $d ) ? "$d" : NULL; 

        $username = $_POST["username"] ; 
        $password = $_POST["password"] ; 

        $m = new model();
        $res = $m->insert_user( $nom,  $prenom, $mail , $sexe, $date_naissance, $username, $password ); 

        unset($_POST);
        header("Location: login.php");
    }

}

//------------------------------------apres inscription
    public function insertRecette()
    {

            if(isset($_POST["add_recette"]))
            {
    
                $Nom = $_POST["nom"]; 
    
                $id = $_POST["userID"]; 

                $i = $_POST["img"];
                $image = !empty( $i) ? "$i" : NULL; 
    
                $d = $_POST["desciption"];
                $desciption = !empty( $d) ? "$d" : NULL; 
    
                $n = $_POST["notation"];
                $Notation = !empty( $n ) ? "$n" : NULL; 
    
                $dif = $_POST["difficulte"];
                $Difficulte = !empty( $dif ) ? "$dif" : NULL; 
    
                $c = $_POST["categorie"];
                $categorie = !empty( $c ) ? "$c" : NULL; 
    
    
                $TP = $_POST["temps_prepa"];
                $Temps_prepa = !empty( $TP ) ? "$TP" : NULL; 
    
                $TR = $_POST["temps_repos"];
                $Temps_repos = !empty( $TR ) ? "$TR" : NULL; 
    
                $TC = $_POST["temps_cuiss"];
                $Temps_cuiss = !empty( $TC ) ? "$TC" : NULL; 
    
    
                //optionnelle
                $v = $_POST["videoR"];
                $video = !empty( $v ) ? "$v" : NULL; 
    
                $s = $_POST["saisonR"];
                $saison = !empty( $s ) ? "$s" : NULL; 
    
                $h = $_POST["healthyR"];
                $healthy = !empty( $h ) ? "$h" : NULL; 
    
    
                // les optionneles
                $nb_ing = $_POST["nb_ing"];
                $ings = array();
                if ( $nb_ing > 0 ) 
                {
                    for ($i=1; $i <= $nb_ing; $i++) { 
                        $inter = $_POST["ing_$i"];
                        $ings[] = !empty( $inter ) ? "$inter" : NULL; 
                    }
                }
    
                $nb_meto = $_POST["nb_meto"];
                $metos = array();
                if ( $nb_meto > 0 ) 
                {
                    for ($i=1; $i <= $nb_meto; $i++) { 
                        $inter = $_POST["meto_$i"];
                        $metos[] = !empty( $inter ) ? "$inter" : NULL; 
                    }
                }
    
                $nb_etape = $_POST["nb_etape"];
                $etapes = array();
                if ( $nb_etape > 0 ) 
                {
                    for ($i=1; $i <= $nb_etape; $i++) { 
                        $inter = $_POST["etape_$i"];
                        $etapes[] = !empty( $inter ) ? "$inter" : NULL; 
                    }
                }
    
    
                $model=new model();
                $result=$model->insertRecette($id,  $Nom, $image, $desciption, $Notation, $Difficulte, $categorie, $Temps_prepa, $Temps_repos, $Temps_cuiss, $saison, $healthy, $video,  $ings, $metos, $etapes );
                //unset($_POST);
                header("Location:index.php");
                return $result; 
            }
            return false;
    }

    public function affiche_login()
    {
        $v = new loginView();
        $v->affiche_login( );
    }

    public function affiche_iscription()
    {
        $v = new loginView();
        $v->affiche_iscription( );
    }

    public function note_user( $IDUser, $IDRecette )
    {
        
                $m = new model();
                $m->note_user( $_POST["IDrecette"], $_POST["note"]  );
            
    }

    public function prefer_user($iduser,  $IDRecette )
    { 
                $m = new model();
                $m->prefer_user( $iduser , $IDRecette  );
            
                header("Refresh:0");
        
    }

    public function affiche_form_Ajoute_recette()
    {
        $v = new view();
        $v->affiche_form_Ajoute_recette();
    }

    public function afficher_recettes_pref()
    {

        $v = new view();
        $v->afficher_recettes_pref( );
    }

    public function get_recettes_pref(  $IDuser )
    {
        $m = new model();
        $res = $m->get_recettes_pref(  $IDuser ); 
        return $res;
    }


    

//---------------------------------------------------Depuis tableaux parametres
    public function get_image_diapo()
    {
                $m = new model();
                $res = $m->get_image_diapo();
                return $res ; 
    }
    public function get_seuil_calories()
    {
                $m = new model();
                $valeur = $m->get_seuil_calories();
                return $valeur ; 
    }
    public function get_porcent_ing()
    {
                $m = new model();
                $res = $m->get_porcent_ing();
                
                return ($res/100) ; 
    }





//-------------------------Acceuil-------------------------------------------
    public function afficher_Acceuil()
    {
        $choix = 0;
        if (!isset($_SESSION)) {  session_start();}
        if ( isset($_SESSION['username']))
        {
            $choix = 1;
        }
        $v = new view();
        $v->afficher_Accueil($choix  );

    }
//*******************************page fete******************************** */

    public function afficher_page_fete(  )
    {
        $choix = 0;
        if (!isset($_SESSION)) {  session_start();}
        if ( isset($_SESSION['username']))
        {
            $choix = 1;
        }

        $v = new view();
        $v->afficher_page_fete( $choix );
    }

    public function filtre_fete(  )
    {
        $v = new view();
        
        if (isset($_GET['filtrer'])) 
        { 
            $array_value = array();

            for ($i=1; $i <= $_GET["0"]; $i++) { 
                if( isset($_GET["$i"]) && (!empty( $_GET["$i"] ) )  ){
                    $array_value[] = $_GET["$i"];
                }
            }

            $recettes = $this->get_recettes_fete( $array_value ); 
            $v->afficher_page_fete( $recettes );
            
        } 


    }

//*******************************************Affichege des recetes et ses details */
    public function afficher_page_recettes(  )
    {
        $v = new view();
        $v->afficher_page_recettes();

    }
    public function afficher_page_recette( $id )
    {
        $choix = 0;
        if (!isset($_SESSION)) {  session_start();}
        if ( isset($_SESSION['username']))
        {
            $choix = 1;
        }

        $v = new view();
        $v->afficher_page_recette( $id  , $choix);

    }
    public function afficher_tous_recettes()
    {
        $v = new view();
        $v->affiche_tous_recettes(  );
    }


//**********************************************page idees recettes****************************** */
    public function afficher_idee_recettes()
    {
        $choix = 0;
        if (!isset($_SESSION)) {  session_start();}
        if ( isset($_SESSION['username']))
        {
            $choix = 1;
        }

        $v = new view();
        $v->afficher_idee_recettes($choix );
    }

    public function idee_recettes( $ingredients , $para)
    {
        $m = new model();
        $size = sizeof($ingredients  );
        $chaine_ingredient='(';
        
        foreach ($ingredients as $ingredient) 
        {
            $chaine_ingredient .= "'".$ingredient."'," ; 
        }
        $chaine_ingredient = substr($chaine_ingredient, 0, -1) ;
        $chaine_ingredient.=')';

        $res = $m->idee_recettes( $chaine_ingredient , $size, $para);
        return $res;
    }

//*****************************************Page news********************************* */
    public function afficher_page_news()
    {
        $choix = 0;
        if (!isset($_SESSION)) {  session_start();}
        if ( isset($_SESSION['username']))
        {
            $choix = 1;
        }
        
        $v = new view();
        $v->afficher_page_news( $choix  );
    }

    public function afficher_page_new(  $id )
    {
        $choix = 0;
        if (!isset($_SESSION)) {  session_start();}
        if ( isset($_SESSION['username']))
        {
            $choix = 1;
        }

        $v = new view();
        $v->afficher_page_new( $id , $choix );
    }

    public function get_news(  )
    {
    
        $m = new model();
        $res = $m->get_news(  );
        return $res;
    }

    public function get_new(  $id )
    {
        $m = new model();
        $res = $m->get_new(  $id );
        return $res;
    }

    public function get_new_details(  $id )
    {
        $m = new model();
        $res = $m->get_new_details(  $id );
        return $res;
    }
    


//*****************************page categorie******************************* */

    public function afficher_catego( $catego )
    {
        $choix = 0;
        if (!isset($_SESSION)) {  session_start();}
        if ( isset($_SESSION['username']))
        {
            $choix = 1;
        }

        $v = new view();
        $v->afficher_catego( $catego, $choix );
    }

//**********************************Page saison*************************** */
    public function afficher_page_saison(  )
    {
        $choix = 0;
        if (!isset($_SESSION)) {  session_start();}
        if ( isset($_SESSION['username']))
        {
            $choix = 1;
        }

        $v = new view();
        $v->afficher_page_saison( $choix );
    }

//*******************************Page healthy**************************** */
    public function afficher_page_healthy(  )
    {
        $choix = 0;
        if (!isset($_SESSION)) {  session_start();}
        if ( isset($_SESSION['username']))
        {
            $choix = 1;
        } 
        
        $v = new view();
        $v->afficher_page_healthy( $choix  );
    }

    public function get_recettes_healty( )
    {
        $Seuil = $this->get_seuil_calories();

        $m = new model();
        $res = $m->get_recettes_healty( $Seuil );
        return $res;
    } 

    public function get_recettes_saison_actuelle_miex_note(  ) 
    /* 
    DATE ACTUELLE , faut la recupere */
    {
        $m = new model();
        $date=date('20y-m-d');
        $res = $m->get_recettes_saison_actuelle_miex_note( $date ); 
        return $res;
    } 

//*****************************Page nutrition************************* */
    public function afficher_page_nutrition(  )
    {
        $choix = 0;
        if (!isset($_SESSION)) {  session_start();}
        if ( isset($_SESSION['username']))
        {
            $choix = 1;
        }

        $v = new view();
        $v->afficher_page_nutrition( $choix );
    }

    public function get_ingredients_And_infos( )
    {
        $m = new model();
        $res = $m->get_ingredients_And_infos( );
        return $res;
    }


//***************************************Page contact************************** */
    public function afficher_page_contact(  )
    {
        $choix = 0;
        if (!isset($_SESSION)) {  session_start();}
        if ( isset($_SESSION['username']))
        {
            $choix = 1;
        }

        $v = new view();
        $v->afficher_page_contact( $choix  );
    }




/*------------------------------------------------From Modele database ---------------------------------------*/
    public function get_recette_categorie( $categorie )
    {
        $m = new model();
        $res = $m->get_recette_categorie( $categorie );
        return $res;
    }

    public function get_saison(  )
    {
        $m = new model();
        $res = $m->get_saison();
        return $res;
    }

    public function get_fete(  )
    {
        $m = new model();
        $res = $m->get_fete();
        return $res;
    }
    /*------------------------------------------------From Modele database ---------------------------------------*/
    public function get_recette( $IDRecette )
    {
        $m = new model();
        $res = $m->get_recette(  $IDRecette ) ;
        return $res;
    }


    public function get_nb_recettes( $array_nom )
    {
        $m = new model();
        $res = $m->get_nb_recettes( $array_nom ) ;
        return $res;
    }



    public function get_tous_recettes(  )
    {
    
        $m = new model();
        $res = $m->get_tous_recettes(   );
        return $res;
    }

    public function affecte_recette( $IDRecette )
    {
        $v = new view();
        $v->IDRecette = $IDRecette ; 
        header("Location: page_Recette.php");
    }

    public function get_compose( $id )
    {
        $m = new model();
        $res = $m->get_compose( $id );
        return $res;
    }

    public function get_etapes( $id )
    {
        $m = new model();
        $res = $m->get_etapes( $id );
        return $res;
    }

    public function get_categorie( )
    {
        $m = new model();
        $res = $m->get_categorie(  );
        return $res;
    } 
    


/*------------------------------------------------Concerne trie et filtrage ---------------------------------------*/
    
    public function get_recettes_fete( $array_fete )
    {
        $m = new model();
        $res = $m->get_recettes_fete( $array_fete ); 
        return $res;
    }

    public function get_recettes_saison( $array_fete )
    {
        $m = new model();
        $res = $m->get_recettes_saison( $array_fete ); 
        return $res;
    }


    public function get_recettes_catego_trie_saison( $catego ) 
    {
        $m = new model();
        $res = $m->get_catego_recettes_trie_saison( $catego ); 
        
        return $res;
    } 

    public function get_recettes_trie_saison( ) 
    {
        $m = new model();
        $res = $m->get_recettes_trie_saison( ); 
        return $res;
    } 

    

    public function get_recettes_saison_actuelle( ) 
    /* DATE ACTUELLE , faut la recupere */
    {
        $m = new model();
        $date = date('20y-m-d');
        $res = $m->get_recettes_saison_actuelle( $date ); 
        return $res;
    }



    public function get_tous_recettes_trie_calculable(   $ordre )
    {
        $m = new model();
        $res = $m->get_tous_recettes_trie_calculable(  $ordre ); 
        return $res;
    }

    public function get_tous_recettes_trie_calories(   $ordre )
    {
        $m = new model();
        $res = $m->get_tous_recettes_trie_calculable(  $ordre ); 
        return $res;
    }
    
    public function get_catego_recettes_filter( $catego, $array_index, $array_value  )
    {
        $m = new model();
        $res = $m->get_catego_recettes_filter(  $catego, $array_index, $array_value ); 
        return $res;
    }

    public function get_recettes_filter(  $array_index, $array_value  )
    {
        $m = new model();
        $res = $m->get_recettes_filter(   $array_index, $array_value ); 
        return $res;
    }

    /*------------------------------------------------TRIE PAGE CATEGORIE From Modele database ---------------------------------------*/
    public function get_catego_recettes_trie_simple( $catego, $critere,  $ordre )
    {
        $m = new model();
        $res = $m->get_catego_recettes_trie_simple( $catego, $critere,  $ordre ); 
        return $res;
    }

    public function get_recettes_trie_simple( $critere,  $ordre )
    {
        $m = new model();
        $res = $m->get_recettes_trie_simple( $critere,  $ordre ); 
        return $res;
    }


    public function get_catego_recettes_trie_calculable(   $catego, $ordre )
    {
        $m = new model();
        $res = $m->get_catego_recettes_trie_calculable(  $catego, $ordre ); 
        return $res;
    }
    public function get_recettes_trie_calculable(   $ordre )
    {
        $m = new model();
        $res = $m->get_recettes_trie_calculable(   $ordre ); 
        return $res;
    }


    public function get_catego_recettes_trie_calories(   $catego, $ordre )
    {
        $m = new model();
        $res = $m->get_catego_recettes_trie_calories(  $catego, $ordre ); 
        return $res;
    }
    public function get_recettes_trie_calories( $ordre )
    {
        $m = new model();
        $res = $m->get_recettes_trie_calories( $ordre ); 
        return $res;
    }






/*------------------------------------------------From controleur ---------------------------------------*/

}


?>
