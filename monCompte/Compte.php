<?php
require_once "enregistrement.php";
require_once "inscription.php";

$connex = connexion_bd();

$prods = lire_produits($connex);

page_produits($prods);

mysqli_free_result($prods);

mysqli_close($connex);

?>
