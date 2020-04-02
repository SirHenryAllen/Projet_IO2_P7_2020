<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membres','root','') ;
if(isset($_POST['submit']))
{       
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        $mdp = sha1($_POST['mdp']);
        $mdp2 = sha1($_POST['mdp2']);


    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND!empty($_POST['pseudo']) AND!empty($_POST['mail']) AND!empty($_POST['mdp']) AND!empty($_POST['mdp2'])) {
        $pseudolength  = strlen($pseudo);
        if($pseudolength <=  10) {
            $reqpseudo = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ?");
            $reqpseudo ->execute(array($pseudo));
            $pseudoexist = $reqpseudo->rowCount();
            

                    if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        $reqmail = $bdd->prepare("SELECT * FROM membre WHERE mail = ?");
                        $reqmail ->execute(array($mail));
                        $mailexist = $reqmail->rowCount();
                        if($mailexist == 0) {
                            if($mdp==$mdp2) {
                                $insertmbr = $bdd ->prepare("INSERT INTO membre (nom, prenom, pseudo, mail, pwd) VALUE (?,?,?,?,?)");
                                $insertmbr->execute(array($nom, $prenom, $pseudo, $mail, $mdp));
                                $erreur = "votre compte a été  crée avec succes ! ";
                            }
                        	else {
                        		$erreur = "vos mots de passe ne correspondent pas !" ;      
                        	}
                       	}
                       	else {
                       		$erreur = "Cette adresse mail existe déjà !";
                       	}
                    }
                    else {
                       	$erreur = "votre adresse mail n'est pas valide !";
                    }

                
 
        }
        else {
            $erreur = "votre pseudo ne doit pas dépasser 10 caratères ! ";
        }
    }
    else {
        $erreur = "tous les champs doivent etre complétés ! ";
       
    }
}

?>
<!DOCTYPE html>
<html>
<meta charset ="utf-8" />

<head>
<title>monCompte</title>    
<link rel="stylesheet" type="text/css" href="styleEnregistrement.css">
</head>

<header>
    <?php include "Header.html"; ?>
</header>

<body>
    <table>     
        <tr>
            <td class="sign">
                <form class="formu" action="" method="post">
                    <div class="nom">
                        <p>Pas encore membre ? Inscription : </p>
                        <label for="name">Nom :</label>
                        <input type="text" name="nom" id ="nom" placeholder="Entrez nom" class="inputNom">
                    </div>
    
                    <p></p>

                    <div class="prenom">
                        <label for="name">prenom :</label>
                        <input type="text" name="prenom" id ="prenom"  placeholder="Entrez prenom" class="inputPrenom" >
                    </div>
                
                    <p></p>

                    <div class="pseudo">
                        <label for="name">pseudo :</label>
                        <input type="text" name="pseudo" id ="pseudo" placeholder="Entrez pseudo" value="<?php if(isset($pseudo)) {echo $pseudo ;} ?>" class="inputPseudo">
                    </div>
            
                    <p></p>

                    <div class="email">
                        <label for="name">e-mail:</label>
                        <input type="email" name="mail" id ="mail" placeholder="Entrez e-mail" value="<?php if(isset($mail)) {echo $mail;} ?>" class="inputMail" >
                    </div>
                
                    <p></p>

                    <div class="mdp">
                        <label for="name">mot-de-passe:</label>
                        <input type="password" name="mdp" id ="mdp" placeholder="Entrez mot de passe" class="inputMdp">
                    </div>
                
                    <p></p>

                    <div class="mdpConfirmation">
                        <label for="name">confirmer mot-de-passe:</label>
                        <input type="password" name="mdp2" id ="mdp2" placeholder="confirmez le mot de passe" class="inputMdp2" >
                    </div>
                
                    <p></p>

                    <input type="submit" name="submit" value="valider">
                  <?php 
                  if(isset($erreur))
                    {
                        echo '<font color="red">'.$erreur."</font>" ;
                    }
                    ?>
                </form>
                 
                        


            </td>

            <td class="void"> </td>
        
             <td class="register">
            
                <p> Vous possèdez déjà un compte ? Connexion : </p>
            
                <br>
            
                <form class="formu" action="" method="post">
                
                    <div class="pseudo">
                        <label for="name">pseudo :</label>
                        <input type="text" id="name" placeholder="Entrez pseudo" class="inputPseudo">
                    </div>
                
                    <p></p>

                    <div class="mdp">
                        <label for="name">mot-de-passe:</label>
                        <input type="password" id="name" placeholder="Entrez mot de passe" class="inputMdp" >
                    </div>

                </form>

                <br>
                <br>

                <input type="submit" name="connexion">
    
            </td>
        </tr>

    </table>

</body>
</html>