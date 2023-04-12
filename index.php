<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Un formulaire HTML</title>
</head>
<body>
    <h1>Un formulaire HTML</h1>
    <form action="traitementDuFormulaire.php" method="POST">
        <label for="idNom">Nom : </label>
        <input type="text" name="nom" id="idNom"><br>
        
        <label for="idAge">Age : </label>
        <input type="number" name="age" id="idAge"><br>

        <label for="idMail">E-Mail : </label>
        <input type="email" name="email" id="idMail"><br>

        <label for="idMotDePasse">Mot de passe : </label>
        <input type="password" name="motDePasse" id="idMotDePasse" required
               title="8 caractères minimum avec majuscule, minuscule et chiffre"
               pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"><br>
        
        <input type="submit" name="ok" value="Valider">
    </form>


    

</body>
</html>