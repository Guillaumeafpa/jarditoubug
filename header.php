<!DOCTYPE html>

<html lang="fr">
  <head>
 	  <meta charset="utf-8">
 	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  	<link href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" rel="stylesheet" crossorigin="anonymous">
    <title>Jarditou.com</title>
  </head>


  <?php

  $url = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'];
  /* teste si on est a index.php */
  //----------------------------------------------
  if (preg_match('/index\.php/',$url))//trouver fonction équivalent a like en php
  {$index_active = 'active';}
  else 
  {$index_active = "";}
  //----------------------------------------------



  /* teste si on est a boutique.php */
  //----------------------------------------------
  if (preg_match('/boutique\.php/',$url))
  {$boutique_active = 'active';}
  else 
  {$boutique_active = "";}
  //----------------------------------------------



  /* teste si on est a formulaire.php */
  //----------------------------------------------
  if (preg_match('/formulaire\.php/',$url))
  {$formulaire_active = 'active';}
  else 
  {$formulaire_active = "";}
  //----------------------------------------------

  ?>
  <body>
    <div class="container">
      <div class="row d-none d-lg-flex align-items-center">
        <!-- Logo du site -->
        <div class="col-sm-12 col-lg-3">
          <a href="index.php" title="Jarditou"><img class="img-fluid" src="public/images/jarditou_logo.jpg" alt="Logo Jarditou"></a>
        </div>
        <div class="d-sm-none d-lg-block col-lg-4"></div>
        <!-- Slogan du site -->
        <div class="col-sm-12 col-lg-5">
          <h1 class="text-center">Tout le jardin</h1>
        </div>
      </div>
      <div classs="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="index.php">Jarditou.com</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link <?PHP echo $index_active; ?>" href="index.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?PHP echo $boutique_active; ?>" href="boutique.php">Boutique</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?PHP echo $formulaire_active; ?>" href="formulaire.php">Contact</a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 p-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Votre promotion" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
          </div>    
        </nav>

        <img src="public/images/promotion.jpg" title="promotion a ne pas manquer" class="img-fluid" alt="Responsive image">