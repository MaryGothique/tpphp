<?php
session_start();
if (isset($_SESSION['user'])) {
    $nom = $_SESSION['user']['nom'];
    
} else {
    header('location: ../index.php');
}

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
    <a href="classes/Articles.php">Créer votre Article</a>
 
</body>
</html>