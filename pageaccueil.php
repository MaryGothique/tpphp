
<?php 
//Si l'utilisateur est enregistré il faut faire simplement l'access, sinon il faut l'enregistrer

echo '<h1> Welcome!</h1>';

if (isset($_POST['ok'])){
    $tab = ['ok' => $_POST];
    $message = '';
    $nom = filter_input(INPUT_POST,'nom', FILTER_SANITIZE_STRING);
    // dans une variable stocker le mot de pass que etait ecrit dans le formulaire
//ouvrir une connexion vers la bdd
// preparer une requete parametre et nommee 
// attacher mes parametres (bindparam)
// executer ma requete(soit la requete as functionne et il la redige en "connected" si ne marche pas prevenir l 'utilisateur)
    $mdp = filter_input(INPUT_POST,'motDePasse',FILTER_SANITIZE_STRING);
    if (!$nom){
        $message.='le nom doit obligatoirement être valide.<br>';
            }
    if(!$mdp){
        $message.="Tu as de besoin d'être enregistré";
    }
 /*   if(!$message){
        //traitement
        header('location: connected.php');
        exit();
    }*/
}

?>

<form action="connected.php" method="POST" enctype="multipart/form-data">

<label for="idNom">alias:</label>
<input id="idNom" type="text" name='nom' required>
<br>


        <label for="idMotDePasse">Mot de passe : </label>
        <input type="password" name="motDePasse" id="idMotDePasse" required
               title="6 caractÃ¨res minimum"
               pattern="(?=.*[a-z])(?=.*\d).{6,}"><br>

<input type="submit" name="ok" value="ok">
</form>
