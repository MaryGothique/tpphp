<?php
session_start(); // la page de bienvenue pour les nouvevau arrivés
if (isset($_SESSION['user'])) {
    $nom = $_SESSION['user']['nom'];
    
} else {
    header('location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenue <?= $nom ?> !</h1>
    <h2>Créez votre prémier article ici</h2>
    
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Titre:<br>
<input name="titolo" type="text"><br />
Texte:<br>
<textarea name="testo" cols="30" rows="10"></textarea><br />
Author: <?= $nom ?> <br>

<input name="submit" type="submit" value="Envoyer">
</form>
       
</body>
</html>


