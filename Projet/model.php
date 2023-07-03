<?php

class model{

    private $host = "127.0.0.1";
    private $userName = "root";
    private $password = "";
    private $DbName = "guide_cook";


    //*****************************************************/ les methodes de connection

        private function connexion( $dbname, $host, $username, $password )
        {
            $dns = "mysql:host=$host; dbname=$dbname"; 
    
            try{
                $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');

                $con = new PDO($dns,   $username,    $password, $options);
                $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
            } 
            catch( PDOException $e )
            {
                echo "Err de connction à la base donnés,  de type".$e->getMessage(); 
                exit(); 
            }
            return $con; 
    
        }
    
        private function deconnexion( &$con ){
            $con = null ; 
        }
        
        private function requete( &$con, $query )
        {
            return $con->query($query) ; 
        }
    
    
/******************************** Login  admin*****************************************/
        public function Login_Admin($username,$password){
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $query="SELECT * FROM admin_site WHERE username=? AND pwd=?";
            $result=$con->prepare($query);
            $result->execute(array($username,$password));
            $count=$result->fetch(PDO::FETCH_OBJ);
            $this->deconnexion($con);
            return $count;
        }

/**************************************** Structure selon table ***********************************/


/***************************************Table categorie***********************************/

        public function get_categorie()
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM categorie";
            $result = $this->requete($con, $qr);

            $this->deconnexion($con);
            return $result; 
    
        } 

/***************************************Table utlisateur***********************************/

        public function get_users()
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM utilisateur";
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
    
        } 
/************************************Table Saison ****************************************/
        public function get_saison()
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM saison";
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);

            return $result; 
        }

/************************************Table fete ****************************************/

        public function get_fete()
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM fete ORDER BY IDF ASC";
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }

//------- methode retourne tous les recettes d'une faite dans les fetes de tableaux des fetes array_fete
        public function get_recettes_fete( $array_fete )
        {  $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );

            $cond = "";
            if(   0 < sizeof( $array_fete ) ) 
                {  
                            for ($i=0; $i < sizeof($array_fete); $i++) { 
                                if( $i != 0 ){ $cond .= " or ";}
                                $cond .="IDFete = '$array_fete[$i]'";
                                } 
                }
            
            $qr = "  SELECT * 
                    FROM `recette` 
                    WHERE IdR in( SELECT IDRecette FROM recette_fete 
                        WHERE $cond )";

            //echo $qr; 
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);

            return $result; 
        } 

/************************************Table News*******************************************/
        public function get_news()
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM news ";
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }

        public function get_new( $id )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM news WHERE IDNews = $id ";
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }

        public function get_new_details( $id )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM  `news_details` WHERE  IDNewsG = $id ";
            //echo $qr; 
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }
        
        
/******************************************Table recette*********************************/

//---------------------retourne details d'une recete de ID 
public function get_recette( $IDRecette)
{
    $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
    $qr = "SELECT *, (Temp_prepa + Temp_repo + Temp_cuiss) as Temp_Totale
                FROM  `recette` LEFT JOIN
                    (SELECT IDRecette , quantite, calories_kcal, IDIng ,( SUM(quantite *calories_kcal) ) as caloriesTotale
                    FROM `compose` INNER JOIN ingredient
                    ON compose.IDIngredient = `ingredient`.IDIng
                    GROUP BY IDRecette
                ) as `compo`  ON IDRecette = IdR
                WHERE idR = $IDRecette ";
    $result = $this->requete($con, $qr);
    $this->deconnexion($con);
    return $result; 
}
//-----------------retourne des recettes ayant les noms dans tableau des noms array_nom     
    public function get_nb_recettes( $array_nom )
        {
            $cond = "";
            if(   0 < sizeof( $array_nom ) ) 
                {  
                            for ($i=0; $i < sizeof($array_nom); $i++) { 
                                if( $i != 0 ){ $cond .= " or ";}
                                $cond .="titre = '$array_nom[$i]'";
                                } 
                }

            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM recette 
                    WHERE $cond";
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }


//--------------- retourne les recetes ayant saison array_saison
        public function get_recettes_saison( $array_saison )
        {  $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );

            $cond = "";
            if(   0 < sizeof( $array_saison ) ) 
                {  
                            for ($i=0; $i < sizeof($array_saison); $i++) { 
                                if( $i != 0 ){ $cond .= " or ";}
                                $cond .="saison_natur = $array_saison[$i] ";
                                } 
                }
            
            $qr = "SELECT IdR, titre, img, Descript FROM recette 
                    WHERE IdR in 
                        ( SELECT IDRecette FROM 
                            (SELECT * FROM compose JOIN ( SELECT * FROM ingredient
                            WHERE $cond )  
                            as ing_s on compose.IDIngredient = ing_s.IDIng) 
                        as compose_s)";
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);

            return $result; 
        } 

