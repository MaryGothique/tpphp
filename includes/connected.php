<?php
session_start();
if (isset($_SESSION['user'])) {
    $nom = $_SESSION['user']['nom'];
    //$userId = $_SESSION['userID'];
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
    <title>Ma page</title>
</head>

<body>
    <h1>La page de <?= $nom ?> </h1>
 
</body>
</html>