<?php
if(isset($_POST['inscription'])) {
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$email = htmlspecialchars($_POST['email']);
	$mdp = password_hash($_POST['mdp']);
	$mdpC = password_hash($_POST['mdpC']);
}

?>