//-----------------------retourne recetes de saison actuelle
        public function get_recettes_saison_actuelle( $saisonA )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT IdR, titre, img, Descript FROM recette 
            WHERE IdR in 
                ( SELECT IDRecette FROM 
                    (SELECT * FROM compose JOIN ( SELECT * FROM ingredient 
                    JOIN saison on ingredient.saison_natur = saison.IDSaison 
                    WHERE saison.date_debut <= '$saisonA' and saison.date_fin >= '$saisonA') 
                    as `ing_s` on compose.IDIngredient = `ing_s`.IDIng) as `compose_s`)";

            //echo $qr; 

            $result = $this->requete($con, $qr);
            $this->deconnexion($con);

            return $result; 
        }

//----------trie les recctes ayant categorie mentioné selon saison
        public function get_catego_recettes_trie_saison( $catego  )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = $qr = $this->requete_recettes_saison();
            $qr.="HAVING categorie = '$catego' ORDER BY saisonR ASC";

            //echo $qr; 
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);

            return $result; 
        }

//--------------retourne recetes trie selon saison
        public function get_recettes_trie_saison(  )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = $qr = $this->requete_recettes_saison();
            $qr.=" ORDER BY saisonR ASC";

            //echo $qr; 
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);

            return $result; 
        }


// retourne recetes les meiux noté et de la saison en cours
        public function get_recettes_saison_actuelle_miex_note( $saisonA )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = $this->requete_recettes_saison();
            $qr.="HAVING  '$saisonA' >= date_debut and '$saisonA' <= date_fin  and notation >= 
                        ( SELECT AVG(notation) as note FROM recette ) 
                        ORDER BY notation ASC";

            //echo $qr; 
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);

            return $result; 
        }
        
        private function requete_recettes_saison()
        {
            $req="SELECT * 
                    FROM recette left JOIN saison on recette.saisonR = saison.IDSaison ";
            return $req;
        }

//-----------------------------retourne reccetes ayant categorie mentione  
        public function get_recette_categorie( $categorie )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM recette Where categorie ='".$categorie."'";
            
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
    
        } 
