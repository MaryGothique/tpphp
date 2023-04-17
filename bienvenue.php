<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Bienvenue <?= $_POST['nom'] ?>! </h1>
<?php
echo 'créez vous votre article! ici';
require_once("classes/Articles.php");
if (isset($_SESSION['session_id'])) {
    header('Location: Articles.php');
    exit;
}
?>
</body>
</html>


