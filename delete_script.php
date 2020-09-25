<?php
/* on récupére l'id du produit a supprimer */
//----------------------------------------------
$id = $_GET['id'];
$id = (int)$id;
//----------------------------------------------



/* on ce connect a la base de donnée */
//----------------------------------------------
require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
$db = connexionBase(); // Appel de la fonction de connexion
//----------------------------------------------



/* on prepare/execute la requete delete */
//----------------------------------------------
$supression = $db -> prepare("DELETE FROM `produits` WHERE `pro_id` = :pro_id");
$supression->bindValue(':pro_id', $id);
$supression->execute();
//----------------------------------------------



/* on redirige vers la page liste */
//----------------------------------------------
{
header('Location: tableau.php');
}
//----------------------------------------------
?>