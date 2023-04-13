<?php 

echo '<h1>Formulaire Enregistrement</h1>';

if (isset($_POST['ok'])){
    $tab = ['ok' => $_POST];
    $message = '';
    $nom = filter_input(INPUT_POST,'nom', FILTER_SANITIZE_STRING);
   // $nom = filter_input(INPUT_POST,'nom', FILTER_SANITIZE_STRING);
      
    if (!$nom){
        $message.='le nom doit obligatoirement être valide.<br>';
            }
    if(!$message){
        //traitement
        header('location: Utilisateur.php');
        exit();
    }
}

?>

<form action="" method="POST" enctype="multipart/form-data">

<label for="idNom">Nom :</label>
<input id="idNom" type="text" name='nom' <?= isset($nom) ? 'value="'.$nom.'"':''?>>
<br>
<label for="idPrenom">Prenoom :</label>
<input id="idPrenom" type="text" name='Prenom' <?= isset($prenom) ? 'value="'.$prenom.'"':''?>>
<br>

        <label for="idMail">E-Mail : </label>
        <input type="email" name="email" id="idMail"><br>

        <label for="idMotDePasse">Mot de passe : </label>
        <input type="password" name="motDePasse" id="idMotDePasse" required
               title="8 caractÃ¨res minimum avec majuscule, minuscule et chiffre"
               pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"><br>

<input type="submit" name="enregistrer" value="enregistrer">
</form>