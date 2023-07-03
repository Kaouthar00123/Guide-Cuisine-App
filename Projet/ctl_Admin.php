<?php
require_once ('model.php');
require_once ('viewAdmin.php');
require_once ('login_Admin.php');

//**********************************Controleur Admin************************** */

class controlerAdmin{


    /*------------------------------------------------From view ---------------------------------------*/
    

    public function login_admin(){
        if(isset($_POST["login"])){
            $username= strip_tags(trim($_POST['username']));
            $password= strip_tags(trim($_POST['password']));
            $model=new model();
            $res=$model->Login_Admin($username,$password);
            unset($_POST);
            if($res>0)
            {
                $_SESSION["Adminname"]=$username;
                header("Location:indexAdmin.php");
            }
            return $res;    
        }
    }

    public function LogOut(){
        if(isset($_POST['logout'])){
            if (!isset($_SESSION)) { session_start();}
            unset($_SESSION['Adminname']);
            if (isset($_SESSION)) { session_destroy(); }
            unset($_POST);
            header("Refresh:0");
        }
    }

    /**************************************************PAGE DETAILS RECETTE************************/

    public function get_ings_recette( $id )
    {
        $m = new model();
        $res = $m->get_ings_recette( $id ) ;
        return $res;
    }

    public function get_etapes_recette( $id )
    {
        $m = new model();
        $res = $m->get_etapes_recette( $id ) ;
        return $res;
    }

    public function get_methodes_recette( $id )
    {
        $m = new model();
        $res = $m->get_methodes_recette( $id ) ;
        return $res;
    }
    /*************************************************GESTION RECETTE******************************/
    public function afficher_site_Admin()
    {
        if (!isset($_SESSION)) { session_start();}
        if(isset($_SESSION['Adminname'])){
            $view=new viewAdmin();
            $view->afficher_site_Admin();
        }else{
            $view=new loginAdmin();
            $view->afficher_login_Admin();
        }
    }

    public function get_recettes()
    {
        $m = new model();
        $res = $m->get_tous_recettes();
        return $res;
    }

    public function editRecette()
    { 
        if(isset($_POST["EditRecette"] ) )
        {
            //echo "dans cas is set";
            $id=$_POST['id'];

            $t = $_POST["titre"];
            $titre = !empty( $t) ? "$t" : NULL; 

            $i = $_POST["img"];
            $img = !empty( $i) ? "$i" : NULL; 

            $d = $_POST["Descript"];
            $Descript = !empty( $d) ? "$d" : NULL; 

            $n = $_POST["notation"];
            $notation = !empty( $n ) ? "$n" : NULL; 

            $dif = $_POST["difficulte"];
            $difficulte = !empty( $dif ) ? "$dif" : NULL; 

            $cat = $_POST["categorie"];
            $categorie = !empty( $cat ) ? "$cat" : NULL; 

            $TP = $_POST["Temp_prepa"];
            $Temp_prepa = !empty( $TP ) ? "$TP" : NULL; 

            $TR = $_POST["Temp_repo"];
            $Temp_repo = !empty( $TR ) ? "$TR" : NULL; 

            $TC = $_POST["Temp_cuiss"];
            $Temp_cuiss = !empty( $TC ) ? "$TC" : NULL; 

            //optionnelle
            $v = $_POST["videoR"];
            $video = !empty( $v ) ? "$v" : NULL; 

            $s = $_POST["saisonR"];
            $saison = !empty( $s ) ? "$s" : NULL; 

            $h = $_POST["healthyR"];
            $healthy = !empty( $h ) ? "$h" : NULL; 

            $in = $_POST["ings"];
            $ings = !empty( $in ) ? "$in" : NULL; 

            $et = $_POST["etapes"];
            $etapes = !empty( $et ) ? "$et" : NULL; 

            $me = $_POST["methodes"];
            $metos = !empty( $me ) ? "$me" : NULL; 

            $model=new model();
            $model->editRecette( $id, $titre, $img , $Descript, $notation, $difficulte, $categorie, $Temp_prepa,  $Temp_repo,  $Temp_cuiss, $video, $healthy, $saison , $ings, $etapes, $metos);
            
            unset($_POST);
            header("refresh:0"); 
        }
    }


    public function deleteRecette()
    {
            if(isset($_POST['deleteRecette'])){
                $id=$_POST['id'];
                $model=new model();
                $model->deleteRecette($id);
                unset($_POST);
                header("Refresh:0");
                }
    }

