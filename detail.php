<?php
include("header.php");


$id = $_GET['id'];

require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
    $db = connexionBase(); // Appel de la fonction de connexion
    $requete = "SELECT pro_photo, pro_id, pro_cat_id, pro_ref, pro_libelle, pro_description, pro_prix,    pro_stock, pro_couleur, pro_d_ajout, pro_d_modif, pro_bloque FROM produits WHERE pro_id =".$id;
    $requete_cat = "SELECT cat_nom, cat_id FROM categories inner join produits on produits.pro_cat_id = categories.cat_id WHERE pro_id =".$id;
    
    $result = $db->query($requete);

    if (!$result) 
    {
      $tableauErreurs = $db->errorInfo();
      echo $tableauErreur[2]; 
      die("Erreur dans la requête");
    }
    $produit = $result->fetch(PDO::FETCH_OBJ);

    $result_cat = $db->query($requete_cat);

    if (!$result_cat) 
    {
      $tableauErreurs = $db->errorInfo();
      echo $tableauErreur[2]; 
      die("Erreur dans la requête");
    }
    $categorie = $result_cat->fetch(PDO::FETCH_OBJ);
?>
<form action=""><br>
    <div class="text-center">
        <img src="public/images/<?php echo $produit->pro_id.".".$produit->pro_photo;?>" alt="image du produit" width="350 px">
    </div>
    <div class="form-group">
        <label for="reference">Référence :</label><br>
        <input type="text" class="col-12 form-control" value="<?php echo $produit->pro_ref;?>" disabled>
    </div>
    <div class="form-group">
        <label for="categorie">Catégorie :</label><br>
        <input type="text" class="col-12 form-control" value="<?php echo $categorie->cat_nom;?>" disabled>
    </div>
    <div class="form-group">
        <label for="libelle">Libellé :</label><br>
        <input type="text" class="col-12 form-control" value="<?php echo $produit->pro_libelle;?>" disabled>
    </div>
    <div class="form-group">
        <label for="description">Description :</label><br>
        <textarea type="textarea" class="col-12 form-control"  disabled><?php echo $produit->pro_description;?></textarea>
    </div>
    <div class="form-group">
        <label for="prix">Prix :</label><br>
        <input type="text" class="col-12 form-control" value="<?php echo $produit->pro_prix;?>" disabled>
    </div>
    <div class="form-group">
        <label for="stock">Stock :</label><br>
        <input type="text" class="col-12 form-control" value="<?php echo $produit->pro_stock;?>" disabled>
    </div>
    <div class="form-group">
        <label for="couleur">Couleur :</label><br>
        <input type="text" class="col-12 form-control" value="<?php echo $produit->pro_couleur;?>" disabled>
    </div>
    <div class="form-group">
        <label for="bloque">Produit bloqué ? :</label><br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="bloque" value="oui" <?php if (isset($produit->pro_bloque) !== NULL || 0) echo "checked";?> disabled>oui <br>
            <input class="form-check-input" type="radio" name="bloque" value="non"<?php if (isset($produit->pro_bloque) == Null || 0) echo "checked";?> disabled>non
        </div>
    </div>
    <div class="form-group">
        <label for="date_ajout">Date d'ajout :</label><br>
        <input type="text" class="col-12 form-control" value="<?php echo $produit->pro_d_ajout;?>" disabled>
    </div>
    <div class="form-group">
        <label for="date_modification">Date de modification :</label><br>
        <input type="text" class="col-12 form-control" action="" value="<?php echo $produit->pro_d_modif;?>" disabled>
    </div>
</form>



<div class="form-group">
    <a href="update_form.php?id=<?php echo $produit->pro_id;?>">
        <button class="btn btn-info col-3">Modifier</button>
    </a>
    <a href="delete_script.php?id=<?php echo $produit->pro_id;?>">
        <button class="btn btn-danger offset-1 col-3">supprimer</button>
    </a>
</div>

<?php
include("footer.php");
?>