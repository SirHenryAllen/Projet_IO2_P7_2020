<?php
require_once "enregistrement.php";
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membres','root','') ;
if(isset($_POST['submit'])) // Récupération des variables formulaire
{       
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        $mdp = sha1($_POST['mdp']);
        $mdp2 = sha1($_POST['mdp2']);


    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND!empty($_POST['pseudo']) AND!empty($_POST['mail']) AND!empty($_POST['mdp']) AND!empty($_POST['mdp2'])) { 
    // Vérification du contenu des variables
        $pseudolength  = strlen($pseudo);
        if($pseudolength <=  10) {  
            //  Vérification de la conformité de la longueure du pseudo
            $reqpseudo = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ?");
            $reqpseudo ->execute(array($pseudo));
            $pseudoexist = $reqpseudo->rowCount();
            

                    if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {  
                        // Vérification de la validité de l'email
                        $reqmail = $bdd->prepare("SELECT * FROM membre WHERE mail = ?");
                        $reqmail ->execute(array($mail));
                        $mailexist = $reqmail->rowCount();
                        // Vérification de la récurence de l'email
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