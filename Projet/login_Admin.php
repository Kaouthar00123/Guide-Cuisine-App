<?php
require_once ('ctl_Admin.php');

class loginAdmin{

public function afficher_login_Admin(){
    $this->header_login();
    $this->login();
}


public function header_login()
{ ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./CSS/AdminStyle.css">
        <title>Authentification d'entré à la page d'adlministarteur</title>
    </head>
<?php
}

public function login()
{ ?>

    <body>
        <div class="bigContainer">
        <!-- Formulaire  -->
            <div class="formeTab1">

        
                <form id="login" method="POST" action = "<?php $controller = new controlerAdmin();  $controller->login_admin();?>">
                    <h2>Se connecter à la page d'administrateur</h2>

        
                    <div  id="form-tab1">
                            <div class="element">
                            <label>Nom d'utlisateur</label>
                            <input type="text" name = "username" required/>
                            </div>
            
                            <div class="element">
                            <label>Mot de passe</label>
                            <input type="password" name = "password" required/>
                            </div>
            
                            <div class="Dsubmit">
                                <input type="submit" name="login" class="connecter" value="Se connecter"></input>
        
                                <button class="Annuler" >Annuler</button>
                            </div>
                    </div>
                </form>
        
            </div> 

        </div>

    </body>
    </html>
    <?php
    }

}
?>


