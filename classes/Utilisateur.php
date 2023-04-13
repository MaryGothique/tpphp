<?php

if(isset($_GET['nom'])){
 echo 'Le valeur de $_GET[\'nom\'] est ' .$_GET['nom'].'<br>';
}

if(isset($_POST['nom'])){
 
   }
   if(isset($_POST['nom'])){

   }

   if(isset($_REQUEST['nom'])){

   }


$filtreMotDePasse = array(
   'filter' => FILTER_VALIDATE_REGEXP,
   'options' => array('regexp' => '#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$#')
);
$filtres = array(
    'nom' => FILTER_VALIDATE_STRING,
    'email' => FILTER_VALIDATE_EMAIL,
    'motDePasse' => $filtreMotDePasse,
    // !!! le champ notation n'existe pas dans le formulaire!!!
    'notation' => FILTER_VALIDATE_INT
);