//--------------------------retourne recettes healty: ayant des methodes de cuissances tous bons, et tous ses ingredinets sont healty et somme de calories inferuir au seuil 
        public function get_recettes_healty(  $Seuil )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM recette 
                        WHERE IdR in (
                        SELECT IDRecette FROM
                        (SELECT IDRecette , quantite, calories_kcal, IDIng ,( SUM(quantite *calories_kcal) ) as caloriesTotale
                                                        FROM `compose` INNER JOIN ingredient
                                                        ON compose.IDIngredient = ingredient.IDIng
                                                        
                                                        WHERE IDRecette NOT in (
                                                        SELECT IDRecette FROM compose JOIN ingredient 
                                                        ON compose.IDIngredient = ingredient.IDIng
                                                        WHERE ingredient.healty = 0
                                                        ) 
                                                        and IDRecette NOT in
                                                        (SELECT IDRecette FROM recette_cuisine WHERE bonne = 0)  
                                                        
                                                        GROUP BY IDRecette
                                                        HAVING caloriesTotale <= $Seuil ) as res
                            )
                        UNION 
                        SELECT * FROM recette Where healthyR = 1 ";
            
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
    
        } 
        /************************************POUR TRIYAGE ET FILTRAGE************************/
        public function get_recettes_trie_simple(  $critere, $ordre )
        { 

            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            if( $ordre == 0  ){
                $qr = "SELECT *  FROM recette  ORDER BY ".$critere." ASC";
            }
            else{
                $qr = "SELECT * FROM recette ORDER BY ".$critere." DESC";
            }

            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }

        public function get_tous_recettes_trie_calculable(  $ordre ){ 

            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
        
            
            if( $ordre == 0  ){
                $qr = "SELECT *,(Temp_prepa + Temp_repo + Temp_cuiss) as Temp_totale
                FROM recette 
                ORDER BY  Temp_totale ASC";
            }
            else{
                $qr = "SELECT *,(Temp_prepa + Temp_repo + Temp_cuiss) as Temp_totale
                FROM recette 
                ORDER BY  Temp_totale DESC";
            }

            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }

        public function get_tous_recettes_trie_calories(  $ordre ){ 

            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );

            if( $ordre == 0  ){
                $qr = "SELECT *
                            FROM  `recette` LEFT JOIN
                                (SELECT IDRecette , quantite, calories_kcal, IDIng ,( SUM(quantite *calories_kcal) ) as caloriesTotale
                                FROM `compose` INNER JOIN ingredient
                                ON compose.IDIngredient = `ingredient`.IDIng
                                GROUP BY IDRecette
                            ) as `compo`  ON IDRecette = IdR
                ORDER BY  caloriesTotale ASC";
            }
            else{
                $qr = "SELECT *
                            FROM  `recette` LEFT JOIN
                                (SELECT IDRecette , quantite, calories_kcal, IDIng ,( SUM(quantite *calories_kcal) ) as caloriesTotale
                                FROM `compose` INNER JOIN ingredient
                                ON compose.IDIngredient = `ingredient`.IDIng
                                GROUP BY IDRecette
                            ) as `compo`  ON IDRecette = IdR

                ORDER BY  caloriesTotale DESC";
            }

            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }

        /************************************POUR TRIYAGE CATEGO ET FILTRAGE************************/
        public function get_catego_recettes_trie_simple( $catego,  $critere, $ordre )
        { 

            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            if( $ordre == 0  ){
                $qr = "SELECT *  FROM recette  WHERE categorie = '$catego'
                        ORDER BY ".$critere." ASC";
            }
            else{
                $qr = "SELECT * FROM recette WHERE categorie = '$catego' 
                        ORDER BY ".$critere." DESC";
            }

            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }

        public function get_catego_recettes_trie_calculable($catego,   $ordre ){ 

            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );

            if( $ordre == 0  ){
                $qr = "SELECT *,(Temp_prepa + Temp_repo + Temp_cuiss) as Temp_totale
                FROM recette 
                WHERE categorie = '$catego'
                ORDER BY  Temp_totale ASC";
            }
            else{
                $qr = "SELECT *,(Temp_prepa + Temp_repo + Temp_cuiss) as Temp_totale
                FROM recette 
                WHERE categorie = '$catego'
                ORDER BY  Temp_totale DESC";
            }

            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }

        public function get_recettes_trie_calculable(   $ordre ){ 

            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );

            if( $ordre == 0  ){
                $qr = "SELECT *,(Temp_prepa + Temp_repo + Temp_cuiss) as Temp_totale
                FROM recette 
            
                ORDER BY  Temp_totale ASC";
            }
            else{
                $qr = "SELECT *,(Temp_prepa + Temp_repo + Temp_cuiss) as Temp_totale
                FROM recette 
            
                ORDER BY  Temp_totale DESC";
            }

            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }


        public function get_catego_recettes_trie_calories(  $catego,  $ordre ){ 

            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );

            if( $ordre == 0  ){
                $qr = "SELECT *
                            FROM  `recette` JOIN
                                (SELECT IDRecette , quantite, calories_kcal, IDIng ,( SUM(quantite *calories_kcal) ) as caloriesTotale
                                FROM `compose` INNER JOIN ingredient
                                ON compose.IDIngredient = `ingredient`.IDIng
                                GROUP BY IDRecette
                            ) as `compo`  ON IDRecette = IdR
                        WHERE categorie = '$catego'
                ORDER BY  caloriesTotale ASC";
            }
            else{
                $qr = "SELECT *
                        FROM  `recette`  JOIN
                            (SELECT IDRecette , quantite, calories_kcal, IDIng ,( SUM(quantite *calories_kcal) ) as caloriesTotale
                            FROM `compose` INNER JOIN ingredient
                            ON compose.IDIngredient = `ingredient`.IDIng
                            GROUP BY IDRecette
                        ) as `compo`  ON IDRecette = IdR
                        WHERE categorie = '$catego'
                ORDER BY  caloriesTotale DESC";
            }

            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }

        public function get_recettes_trie_calories(   $ordre ){ 

            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );

            if( $ordre == 0  ){
                $qr = "SELECT *
                            FROM  `recette` LEFT JOIN
                                (SELECT IDRecette , quantite, calories_kcal, IDIng ,( SUM(quantite *calories_kcal) ) as caloriesTotale
                                FROM `compose` INNER JOIN ingredient
                                ON compose.IDIngredient = `ingredient`.IDIng
                                GROUP BY IDRecette
                            ) as `compo`  ON IDRecette = IdR
                
                ORDER BY  caloriesTotale ASC";
            }
            else{
                $qr = "SELECT *
                        FROM  `recette` LEFT JOIN
                            (SELECT IDRecette , quantite, calories_kcal, IDIng ,( SUM(quantite *calories_kcal) ) as caloriesTotale
                            FROM `compose` INNER JOIN ingredient
                            ON compose.IDIngredient = `ingredient`.IDIng
                            GROUP BY IDRecette
                        ) as `compo`  ON IDRecette = IdR
                        
                ORDER BY  caloriesTotale DESC";
            }

            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }
