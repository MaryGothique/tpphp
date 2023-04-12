<?php
echo '<h1>Bienvenue dans la To Do list</h1>';

if(isset($_GET['nom'])){
    
}
if(isset($_POST['nom'])){
   
}
if(isset($_REQUEST['nom'])){
   
}
echo '<h1>Un formulaire HTML</h1>
    <form action="traitementDuFormulaire.php" method="POST">
        <label for="idNom">Nom : </label>
        <input type="text" name="nom" id="idNom"><br>
        
        <label for="idMail">E-Mail : </label>
        <input type="email" name="email" id="idMail"><br>

        <label for="idMotDePasse">Mot de passe : </label>
        <input type="password" name="motDePasse" id="idMotDePasse" required
               title="8 caractères minimum avec majuscule, minuscule et chiffre"
               pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"><br>
        
        <input type="submit" name="ok" value="Valider">
    </form>';