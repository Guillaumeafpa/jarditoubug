<?php
include("header.php");

/* on connect notre page a la base dedonnées */
//----------------------------------------------
  require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
  $db = connexionBase(); // Appel de la fonction de connexion
  $requete = "SELECT pro_photo, pro_id, pro_ref, pro_libelle, pro_prix, pro_stock, pro_couleur, pro_d_ajout, pro_d_modif, pro_bloque FROM produits WHERE ISNULL(pro_bloque) ORDER BY pro_d_ajout DESC";
//----------------------------------------------



/* je ne sais pas a quoi sa sert */
//----------------------------------------------
  $result = $db->query($requete);

  if (!$result) 
  {
    $tableauErreurs = $db->errorInfo();
    echo $tableauErreur[2]; 
    die("Erreur dans la requête");
  }

  if ($result->rowCount() == 0) 
  {
    // Pas d'enregistrement
    die("La table est vide");
  }
//----------------------------------------------



/* on creer le bouton d'ajout de produit du tableau */
//----------------------------------------------
?>
<div>
  <br>
  <a href='add_form.php' title="lien vers le formulaire d'ajout"><button type="submit" class="col-12 btn bg-secondary text-white"><strong>ajouter un produit</strong>
  </button></a><br>
  <br>
</div>

<div>
  <?php
//----------------------------------------------



/* on creer l'entête du tableau */
//----------------------------------------------
  echo '<div class="table-responsive p-0">';
  echo '<table class="table table-bordered table-responsive-lg table-striped">';
    echo '<tbody>';
    echo '<thead class="thead-light">';
      echo '<tr class="table-active">';
        echo '<th class="align-middle"><strong>Photos</strong></th>';
        echo '<th class="align-middle"><strong>ID</strong></th>';
        echo '<th class="align-middle"><strong>Référence</strong></th>';
        echo '<th class="align-middle"><strong>Libellé</strong></th>';
        echo '<th class="align-middle"><strong>Prix</strong></th>';
        echo '<th class="align-middle"><strong>Stock</strong></th>';
        echo '<th class="align-middle"><strong>Couleur</strong></th>';
        echo '<th class="align-middle"><strong>Ajout</strong></th>';
        echo '<th class="align-middle"><strong>Modif</strong></th>';
        echo '<th class="align-middle"><strong>Bloqué</strong></th>';
      echo '</tr>';
    echo '</thead>';
//----------------------------------------------

  

/* on créer une boucle (while) pour inclure tout les produits de la base de données dans le tableau */
//----------------------------------------------
  while ($row = $result->fetch(PDO::FETCH_OBJ))
  {
    echo"<tr>";
      echo"<td class='table-warning'><img src='public/images/".$row->pro_id.".".$row->pro_photo.  "' width='100px'></td>";
      echo"<td class='align-middle text-center'>".$row->pro_id."</td>";
      echo"<td class='align-middle text-center'>".$row->pro_ref."</td>";
      echo"<td class='table-warning align-middle text-center'><a class='text-danger'  href='detail.php?id=$row->pro_id' title='$row->pro_libelle'><strong>$row->pro_libelle</  strong></a></td>";
      echo"<td class='align-middle text-center'>".$row->pro_prix."</td>";
      echo"<td class='align-middle text-center'>".$row->pro_stock."</td>";
      echo"<td class='align-middle text-center'>".$row->pro_couleur."</td>";
      echo"<td class='align-middle text-center'>".$row->pro_d_ajout."</td>";
      echo"<td class='align-middle text-center' >".$row->pro_d_modif."</td>";
      echo"<td class='align-middle text-center'>".$row->pro_bloque."</td>";
    echo"</tr>";
  }
  echo "</tbody>";
  echo "</table>"; 
  echo "</div>";
//----------------------------------------------



/* on creer le bouton d'ajout de produit du tableau */
//----------------------------------------------
?>
<div>
  <a href='add_form.php' title="lien vers le formulaire d'ajout"><button type="submit" class="col-12 btn bg-secondary text-white"><strong>ajouter un produit</strong>
  </button></a><br>
  <br>
</div>

<div>
  <?php
//----------------------------------------------

?>
</div>

<?php
include("footer.php");
?>