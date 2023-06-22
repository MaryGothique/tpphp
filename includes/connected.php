<?php
session_start(); //la page de connection où je me suis connecté
if (isset($_SESSION['user'])) {
    $nom = $_SESSION['user']['nom'];
    
} else {
    header('location: ../index.php'); //le chemin de connection
}


if (isset($_SESSION['user'])) {
    $nom = $_SESSION['user']['nom'];
    
} else {
    header('location: ../index.php'); //le chemin de connection
}
if (isset($valider)) { #si tous les champs sont riempli
    
    
        header("location:head.php"); # et du coup je me retrouve dans la page "connected"
    } else # sinon
        $erreur = "riemplir tous les champs"; #j'ai ce message

    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/connected.css" />
    <title>Ma page</title>
</head>

<body>
    <h1>La page de <?= $nom ?> </h1>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bonjour <?= $nom ?> !</h1>
    
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Titre:<br>
<input name="titolo" type="text"><br />
Texte:<br>
<textarea name="testo" cols="30" rows="10"></textarea><br />
Author: <?= $nom ?> 

<input name="submit" type="submit" value="Envoyer">
</form>
       
       
</body>
</html>
</body>
</html>