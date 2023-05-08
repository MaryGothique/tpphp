<?php
session_start();
$nom= $_POST["nom"];
$mdp = $_POST["mdp"];
$valider = $_POST["valider"];
$bonLogin = "utilisateur";
$bonPass = "";
$erreur = "";
if (isset($valider)) {
    if ($nom == $bonLogin && $mdp == $bonPass) {
        $_SESSION["autoriser"] = "oui";
        header("location:connected.php");
    } else
        $erreur = "Mauvais login ou mot de passe!";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
 
    <style>
       
    </style>
</head>

<body onLoad="document.fo.login.focus()">
    <h1>Authentification</h1>
    <div class="erreur"><?php echo $erreur ?></div>
    <form name="nom" method="post" action="">
        <input type="text" name="nom" placeholder="nom" /><br />
        <input type="mdp" name="pass" placeholder="Mot de passe" /><br />
        <input type="submit" name="valider" value="S'authentifier" />
    </form>
</body>

</html>