/*******************************************FILTRAGE******************************/
        public function get_catego_recettes_filter( $catego, $array_index, $array_value  )
        { 

            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $cond ='';
            for ($i=0; $i < sizeof($array_index) ; $i++) { 
    
                if(gettype($array_index[$i] ) != "array"  ){
                    switch( $array_index[$i] )
                    {
                        case 11: $cond .= " and Temp_prepa >= $array_value[$i]";  break;
                        case 12: $cond .= " and Temp_prepa <= $array_value[$i]";  break;

                        case 21: $cond .= " and Temp_cuiss >= $array_value[$i]";  break;
                        case 22: $cond .= " and Temp_cuiss <= $array_value[$i]";  break;

                        case 31: $cond .= " and Temp_Totale >= $array_value[$i]";  break;
                        case 32: $cond .= " and Temp_Totale <= $array_value[$i]";  break;

                        case 41: $cond .= " and notation >= $array_value[$i]";  break;
                        case 42: $cond .= " and notation <= $array_value[$i]";  break;

                        case 61: $cond .= " and caloriesTotale >= $array_value[$i]";  break;
                        case 62: $cond .= " and caloriesTotale <= $array_value[$i]";  break;

                    }
                }
                else{
                        if( (gettype($array_index[$i] ) == "array" ) && ( 0 < sizeof( $array_index[$i] ) ) ) 
                        {  $cond .= " and ";
                            $tab_saison = $array_index[$i];
                            for ($i=0; $i < sizeof($tab_saison); $i++) { 
                                if( $i != 0 ){ $cond .= " or ";}
                                switch( $tab_saison[$i] )
                                {
                                    case '1': $cond .= " saisonR = $tab_saison[$i]";  break;
                                    case '2': $cond .= " saisonR = $tab_saison[$i]";  break;
                                    case '3': $cond .= " saisonR = $tab_saison[$i]";  break;
                                    case '4': $cond .= " saisonR = $tab_saison[$i]";  break;
                                    case '5': $cond .= " saisonR = $tab_saison[$i]";  break;
                                } 
                            }
                        }
                    }
            }
            
                $qr = "SELECT *, (Temp_prepa + Temp_repo + Temp_cuiss) as Temp_Totale
                            FROM  `recette` LEFT JOIN
                                (SELECT IDRecette , quantite, calories_kcal, IDIng ,( SUM(quantite *calories_kcal) ) as caloriesTotale
                                FROM `compose` INNER JOIN ingredient
                                ON compose.IDIngredient = `ingredient`.IDIng
                                GROUP BY IDRecette
                            ) as `compo`  ON IDRecette = IdR

                        GROUP BY IdR
                        HAVING categorie = '$catego' $cond";

            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }


/*******************************************FILTRAGE 2******************************/
public function get_recettes_filter(  $array_index, $array_value  )
{ 

    $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
    $cond ='';
    for ($i=0; $i < sizeof($array_index) ; $i++) { 

        if(gettype($array_index[$i] ) != "array"  ){
            if( $i != 0 ){ $cond .= " and ";}
            switch( $array_index[$i] )
            {
                case 11: $cond .= "  Temp_prepa >= $array_value[$i]";  break;
                case 12: $cond .= "  Temp_prepa <= $array_value[$i]";  break;

                case 21: $cond .= "  Temp_cuiss >= $array_value[$i]";  break;
                case 22: $cond .= "  Temp_cuiss <= $array_value[$i]";  break;

                case 31: $cond .= "  Temp_Totale >= $array_value[$i]";  break;
                case 32: $cond .= "  Temp_Totale <= $array_value[$i]";  break;

                case 41: $cond .= "  notation >= $array_value[$i]";  break;
                case 42: $cond .= "  notation <= $array_value[$i]";  break;

                case 61: $cond .= "  caloriesTotale >= $array_value[$i]";  break;
                case 62: $cond .= "  caloriesTotale <= $array_value[$i]";  break;

            }
        }
        else{
                if( (gettype($array_index[$i] ) == "array" ) && ( 0 < sizeof( $array_index[$i] ) ) ) 
                {  
                    if( strcmp($array_value[$i], "7") == 0)
                        {
                            if( $i != 0 ){ $cond .= " and ";}
                            $tab_saison = $array_index[$i];
                            for ($j=0; $j < sizeof($tab_saison); $j++) { 
                                if( $j != 0 ){ $cond .= " or ";}
                                $cond .= " saisonR = $tab_saison[$j]";  
                                    
                            } 
                            
                        }
                    elseif ( strcmp($array_value[$i], "5") == 0 ){
                            if( $i != 0 ){ $cond .= " and ";}
                            $tab_catego = $array_index[$i];
                            for ($j=0; $j < sizeof($tab_catego); $j++) { 
                                if( $j != 0 ){ $cond .= " or ";}
                                $cond .= " categorie = '$tab_catego[$j]' ";  
                            }
                    }
                }
            }
    }
    
        $qr = "SELECT *, (Temp_prepa + Temp_repo + Temp_cuiss) as Temp_Totale
                    FROM  `recette` LEFT JOIN
                        (SELECT IDRecette , quantite, calories_kcal, IDIng ,( SUM(quantite *calories_kcal) ) as caloriesTotale
                        FROM `compose` INNER JOIN ingredient
                        ON compose.IDIngredient = `ingredient`.IDIng
                        GROUP BY IDRecette
                    ) as `compo`  ON IDRecette = IdR

                GROUP BY IdR
                HAVING $cond";

    $result = $this->requete($con, $qr);
    $this->deconnexion($con);
    return $result; 
}

