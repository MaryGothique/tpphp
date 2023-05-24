<?php 
session_start();

include_once('modeles/db_connexion.php');
/**
 * Création de constante des erreurs possibles
 */

 const ERROR_REQUIRED = 'Veuillez renseigner ce champ';
 const ERROR_PASSWORD_NUMBER_OF_CHARACTERS = '';

/**
 * Initialisation d'un tableau contenant les erreurs possibles lors des saisies 
 */

 $errors = [
    'nom' => '',
    'mdp' => '',
];
$message = '';

/**
 * Traitemet des données si la methode est bien POST
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        'nom' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'mdp' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ]);
    

    /**
     * Initialisation des variables qui vont recevoir les datas des champs de formulaire
     */
    $nom = $_POST['nom'] ?? '';
    $mdp = $_POST['mdp'] ?? '';

    /**
     * Remplissage du tableau concernant les erreurs possibles  
     */
    if (!$nom) {
        $errors['nom'] = ERROR_REQUIRED;
    }

    if (!$mdp) {
        $errors['mdp'] = ERROR_REQUIRED;
    } elseif (mb_strlen($mdp) < 10) {
        $errors['mdp'] = ERROR_PASSWORD_NUMBER_OF_CHARACTERS;
    }

    /**
     * Execution de la requête INSERT INTO
     */
    if (($mdp) && ($nom)) {
        /**
         * On vérifie si le login existe dans la table
         */
        $sql = 'SELECT nom FROM utilisateurs
        WHERE nom = :nom '; 
        $db_statement = $db_connexion->prepare($sql);
        $db_statement->execute(
            array(
                ':nom' => $nom

            )
        );

       /**
         * L'execution nous retourne une valeur, si <=0 alors on traite la requête
         */
        $nb = $db_statement->rowCount();
        if ($nb <= 0) {
            /**
             * On insert notre utilisateur
             */
            $sql = "INSERT INTO utilisateurs VALUES (DEFAULT,:nom,:mdp)";
            $db_statement = $db_connexion->prepare($sql);
            $db_statement->execute(
                array(
                    ':nom' => $nom,
                    ':mdp' => password_hash($mdp, PASSWORD_DEFAULT)
                )
            );
            $message = "<span class='message'>compte crée !</span>";

            ///// refaire un select comme dans index
            $rqt = 'SELECT * FROM utilisateurs 
            WHERE nom = :nom'; 
            $db_statement = $db_connexion->prepare($rqt);
            $db_statement->execute(
                array(
                    ':nom' => $nom,
                )
            );
            $data = $db_statement->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $data;
           
            header('location: includes/bienvenue.php');
        } else {
            $message = "<span class='message'>Le login existe déja ! </span>";
        }
    } else {
        $message = "<span class='message'>Veuillez renseigner tous les champs! </span>";
    }
}  


?>

<!-- le formulaire html--> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="container">

<div class="block p-20 form-container">
    <h1>Register</h1>
    <div class="form-control">
        <?= $message ?>
    </div>
    <form action="" method="POST">
        <div class="form-control">

            <input type="text" name="nom" id="nom" placeholder="nom">
            <?= $errors['nom'] ? '<p class="text-error">' . $errors['nom'] . '</p>' : "" ?>

        </div>
        <div class="form-control">

            <input type="text" name="mdp" id="mdp" placeholder="Mot de passe">
            <?= $errors['mdp'] ? '<p class="text-error">' . $errors['mdp'] . '</p>' : "" ?>
        </div>

        <div class="form-control">
            <input type="submit" class="btn btn-primary" value="VALIDER"> 
        </div>

    </form>
   
</div>

</section>
    
</body>
</html>