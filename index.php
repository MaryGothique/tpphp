<?php 
session_start();
include_once("modeles/db_connexion.php");

/**
 * les erreurs possible avec les constantes
 */
const ERROR_REQUIRED = 'Renseigner le champ';
const ERROR_PASSWORD_NUMBER_OF_CHARACTERS = 'le mot de passe n\'est pas bon';

/**
 * faire un tableau avec les erreurs possibles
 */

 $errors = [
    'nom' => '',
    'mdp'=>'',
 ];
 $message = '';

 /**
  * traitement des données si la methode est POST
  */
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_POST = filter_input_array(INPUT_POST, [
        'nom' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'mdp' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

    ]);

    /**
     * les variables qui vont recevoir les données du champs de formulaire
     */
    $nom = $_POST['nom'] ?? '';
    $mdp = $_POST['mdp'] ?? '';

    /**
     * tableau avec les erreurs possible
     */
    if(!$nom){
        $errors['nom']= ERROR_REQUIRED;
    }

    if(!$mdp){
        $errors['mdp'] = ERROR_REQUIRED;
    }elseif(strlen($mdp) < 10 ){
        $errors['mdp'] = ERROR_PASSWORD_NUMBER_OF_CHARACTERS;

    }

    //execution de la requête INSERT INTO
    if (!empty($mdp) || !empty($nom)) {
        //on verifie si le login et le mot de passe existent (requête sql)
    
    $rqt = 'SELECT * FROM utilisateurs 
    WHERE nom = :nom'; 
    $db_statement = $db_connexion->prepare($rqt);
    $db_statement->execute(
        array(
            ':nom' => $nom,
        )
    );
    
    /**
     * on execute une requête pour un tableau associatif
     */
    $data = $db_statement->fetch(PDO::FETCH_ASSOC);
    if (password_verify($mdp, $data['mdp'])) {         
        $_SESSION['user'] = $data;
        header('Location: includes/connected.php');
    } else {
        $message = "<span class ='message'>Mot de passe incorrecte</span>";
    } 
}else{
    $message = "<span class='message'Utiliser tous les champs!></span>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    
    <link rel="stylesheet" href="styles/index.css" />
    <title>Accés à votre compte</title>

</head>

<body>
    <section class="navbar">

        <div class="block p-20 form-container">
            <h1>Forum</h1>

            <h2>Access</h2>
            <div class="form-control">
                <?= $message ?>
            </div>
            <form action="#" method="POST">
                <div class="form-control">

                    <input type="text" name="nom" id="login" placeholder="Login">
                    <?= $errors['nom'] ? '<p class="text-error">' . $errors['nom'] . '</p>' : "" ?>

                </div>
                <div class="form-control">

                    <input type="password" name="mdp" id="mdp" placeholder="Mot de passe">
                    <?= $errors['mdp'] ? '<p class="text-error">' . $errors['mdp'] . '</p>' : "" ?>
                </div>

                <div class="form-control">
                    <input type="submit" class="btn btn-primary" value="VALIDER">
                </div>

            </form>
            <a href="register.php">Créer votre compte</a>
        </div>

    </section>
</body>

</html>