public function get_rec_ing( $ingredient)
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
        
            $qr = "SELECT * FROM compose where IDIngredient = '$ingredient' ";

            $result = $this->requete($con, $qr);
        
            $this->deconnexion($con);
            return $result; 
    
        } 
        public function idee_recettes( $ingredients , $size ,$para)
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
        
            $qr = "SELECT *, COUNT(IDIngredient) as totale
                    FROM  `recette` INNER JOIN
                        (SELECT* 
                        FROM `compose` WHERE IDIngredient IN ".$ingredients." 
                        )
                        as `composeT`
                        ON  `recette`.`IdR` = `composeT`.IDRecette 
                    GROUP BY IdR
                    HAVING totale >=".($para*  $size );

            $result = $this->requete($con, $qr);
        
            $this->deconnexion($con);

            return $result; 
        }






//*******************************************Table Ingredient ********************************/
        public function get_ingredients_And_infos( )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM `ingredient` LEFT JOIN saison on ingredient.saison_natur = saison.IDSaison";
            $result = $this->requete($con, $qr);

            $this->deconnexion($con);
            return $result; 
        } 

        //---------------------------------------------------- get ingredient 
        public function get_ing( )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );

            $qr = "SELECT IDIng FROM ingredient";
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 

        } 



//---------------------------------------------------- Table compose 
        public function get_compose( $id )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            // $qr = "SELECT titre, img, descript FROM recette";
            $qr = "SELECT * FROM compose where IDRecette = ?";
            $result = $con->prepare($qr);
            $result->execute( array($id));

            $this->deconnexion($con);
            return $result; 
    
        } 

//---------------------------------------------------- Table etapes 
        public function get_etapes( $id )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM etape_realis where IDRecette = ?";
            $result = $con->prepare($qr);
            $result->execute( array($id));

            $this->deconnexion($con);
            return $result; 
    
        } 


        
/**************************************Table utlisateur ********************************/

//-------------- verfie log in pour utlisateur simple
        public function login($username, $password){

            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM utilisateur WHERE username = ? AND pwd = ?";
            $result =$con->prepare($qr);
            $result->execute(array($username,$password));
            $this->deconnexion($con);
            return (  $result ); 
        }

        public function insert_user( $nom,  $prenom, $mail , $sexe, $date_naissance, $username, $password )
        {

            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "INSERT INTO utilisateur (nom, prenom, mail, sexe, date_naissance, username, pwd ) VALUES(?,?, ?,?, ?, ?,?)";
            $result =$con->prepare($qr);
            $result->execute(array($nom,  $prenom, $mail , $sexe, $date_naissance, $username, $password ));
            $this->deconnexion($con);
            return (  $result ); 
        }


        

        public function get_recettes_pref( $IDuser )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * 
                    FROM  `recette` INNER JOIN
                    (SELECT * FROM `user_prefer_recette` WHERE IDUser =$IDuser ) as `res`
                    on `recette`.`IdR` = `res`.IDRecette" ;

            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        } 

        public function get_ajouter_user( $IDuser )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM  `recette` where ajouter_par = $IDuser";

            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        } 
        






