<?php
include("header.php")
?>

<div class="titre_formulaire"><p class="mb-2 error">* Ces zones sont obligatoires</p></div>
<h1> Vos coordonées</h1>

<?php

$nom = $prenom = $gender= $ddn = $code_postal = $adresse = $ville = $email= $sujet = $commentaire = $checkbox = "";
$sujet ="sélectionner un sujet";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $nom = test_input($_POST["nom"]);
  $prenom = test_input($_POST["prenom"]);
  $ddn = test_input($_POST["ddn"]);
  $code_postal = test_input($_POST["code_postal"]);
  $adresse = test_input($_POST["adresse"]);
  $ville = test_input($_POST["ville"]);
  $email = test_input($_POST["email"]);
  $sujet = test_input($_POST["sujet"]);
  $commentaire = test_input($_POST["commentaire"]);
}

function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$nomErr = $prenomErr = $genderErr = $ddnErr = $code_postalErr = $emailErr= $sujetErr = $commentaireErr = $checkboxErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
// test les champs obligatoires pour vérifier qu'ils soit remplis, sinon déclenchement du message d'erreur correspondant
{
  // test sur le nom
  if (empty($_POST["nom"]))
  {
    $nomErr = "* veuillez entrer votre nom";
  }
  else 
  {
    $nom = test_input($_POST["nom"]);
  }

  //test sur le prenom
  if (empty($_POST["prenom"])) 
  {
    $prenomErr = "* veuillez entrer votre prénom";
  } 
  else 
  {
    $prenom = test_input($_POST["prenom"]);
  }

  //test sur le genre
  if (empty($_POST["gender"])) 
  {
    $genderErr = "* veuillez précisez vottre sexe";
  } 
  else 
  {
    $gender = test_input($_POST["gender"]);
  }

  //test sur la date de naissance 
  if (empty($_POST["ddn"])) 
  {
    $ddnErr = "* il faut entrer une date de naissance";
  } 
  else 
  {
    $ddn= test_input($_POST["ddn"]);
  }

  //test sur le code postal + reg exp
  if (empty($_POST["code_postal"])) 
  {
    $code_postalErr = "* il faut entrer un code postal";
  } 
  else
  {
    $code_postal = test_input($_POST["code_postal"]);
    if (!preg_match("/[0-9]{2}[ ]?[0-9]{3}/",$code_postal))
    {
      $code_postalErr = "votre code postal n'est pas valide";
    }
  }

  //test sur l'email + reg exp
  if (empty($_POST["email"])) 
  {
    $emailErr = "* il faut entrer une adresse mail ";
  } 
  else 
  {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $emailErr = "votre adresse mail n'est pas valide";
    }
  }

  // preg_match(expression réguliére, une variable)(cette fonction permet de vérifier l'expression régulière du champ en question) *a mettre dans un if pour tester*
  if (empty($_POST["sujet"])) 
  {
    $sujjetErr = "* sujet is required";
  } 
  else 
  {
    $sujet = test_input($_POST["sujet"]);
  }

  //test sur le commentaire
  if (empty($_POST["commentaire"])) 
  {
    $commentaireErr = "* commentaire is required";
  }
  else 
  {
    $commentaire = test_input($_POST["commentaire"]);
  }

  //test sur le checkbox
  if (empty($_POST["checkbox"])) 
  {
    $checkboxErr = "* checkbox is required";
  }
  else 
  {
    $checkbox = test_input($_POST["checkbox"]);
  }
}
?>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
  <div class="form-group">

    <div class="form-group">
      <label for="Nom">Nom *</label>
      <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $nom;?>" placeholder="Veuillez saisir votre nom" >
      <span class="error"><?php echo $nomErr;?></span>
    </div>

    <div class="form-group">
      <label for="Prenom">Prénom *</label>
      <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $prenom;?>" placeholder="Veuillez saisir votre prénom" >
      <span class="error"><?php echo $prenomErr;?></span>
    </div>

    <div class="form-group">
      <p>Sexe *</p>
      <div class="form-check">
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="homme") echo "checked";?> value="homme" > Homme <br>
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="femme") echo "checked";?> value="femme" > Femme
      </div><span class="error"><?php echo $genderErr;?></span>
    </div>

    <div class="form-group">
      <label for="date">Date de naissance *</label>
      <input type="date" class="form-control" name="ddn" value="<?php echo $ddn;?>" id="date" >
      <span class="error"><?php echo $ddnErr;?></span>
    </div>

    <div class="form-group">
      <label for="code_postal">Code postal *</label>
      <input type="text" name="code_postal" class="form-control" value="<?php echo $code_postal;?>" id="code_postal">
      <span class="error"><?php echo $code_postalErr;?></span>
    </div>

    <div class="form-group">
      <label for="adresse">Adresse</label>
      <input type="text" name="adresse" id="adresse" value="<?php echo $adresse;?>" class="form-control">
    </div>

    <div class="form-group">
      <label for="Ville">Ville</label>
      <input type="text" name="ville" value="<?php echo $ville;?>" class="form-control" id="Ville">
    </div>

    <div class="form-group">
      <label for="email">Email *</label>
      <input type="text" placeholder="dave.loper@afpa.fr" value="<?php echo $email;?>" class="form-control" name="email" id="email" >
      <span class="error"><?php echo $emailErr;?></span>
    </div>

    <h1>Votre demande</h1>

    <legend for="sujet">Sujet *</legend>
    <select class="form-control" name="sujet" id="sujet">
      <option value="sélectionner un sujet">Veuillez selectionner un sujet</option>
      <option value="mes commandes" <?php if (isset($sujet) && $sujet=="mes commandes") echo "selected";?>>Mes commandes</option>
      <option value="Question sur un produit" <?php if (isset($sujet) && $sujet=="Question sur un produit") echo "selected";?>>Question sur un produit</option>
      <span class="error"><?php echo $sujetErr;?></span>
    </select>

    <label for="votre question">Votre question *</label>
    <textarea class="form-control" name="commentaire" value="" id="votre question" rows="2"><?php echo $commentaire;?></textarea>
    <span class="error"><?php echo $commentaireErr;?></span>

    <div class="form-group form-check">
      <input type="checkbox" class="form-check-input" value="J'accepte le traitement informatique de ce formulaire" name="checkbox" <?php if (isset($checkbox) && $checkbox=="J'accepte le traitement informatique de ce formulaire") {echo "checked";}?> id="checkbox">
      <label class="form-check-label" for="checkbox">J'accepte le traitement informatique de ce formulaire.</label>
      <span class="error"><?php echo $checkboxErr;?></span>

      <br><br><button type="submit" class="btn btn-dark">Envoyer</button>
      <button type="reset" class="btn btn-dark">Annuler</button>
    </div>
  </div>
</form>
<?php

echo "<h2>vos réponses:</h2>";
echo $nom;
echo "<br>";
echo $prenom;
echo "<br>";
echo $gender;
echo "<br>";
echo $ddn;
echo "<br>";
echo $code_postal;
echo "<br>";
echo $adresse;
echo "<br>";
echo $ville;
echo "<br>";
echo $email;
echo "<br>";
echo $sujet;
echo "<br>";
echo $commentaire;
echo "<br>";
echo $checkbox;

include("footer.php")
?>
