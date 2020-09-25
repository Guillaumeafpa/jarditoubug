<?php
include("header.php");

$id = $_GET['id'];

require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
    $db = connexionBase(); // Appel de la fonction de connexion
    $requete = "SELECT pro_photo, pro_id, pro_cat_id, pro_ref, pro_libelle, pro_description, pro_prix,    pro_stock, pro_couleur, pro_d_ajout, pro_d_modif, pro_bloque, cat_nom FROM produits  INNER JOIN categories ON produits.pro_cat_id = categories.cat_id WHERE pro_id =".$id;

    $requete_cat = "SELECT cat_nom, cat_id FROM categories";

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
?>
<form action="update_script.php" method="POST"><br>
    <div class="text-center">
        <input type="hidden" name='pro_id' value='<?php echo $produit->pro_id; ?>'>
    </div>
    <div class="text-center">
        <img src="public/images/<?php echo $produit->pro_id.".".$produit->pro_photo;?>" alt="image du produit" width="350 px">
    </div>
    <div class="form-group">
        <label for="reference">Référence :</label><br>
        <input type="text" name="reference" class="col-12 form-control" value="<?php echo $produit->pro_ref; ?>" >
    </div>
    <div class="form-group">
        <label for="categorie">Catégorie :</label><br>
        <?php
            echo "<select class='custom-select' id='select' name='categorie'>";
            echo "<option selected value='".$produit->pro_cat_id."'>".$produit->cat_nom."</option>";
            while ($row = $result_cat->fetch(PDO::FETCH_OBJ))
                {
                    echo "<option value='".$row->cat_id."'>".$row->cat_nom."</option>";
                }
            echo "</select>";

        ?>
    </div>
    <div class="form-group">
        <label for="libelle">Libellé :</label><br>
        <input type="text" name="libelle" class="col-12 form-control" value="<?php echo $produit->pro_libelle;?>" >
    </div>
    <div class="form-group">
        <label for="description">Description :</label><br>
        <textarea type="textarea" name="description" class="col-12 form-control"  ><?php echo $produit->pro_description;?></textarea>
    </div>
    <div class="form-group">
        <label for="prix">Prix :</label><br>
        <input type="text" name="prix" class="col-12 form-control" value="<?php echo $produit->pro_prix;?>" >
    </div>
    <div class="form-group">
        <label for="stock">Stock :</label><br>
        <input type="text" name="stock" class="col-12 form-control" value="<?php echo $produit->pro_stock;?>" >
    </div>
    <div class="form-group">
        <label for="couleur">Couleur :</label><br>
        <input type="text" name="couleur" class="col-12 form-control" value="<?php echo $produit->pro_couleur;?>" >
    </div>
    <div class="form-group">
        <label for="bloque">Produit bloqué ? :</label><br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="bloque" value="1" <?php if (isset($produit->pro_bloque) !== NULL || 0) echo "checked";?> >oui <br>
            <input class="form-check-input" type="radio" name="bloque" value="0"<?php if (isset($produit->pro_bloque) == Null || 0) echo "checked";?> >non
        </div>
    </div>
    <div class="form-group">
        <label for="date_ajout">Date d'ajout :</label><br>
        <input type="text" class="col-12 form-control" value="<?php echo $produit->pro_d_ajout;?>" disabled>
    </div>
    <div class="form-group">
        <label for="date_modification">Date de modification :</label><br>
        <input type="text" class="col-12 form-control" value="<?php echo $produit->pro_d_modif;?>" disabled>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success ">Valider</button>
    </div>
</form>

<?php
include("footer.php");
?>