/**************************************FOR ADMIN**********************************/

        /********************************RECETTES*********************/

        public function get_ings_recette( $id )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM compose where IDRecette = $id";
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }

        public function get_etapes_recette( $id )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM etape_realis WHERE IDRecette = $id ";
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }

        public function get_methodes_recette( $id )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM recette_cuisine WHERE IDRecette  = $id";
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
        }



        public function get_tous_recettes( )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            
            
            $qr = "SELECT * FROM recette";
            

            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
    
        } 

        public function insertRecette($id,  $Nom, $image, $desciption, $Notation, $Difficulte, $categorie, $Temps_prepa, $Temps_repos, $Temps_cuiss , $saison, $healthy, $video,  $ings, $metos, $etapes )
        { 
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "INSERT INTO recette (titre, img, Descript, notation, difficulte, categorie, Temp_prepa, Temp_repo, Temp_cuiss,    videoR, saisonR, healthyR , ajouter_par) VALUES(?,?,?, ?,?,?  ,?,?,?  , ?, ?, ? ,  ?)";
            $result =$con->prepare($qr);
            $result->execute(array( $Nom, $image, $desciption, $Notation, $Difficulte, $categorie, $Temps_prepa, $Temps_repos, $Temps_cuiss , $video, $saison, $healthy, $id));
            
            $qr2 = "SELECT max(IdR) as max FROM recette";
            $result2 = $this->requete($con, $qr2);
            foreach ($result2 as $res) {
            }
            
            $ID = $res["max"] ; 

            // inser dans liste nexs_details
            if( (is_null( $ings ) != 1)&&(!empty($ings))  ){ $this->insertR_ing( $ID, $ings );  }

            // inser dans liste nexs_details
            if( (is_null( $etapes ) != 1)&&(!empty($etapes))   ){ $this->insertR_etape( $ID, $etapes );  }

            // inser dans liste nexs_details
            if( (is_null( $metos ) != 1) &&(!empty($metos))  ){ $this->insertR_meto( $ID, $metos );  }

            $this->deconnexion($con);
            return (  $result ); 
        }




        public function insertR_ing( $ID, $ings )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );

            foreach ($ings as $ing) {
                if(!empty($ing)  )
                {
                    $delimiter = ':';
                    $words = explode($delimiter, $ing);
                    $ingredient = $words[1];
                    $quantite = $words[0];
                $qr = "INSERT INTO compose (IDRecette, IDIngredient,quantite ) VALUES( ? , ?, ? )";
                $result =$con->prepare($qr);
                $result->execute(array( $ID, $ingredient,  $quantite));
                // si n'exsite pas without majicule et espaces on les ignores
                $qr2 = "SELECT * FROM ingredient WHERE IDIng = '$ingredient' ";
                $result = $this->requete($con, $qr2);
                $size = 0 ;
                foreach ($result as $res) {
                    $size++;
                }

                    if($size == 0 ){
                        $qr = "INSERT INTO ingredient (IDIng) VALUES( ? )";
                        $result =$con->prepare($qr);
                        $result->execute(array( $ingredient ));
                    }
                }
            }

            $this->deconnexion($con);
        }

        public function insertR_etape( $ID, $etapes )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );

            foreach ($etapes as $etape ) {
                if(!empty($etape)  )
                {
                $qr = "INSERT INTO etape_realis (IDRecette, descript) VALUES( ? , ? )";
                $result =$con->prepare($qr);
                $result->execute(array( $ID, $etape ));
                }
            }
            $this->deconnexion($con);
        }


        public function insertR_meto( $ID, $metos )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            
            
            foreach ($metos as $meto ) {
                if(!empty($meto)  )
                {
                    $delimiter = ':';
                    $words = explode($delimiter, $meto);
                    //echo $words; 
                    $b = $words[1];
                    $m = $words[0];

                $qr = "INSERT INTO recette_cuisine (IDRecette, methode, bonne) VALUES( ? , ?, ? )";
                $result =$con->prepare($qr);
                $result->execute(array( $ID, $m, $b ));
                }
            }
            
            $this->deconnexion($con);
        }

        public function editRecette( $id ,$titre, $img , $Descript, $notation, $difficulte, $categorie, $Temp_prepa,  $Temp_repo,  $Temp_cuiss  , $video, $healthy, $saison , $ings, $etapes, $metos){
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "UPDATE recette SET titre = ?, img = ?, Descript = ?, notation = ?, difficulte = ?, categorie =?, Temp_prepa =?, Temp_repo = ?,Temp_cuiss = ?, saisonR = ?, healthyR = ?, videoR = ? Where IdR =?";
            $result =$con->prepare($qr);
            $result->execute(array($titre,  $img,  $Descript,  $notation,  $difficulte,  $categorie,  $Temp_prepa,  $Temp_repo,  $Temp_cuiss,  $saison,  $healthy,  $video,  $id));
            //edit ingredient, etape, methode; 
            $this->edit_R_ing( $id, $ings);
            $this->edit_R_etape( $id, $etapes);
            $this->edit_R_meto( $id, $metos);

            $this->deconnexion($con);
            return $result;
        }

        public function edit_R_ing(  $id, $ings )
        {
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr2 = "DELETE  from compose where IDRecette = $id" ; 
            $result = $this->requete($con, $qr2);
                $delimiter = ",";
                $words = explode($delimiter, $ings);
                if( is_null( $words ) != 1  ){ $this->insertR_ing($id, $words );}

            $this->deconnexion($con);
        }

        public function edit_R_etape( $id, $etapes)
        {
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr2 = "DELETE  from etape_realis where IDRecette = $id" ; 
            $result = $this->requete($con, $qr2);
                $delimiter = ".";
                $words = explode($delimiter, $etapes);
            if( is_null( $words ) != 1  ){ $this->insertR_etape($id, $words );}
            $this->deconnexion($con);
        }
        public function edit_R_meto( $id, $metos)
        {
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr2 = "DELETE  from recette_cuisine where IDRecette = $id" ; 
            $result = $this->requete($con, $qr2);
            $delimiter = ",";
            $words = explode($delimiter, $metos);
            if( is_null( $words ) != 1  ){ $this->insertR_meto($id, $words );}
            $this->deconnexion($con);
        }


        public function deleteRecette($id){ 
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "DELETE FROM recette Where IdR =".$id;
            $result = $this->requete($con, $qr);

            $qr2 = "DELETE FROM compose WHERE  IDRecette = $id ";
            $result = $this->requete($con, $qr2);

            $qr3 = "DELETE FROM etape_realis WHERE  IDRecette = $id ";
            $result = $this->requete($con, $qr3);

            $qr4 = "DELETE FROM recette_cuisine WHERE  IDRecette = $id ";
            $result = $this->requete($con, $qr4);

            $this->deconnexion($con);
            return $result;
        }






