<?php
require_once('controler.php');

class loginView{

    public function entete(){
        ?>
        <head>
        <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta http-equiv="Cache-Control" content="no-store" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Login Page</title>
                    <link rel="stylesheet" href="CSS/all.min.css">
                    <link rel="stylesheet" href="CSS/style_acceuil_commun.css">
                    <link rel="stylesheet" href="CSS/page_recettes.css">
                    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
                    
                </head>
                <body>
                    <div class="contanier">
        </head>

        <?php
    }

    public function pied()
    {?>
        </div>
        </body>
        <?php
    }



    public function inscription(){
        ?>
    <div class="login cadre">
        <form class = "inscrer cadre" method="post" action="<?php $controler = new controler(); $controler->inscrer(); ?>">
            <p>Nom <input type="text" name="nom" id="nom" required ></p> 
            <p>Prenom <input type="text" name="prenom" id="prenom" required></p> 
            <p>Mail <input type="email" name="mail" id="mail" ></p> 
            <p>Sexe <input type="text" name="sexe" id="sexe"></p> 
            <p>Date de naissance <input type="date" name="date_naissance" id="date_naissance"></p> 
            <p>Nom utlisateur <input type="text" name="username" id="username" required></p> 
            <p>Mot de passe <input type="password" name="password" id="password" required></p> 
            <button type="submit" name="inscrer" class="btn_form save">Enregistrer</button>
        </form>
    </div>
        <?php
    }

    public function login(){
        ?>
    <div class="login cadre">
    <form  class = "cadre" method="post" action="<?php $controler = new controler(); $controler->login(); ?>">
        <p>Nom utlisateur <input type="text" name="username" id="username"></p> 
        <p>Mot de passe <input type="password" name="password" id="password"></p> 
        <button type="submit" name="login" class="btn_form login">Valider</button>
    </form>
    <a href="inscription.php" class="btn_form incription">Inscription</a>
    </div>
    
        <?php
    }

    public function affiche_login()
    {
        $this->entete();
        $this->login();
        $this->pied();

    }
    public function affiche_iscription()
    {
        $this->entete();
        $this->inscription();
        $this->pied();

    }
}
?>