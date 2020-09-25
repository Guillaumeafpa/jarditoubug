<?php
/* on récupére les valeur modifier dans le update_form pour les tester */ 
//----------------------------------------------
function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $id = test_input($_POST["pro_id"]);
  $reference = test_input($_POST["reference"]);
  $categorie = test_input($_POST["categorie"]);
  $libelle = test_input($_POST["libelle"]);
  $description = test_input($_POST["description"]);
  $prix = test_input($_POST["prix"]);
  $stock = test_input($_POST["stock"]);
  $couleur = test_input($_POST["couleur"]);
  $bloque = test_input($_POST["bloque"]);
}

$id = (int)$id;
$categorie = (int)$categorie;
$stock = (int)$stock;
$prix = (float)$prix;

if ($bloque == 1)
{
  $bloque = 1;
}
else 
{
  $bloque = NULL;
}
//----------------------------------------------



/* on va tester tout les champs pour être sûres que aucune injection de code s'execute côté serveur */
//----------------------------------------------
$test_id = preg_match('/0-9{1,10}/', $id);
$test_ref = preg_match('/[a-z,A-Z-_0-9,àáâãäåçèéêëìíîïðòóôõöùúûüýÿ]{1,10}/',$reference);
$test_cat = preg_match('/[0-9]{1,10}/', $categorie);
$test_lib = preg_match('/[a-z,A-Z, ,-,0-9,àáâãäåçèéêëìíîïðòóôõöùúûüýÿ]{1,200}/', $libelle);
$test_des = preg_match('/[a-z,A-Z,;,., ,-,0-9,-,àáâãäåçèéêëìíîïðòóôõöùúûüýÿ]{1,1000}/', $description);
$test_pri = preg_match('/[0-9]{1,6}([,.]{1}[0-9]{0,2}){0,1}/',$prix);
$test_sto = preg_match('/[-0-9]{1,11}/', $stock);
$test_cou = preg_match('/[a-zA-Z]{1,30}/', $couleur);
//----------------------------------------------


/* si les tests retourne false alors la commande ne s'execute pas et on redirige la personne */

if ($test_id == false || $test_ref == false || $test_cat == false || $test_lib == false || $test_des == false || $test_sto == false || $test_cou == false || $test_pri)
{
  header('Location: tableau.php');
}

/* si les tests retourne true alors in rentre dans le else et on execute la commande */
else 
{
  /* on ce connect a la base de donnée */
  require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
  $db = connexionBase(); // Appel de la fonction de connexion
  //----------------------------------------------

  
  /* on prépare la modification des anciennes données de la base de donnée */
  $stmt = $db->prepare("UPDATE produits SET pro_ref =  :reference, pro_cat_id = :categorie,   pro_libelle = :libelle, pro_description = :description1, pro_prix = :prix, pro_stock = :stock,  pro_couleur = :couleur, pro_bloque = :bloque, pro_d_modif = CURRENT_TIMESTAMP() WHERE pro_id =   :pro_id");
  //----------------------------------------------


  /* on indique que les valeurs a modifier et on bind $stmt pour qu'il sache ce que représente les  :...  puis on éxecute la commande $stmt */
  $stmt->bindValue(':pro_id', $id);
  $stmt->bindValue(':reference', $reference);
  $stmt->bindValue(':categorie', $categorie);
  $stmt->bindValue(':libelle', $libelle);
  $stmt->bindValue(':description1', $description);
  $stmt->bindValue(':prix', $prix);
  $stmt->bindValue(':stock', $stock);
  $stmt->bindValue(':couleur', $couleur);
  $stmt->bindValue(':bloque', $bloque);
  $stmt->execute();
  //----------------------------------------------

  header('Location: tableau.php');
}
//----------------------------------------------
?>