/************************************,Table News *************************/
        public function insertNews( $titre, $image , $description, $video, $p )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "INSERT INTO news (titre, imgN, descript, videoN ) VALUES(?,?,?, ? )";
            $result =$con->prepare($qr);
            $result->execute(array( $titre, $image , $description, $video ));

            $qr2 = "SELECT max(IDNews) as max FROM news";
            $result2 = $this->requete($con, $qr2);
            foreach ($result2 as $res) {
            }

            $ID = $res["max"] ; 
            // inser dans liste nexs_details
            if( is_null( $p ) != 1  ){ $this->insertDatilsNews( $ID, $p );  }
            $this->deconnexion($con);
            return (  $result ); 
        }

        public function insertDatilsNews( $ID, $p  )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $paragraphes = str_split($p, 200); 
            foreach ($paragraphes as $chaine) {
                $qr = "INSERT INTO news_details (IDNewsG, details) VALUES( ? , ? )";
                $result =$con->prepare($qr);
                $result->execute(array( $ID, $chaine ));
            }
            $result->execute(array( $ID, $p ));
            $this->deconnexion($con);
            return (  $result ); 
        }

        public function editNews(  $IDNews, $titre, $image , $description, $video, $p ){
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "UPDATE news SET titre = ?, imgN = ?, descript = ?, videoN =?  Where IDNews = ?";
            $result =$con->prepare($qr);
            $result->execute(array( $titre, $image, $description, $video, $IDNews ));

            // partie changment de paragraphe
            $this->editNewsDetails( $IDNews, $p );  

            $this->deconnexion($con);
            return $result;
        }

        public function editNewsDetails(  $IDNews,  $p )
        {
            $this->deleteDetails( $IDNews );
            if( is_null( $p ) != 1  ){ $this->insertDatilsNews($IDNews, $p ); }
            
        }

        public function deleteDetails( $IDNews )
        {           
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr2 = "DELETE  from news_details where IDNewsG = $IDNews" ; 
            $result = $this->requete($con, $qr2);
            $this->deconnexion($con);
            return $result;
        }
        public function deleteNews( $IDNews ){ 
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "DELETE FROM news Where IDNews =".$IDNews;
            $result = $this->requete($con, $qr);
            // detledte dans liste nexs_details 
            $this->deleteDetails( $IDNews );

            $this->deconnexion($con);
            return $result;
        }






/******************************** Table INGREDIENTS*********************/
        
        public function get_tous_ings( )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * FROM ingredient";
            
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result; 
    
        } 
        
        public function insertIng( $Nom, $saisonI, $healty, $calories_kcal, $glucides_g, $lipides_g, $proteines_g, $vitamines_mg )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );

            if( is_null($saisonI) != 1 ){ $idSaison = $this->insert_Saison(  $saisonI ); }

            else{  $idSaison = NULL;  }  

            $qr = "INSERT INTO ingredient ( IDIng , saison_natur  , healty  , calories_kcal  , glucides_g  , lipides_g  , proteines_g  , vitamines_mg ) VALUES ( ?, ?,   ?, ?,   ?, ?,  ?, ? )";
            $result =$con->prepare($qr);
            $result->execute(array( $Nom, $idSaison, $healty, $calories_kcal, $glucides_g, $lipides_g, $proteines_g, $vitamines_mg ));
            $this->deconnexion($con);
            return (  $result ); 
        }

        // check if saison existe 
        public function saison_existe(  $saisonI )
        {
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $count = 0; 
            if( $saisonI != NULL ){
                $qr = "SELECT * FROM saison   Where NomSaison = '$saisonI' ";
                $result = $this->requete($con, $qr);
                
                foreach ($result as $re) { $count = $count +1 ;}
                }
            $this->deconnexion($con);
            return $count;
        }

        public function insert_Saison(  $saisonI )
        {
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            if( $this->saison_existe( $saisonI )  <= 0 ) 
            {
                $qr = " INSERT INTO saison ( NomSaison ) VALUES ( '$saisonI' ) ";
                $result = $this->requete($con, $qr);

                $qr2 = "SELECT IDSaison, max(IDSaison) as maxS
                        FROM saison
                        WHERE IDSaison in 
                        ( SELECT max(IDSaison) as maxS FROM saison ) ";

                $result2 = $this->requete($con, $qr2);
            }

            else{
                $qr2 = "SELECT IDSaison
                        FROM saison
                        WHERE NomSaison = '$saisonI'  ";

                $result2 = $this->requete($con, $qr2);
            }

            $this->deconnexion($con);
            foreach ($result2 as $max) 
            {
            }
            return $max["IDSaison"];
        }

        public function editIng( $id , $Nom , $saisonI , $healty , $calories_kcal , $glucides_g , $lipides_g , $proteines_g , $vitamines_mg )
        {
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );

            if( is_null($saisonI) != 1 ){ $idSaison = $this->insert_Saison(  $saisonI ); }

            else{ $idSaison = NULL;  }

            $qr = "UPDATE ingredient SET IDIng = ? , saison_natur = ?, healty= ? , calories_kcal= ? , glucides_g= ? , lipides_g= ? , proteines_g= ? , vitamines_mg= ? 
                    Where IDin= ?";
            
            $result =$con->prepare($qr);
            $result->execute(array( $Nom, $idSaison, $healty, $calories_kcal, $glucides_g, $lipides_g, $proteines_g, $vitamines_mg , $id));
            
            $this->deconnexion($con);
            return $result;
        }

        public function deleteIng($id){ /* problème in prepare */
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
        
            $qr2 = "DELETE FROM `compose` WHERE `IDIngredient` in( SELECT IDIng FROM ingredient WHERE IDin = $id )";
            $result = $this->requete($con, $qr2);

            $qr = "DELETE FROM ingredient Where IDin =".$id;
            $result = $this->requete($con, $qr);

            
            $this->deconnexion($con);
            return $result;
        }