    public function insertRecette(){

        if(isset($_POST["add_recette"]))
        {

            $Nom = $_POST["nom"]; 

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
            $id = 0 ; 
            $result=$model->insertRecette($id, $Nom, $image, $desciption, $Notation, $Difficulte, $categorie, $Temps_prepa, $Temps_repos, $Temps_cuiss, $saison, $healthy, $video,  $ings, $metos, $etapes );
            //unset($_POST);
            header("Refresh:0");
            return $result; 
        }
        return false;
        
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

    /*************************************************GESTION NEWS*********************************/
    public function afficher_gestion_News()
    {
        if (!isset($_SESSION)) { session_start();}
        if(isset($_SESSION['Adminname'])){
            $view=new viewAdmin();
            $view->afficher_gestion_News();
        }else{
            $view=new loginAdmin();
            $view->afficher_login_Admin();
        }
    }

    public function get_news()
    {
        $m = new model();
        $res = $m->get_news();
        return $res;
    }

    public function get_new_details( $IDNews )
    {
        $m = new model();
        $res = $m->get_new_details( $IDNews );
        return $res;
    }

    public function insertNews(){
        if(isset($_POST["add_news"])){

            
            $t = $_POST["titre"];
            $titre = !empty( $t) ? "$t" : NULL; 

            $i = $_POST["imgN"];
            $image = !empty( $i) ? "$i" : NULL; 

            $d = $_POST["descript"];
            $desciption = !empty( $d) ? "$d" : NULL; 

            $v = $_POST["videoN"];
            $video = !empty( $v) ? "$v" : NULL; 

            $p = $_POST["p"];
            $para = !empty( $p) ? "$p" : NULL; 


            $model=new model();
            $IDs=$model->insertNews( $titre, $image, $desciption, $video , $para) ;

            unset($_POST);
            header("Refresh:0");
            return $result;
        }
        return false;
        
    }

    public function editNews()
    { 
        if(isset($_POST["EditNews"] ) )
        {
            $IDNews=$_POST['IDNews'];

            $t = $_POST["titre"];
            $titre = !empty( $t) ? "$t" : NULL; 

            $i = $_POST["imgN"];
            $image = !empty( $i) ? "$i" : NULL; 

            $d = $_POST["descript"];
            $description = !empty( $d) ? "$d" : NULL; 

            $v = $_POST["videoN"];
            $video = !empty( $v) ? "$v" : NULL; 

            $p = $_POST["p"];
            $para = !empty( $p ) ? "$p" : NULL; 

            $model=new model();
            $model->editNews( $IDNews,$titre, $image , $description, $video, $para );
            
            unset($_POST);
            header("refresh:0"); 
        }
        //header("Refresh");
    }


    public function deleteNews()
    {
            if(isset($_POST['deleteNews'])){
                $IDNews=$_POST['IDNews'];
                $model=new model();
                $model->deleteNews($IDNews);
                unset($_POST);
                header("Refresh:0");
                }
    }



    /*********************************************GESTION INGREDIENTS*********************************/
    public function afficher_gestion_ings(){
        if (!isset($_SESSION)) { session_start();}
        if(isset($_SESSION['Adminname'])){ 
            $view=new viewAdmin();
            $view->afficher_Admin_ing();
        }else{
            $view=new loginAdmin();
            $view->afficher_login_Admin();
        }
    }

    public function get_ings()
    {
        $m = new model();
        $res = $m->get_ingredients_And_infos();
        return $res;
    }


    public function editIng()
    { /* EditRecette */
        if(isset($_POST['EditIng'])){
            $id=$_POST['id'];

            $Nom=$_POST['Nom'];

            $s = $_POST['saisonI'] ; 
            $saisonI = !empty( $s) ? "$s" : NULL;

            $h = $_POST['healty'] ; 
            $healty = !empty( $h) ? "$h" : NULL;

            $cl = $_POST['calories_kcal'] ; 
            $calories_kcal = !empty( $cl) ? "$cl" : NULL;

            $gl = $_POST['glucides_g'] ; 
            $glucides_g = !empty( $gl) ? "$gl" : NULL;

            $pl = $_POST['lipides_g'] ; 
            $lipides_g = !empty( $pl) ? "$pl" : NULL;

            $pol = $_POST['proteines_g'] ; 
            $proteines_g = !empty( $pol) ? "$pol" : NULL;

            $vl = $_POST['vitamines_mg'] ; 
            $vitamines_mg = !empty( $vl) ? "$vl" : NULL;

            $model=new model();
            $model->editIng(   $id , $Nom , $saisonI , $healty , $calories_kcal , $glucides_g , $lipides_g , $proteines_g , $vitamines_mg );

            unset($_POST);
            header("Refresh:0");
        }
    }


    public function deleteIng()
    {
            if(isset($_POST['deleteIng'])){
                $id=$_POST['id'];
                $model=new model();
                $model->deleteIng($id);
                unset($_POST);
                header("Refresh:0");
                }
    }

    

    public function insertIng(){

        if(isset($_POST["add_ing"])){

            $Nom=$_POST['Nom'];

            $s = $_POST['saisonI'] ; 
            $saisonI = !empty( $s) ? "$s" : NULL;

            $h = $_POST['healty'] ; 
            $healty = !empty( $h) ? "$h" : NULL;

            $cl = $_POST['calories_kcal'] ; 
            $calories_kcal = !empty( $cl) ? "$cl" : NULL;

            $gl = $_POST['glucides_g'] ; 
            $glucides_g = !empty( $gl) ? "$gl" : NULL;

            $pl = $_POST['lipides_g'] ; 
            $lipides_g = !empty( $pl) ? "$pl" : NULL;

            $pol = $_POST['proteines_g'] ; 
            $proteines_g = !empty( $pol) ? "$pol" : NULL;

            $vl = $_POST['vitamines_mg'] ; 
            $vitamines_mg = !empty( $vl) ? "$vl" : NULL;

            $model=new model();
            $result=$model->insertIng( $Nom, $saisonI, $healty, $calories_kcal, $glucides_g, $lipides_g, $proteines_g, $vitamines_mg );
            unset($_POST);
            header("Refresh:0");
            //return $result;
        }
        //return false;
        
    }

    /*********************************************** GESTION USERS *********************************/
    public function afficher_gestion_users(){
        if (!isset($_SESSION)) {  session_start();}
        if(isset($_SESSION['Adminname'])){
            $view=new viewAdmin();
            $view->afficher_gestion_users();
        }else{
            $view=new loginAdmin();
            $view->afficher_login_Admin();
        }
    }

    public function get_users()
    {
        $m = new model();
        $res = $m->get_users();
        return $res;
    }

    public function get_pref_user( $iduser ){

        $m = new model();
        $res = $m->get_recettes_pref( $iduser );
        return $res;  
    }
    public function get_ajouter_user( $iduser ){

        $m = new model();
        $res = $m->get_ajouter_user( $iduser );
        return $res;  
    }

    public function deleteUser()
    {
            if(isset($_POST['deleteUser'])){
                $id=$_POST['IDUser'];
                $model=new model();
                $model->deleteUser($id);
                unset($_POST);
                header("Refresh:0");
                }
    }
    


//----------------------------------------------------Gestion paramemtres

public function afficher_gestion_parametres()
{
    if (!isset($_SESSION)) { session_start();}
    if(isset($_SESSION['Adminname'])){
        $view=new viewAdmin();
        $view->afficher_gestion_parametres();
    }else{
        $view=new loginAdmin();
        $view->afficher_login_Admin();
    }
}

public function get_paras()
{
    $model=new model();
    $res = $model->get_paras();
    return ($res);
}

public function insertP(){

    if(isset($_POST["add_para"])){

        $n = $_POST["nom"];
        $nom = !empty( $n) ? "$n" : NULL; 

        $v = $_POST["valeur"];
        $valeur = !empty( $v) ? "$v" : NULL; 

        $model=new model();
        $IDs=$model->insertP( $nom, $valeur ) ;

        unset($_POST);
        header("Refresh:0");
        return $result;
    }
    return false;
    
}

public function editP()
{ 
    if(isset($_POST["EditP"])){

        $id = $_POST["ID"];

        $n = $_POST["nom"];
        $nom = !empty( $n) ? "$n" : NULL; 

        $v = $_POST["valeur"];
        $valeur = !empty( $v) ? "$v" : NULL; 

        $model=new model();
        $IDs=$model->editP( $id, $nom, $valeur );

        unset($_POST);
        header("Refresh:0");
        return $result;
    }
    return false;
}


public function deleteP()
{
        if(isset($_POST['deleteP'])){
            $ID=$_POST['ID'];

            $model=new model();
            $model->deleteP( $ID );
            unset($_POST);
            header("Refresh:0");
            }
}








/********************************Fin controleur**************************/


}


?>
