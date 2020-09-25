<?php
include("header.php");

require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
    $db = connexionBase(); // Appel de la fonction de connexion
    $requete_cat = "SELECT cat_nom, cat_id FROM categories";

    $result_cat = $db->query($requete_cat);

    if (!$result_cat) 
    {
      $tableauErreurs = $db->errorInfo();
      echo $tableauErreur[2]; 
      die("Erreur dans la requête");
    }
?>

<form action="add_script.php" method="POST" enctype="multipart/form-data"><br>

<div class="form-group">
    <label for="fichier" >Image :</label><br>
    <input type="file" class="col-3" name="fichier">
</div>

    <div class="form-group">
        <label for="reference">Référence :</label><br>
        <input type="text" name="reference" class="col-12 form-control">
    </div>

    <?php
        echo "<div class='form-group'>";
            echo "<label for='categorie'>Catégorie :</label><br>";
            echo "<select class='custom-select' id='select' name='categorie'>";
                echo "<option selected disabled>choississez une catégorie </option>";
            while ($row = $result_cat->fetch(PDO::FETCH_OBJ))
                {
                    echo "<option value='".$row->cat_id."'>".$row->cat_nom."</option>";
                }
            echo "</select>";
        echo "</div>";
    ?>

    <div class="form-group">
        <label for="libelle">Libellé :</label><br>
        <input type="text" name="libelle" class="col-12 form-control">
    </div>
    <div class="form-group">
        <label for="description">Description :</label><br>
        <textarea type="textarea" name="description" class="col-12 form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="prix">Prix :</label><br>
        <input type="text" name="prix" class="col-12 form-control">
    </div>
    <div class="form-group">
        <label for="stock">Stock :</label><br>
        <input type="text" name="stock" class="col-12 form-control">
    </div>
    <div class="form-group">
        <label for="couleur">Couleur :</label><br>
        <input type="text" name="couleur" class="col-12 form-control">
    </div>
    <div class="form-group">
        <label for="bloque">Produit bloqué :</label><br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="bloque" value="1" >oui <br>
            <input class="form-check-input" type="radio" name="bloque" value="0" >non
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="col-3 btn btn-success">Valider</button>
        <a href='tableau.php' role='button' type="reset" class="col-3 btn btn-danger">Annuler</button>
        </a>
    </div>
</form>

<?php
include('footer.php');
?>