/************************************************Table USERS*******************************/

    public function insertUser( $Nom, $saisonI, $healty, $calories_kcal, $glucides_g, $lipides_g, $proteines_g, $vitamines_mg )
        {
            $con = $this->connexion( $this->DbName, $this->host, $this->userName, $this->password );

            if( is_null($saisonI) != 1 ){ $idSaison = $this->insert_Saison(  $saisonI ); }

            else{   $idSaison = NULL;  } 

            $idSaison = NULL; 
            $qr = "INSERT INTO ingredient ( IDIng , saison_natur  , healty  , calories_kcal  , glucides_g  , lipides_g  , proteines_g  , vitamines_mg ) VALUES ( ?, ?,   ?, ?,   ?, ?,  ?, ? )";
            $result =$con->prepare($qr);
            $result->execute(array( $Nom, $idSaison, $healty, $calories_kcal, $glucides_g, $lipides_g, $proteines_g, $vitamines_mg ));
            $this->deconnexion($con);
            return (  $result ); 
        }


        public function deleteUser($id){ 
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "DELETE FROM utilisateur Where IDUser =".$id;
            $result = $this->requete($con, $qr);

            $qr = "DELETE FROM user_prefer_recette Where IDUser = $id ";
            $result = $this->requete($con, $qr);

            $this->deconnexion($con);
            return $result;
        }

        public function note_user( $IDRecette , $note )
        {
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "UPDATE recette SET notation = (notation +$note)/2 
                Where IdR =$IDRecette";
            $result = $this->requete($con, $qr);
            $this->deconnexion($con);
            return $result;
        }

        public function prefer_user( $IDUser, $IDRecette  )
        { echo $IDRecette ; 
            $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
            $qr = "SELECT * from user_prefer_recette where IDUser = $IDUser and  IDRecette = $IDRecette";
            $result = $this->requete($con, $qr);
            $i = 0;
            foreach ($result as $res) 
            {
                $i ++;
            }
            if( $i == 0 )
            {   $qr2 = "INSERT INTO user_prefer_recette(IDUser, IDRecette) VALUES ($IDUser, $IDRecette)";
                $result = $this->requete($con, $qr2);
            }
            $this->deconnexion($con);
            return $result;
        }



    /*************************************Table parametres*************************/
    
    public function get_paras(  )
    {
        $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
        $qr = "SELECT * FROM parametres";
        $result = $this->requete($con, $qr);
        $this->deconnexion($con);
        return $result;
    }

    public function insertP( $nom, $valeur )
    {
        $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
        $qr = "INSERT INTO parametres ( nom_parametre , valeur ) VALUES ( ?, ? )";
        $result =$con->prepare($qr);
        $result->execute(array( $nom, $valeur ));
        $this->deconnexion($con);
        return $result;
    }

    public function editP( $id, $nom, $valeur )
    {
        $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
        $qr = "UPDATE parametres SET nom_parametre = ? , valeur  = ? WHERE ID = ? ";

        $result =$con->prepare($qr);
        $result->execute(array( $nom, $valeur , $id));
        $this->deconnexion($con);
        return $result;
    }

    public function deleteP( $ID )
    {
        $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
        $qr = "DELETE FROM parametres Where ID = $ID";
        $result = $this->requete($con, $qr);
        $this->deconnexion($con);
        return $result;
    }
    

    public function get_image_diapo()
    {
        $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
        $qr = "SELECT valeur FROM `parametres` WHERE  `nom_parametre` LIKE '%diapo%'";
        $result = $this->requete($con, $qr);
        $this->deconnexion($con);
        return $result;
    }

    public function get_seuil_calories()
    {
        $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
        $qr = "SELECT valeur FROM `parametres` WHERE `nom_parametre` = 'seuil_calories_healty' ";
        $result = $this->requete($con, $qr);

        $valeur = null;
                foreach ($result as $one) {
                    $valeur = $one["valeur"];
                }
        $this->deconnexion($con);
        return $valeur;
    }

    public function get_porcent_ing()
    {
        $con=$this->connexion( $this->DbName, $this->host, $this->userName, $this->password );
        $qr = "SELECT valeur FROM `parametres` WHERE `nom_parametre` = 'porcent_idee_recette' ";
        $result = $this->requete($con, $qr);

        $valeur = null;
                foreach ($result as $one) {
                    $valeur = $one["valeur"];
                }
        $this->deconnexion($con);
        return $valeur;
    }

/***********************************Fin modele*********************************/
}

?>
