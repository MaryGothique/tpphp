<?php 

echo '<h1>Enregistrez vous!</h1>';

include_once('../modeles/db_connexion.php');
if (isset($_SESSION['session_id'])) {
    header('Location: bienvenue.php');
    exit;
}
/**
 * Création de constante des erreurs possibles
 */

 const ERROR_REQUIRED = 'Veuillez renseigner ce champ';
 const ERROR_PASSWORD_NUMBER_OF_CHARACTERS = 'le mot de passe ne répond pas au nombre de caractère demandé';

/**
 * Initialisation d'un tableau contenant les erreurs possibles lors des saisies 
 */

 $errors = [
    'nom' => '',
    'passwd' => '',
];
$message = '';

/**
 * Traitemet des données si la methode est bien POST
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        'nom' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'passwd' => FILTER_SANITIZE_FULL_SPECIAL_CHARS

    ]);
    /**
     * Initialisation des variables qui vont recevoir les datas des champs de formulaire
     */
    $nom = $_POST['nom'] ?? '';
    $passwd = $_POST['passwd'] ?? '';

    /**
     * Remplissage du tableau concernant les erreurs possibles  
     */
    if (!$nom) {
        $errors['nom'] = ERROR_REQUIRED;
    }

    if (!$passwd) {
        $errors['passwd'] = ERROR_REQUIRED;
    } elseif (mb_strlen($passwd) < 10) {
        $errors['passwd'] = ERROR_PASSWORD_NUMBER_OF_CHARACTERS;
    }

    /**
     * Execution de la requête INSERT INTO
     */
    if (($passwd) && ($nom)) {
        /**
         * On vérifie si le login existe dans la table
         */
        $sql = 'SELECT nom FROM utilisateur
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
            $rqt = "INSERT INTO utilisateur VALUES (DEFAUlT,:nom,:passwd)";
            $db_statement = $db_connexion->prepare($rqt);
            $db_statement->execute(
                array(
                    ':nom' => $nom,
                    ':passwd' => password_hash($passwd, PASSWORD_DEFAULT)
                )
            );
            $message = "<span class='message'>Votre compte est crée ! </span>";
        } else {
            $message = "<span class='message'>Le login existe déja ! </span>";
        }
    } else {
        $message = "<span class='message'>Veuillez renseigner tous les champs! </span>";
    }
}  

if (isset($_POST['register'])) {
    $id = $_POST['username'] ?? '';
    $nom = $_POST['nom'] ??'';
    $mail = $_POST ['email'] ?? '';
    $mdp = $_POST['password'] ?? '';
    $isUsernameValid = filter_var(
        $id, 
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{3,20}$/i"
            ]
        ]
    );
    $pwdLenght = mb_strlen($mdp);
    
    if (empty($username) || empty($mdp)) {
        $msg = 'Riemplir tous les champs';
    } elseif (false === $isUsernameValid) {
        $msg = '
                le username ne est pas valide: ils sont accepte seulement des characteres
                alphanumeriques et l underschores, minimum 3 characteres';
    } elseif ($pwdLenght < 8 || $pwdLenght > 20) {
        $msg = 'Longeur minimum 8 characteres.
                maximum 20 characteres';
    } else {
        $password_hash = password_hash($mdp, PASSWORD_BCRYPT);

        $query = "
            SELECT id
            FROM utilisateur
            WHERE username = :username
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':utilisateur', $id, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($user) > 0) {

            $msg = 'Nom utilisé';
        } else {

            $query = "
                INSERT INTO utilisateyr
                VALUES (0, :name, :mdp)
            ";
        
            $check = $pdo->prepare($query);
            $check->bindParam(':id', $id, PDO::PARAM_STR);
            $check->bindParam(':mdp', $password_hash, PDO::PARAM_STR);
            $check->execute();
            
            if ($check->rowCount() > 0) {
                $msg = 'code bon';
            } else {
                $msg = 'problemes avec les donnees';
            }
        }
    }
    
    printf($msg, '<a href="../register.html">retourner</a>');
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

            <input type="text" name="passwd" id="passwd" placeholder="Mot de passe">
            <?= $errors['passwd'] ? '<p class="text-error">' . $errors['passwd'] . '</p>' : "" ?>
        </div>

        <div class="form-control">
            <input type="submit" class="btn btn-primary" value="VALIDER">
        </div>

    </form>
    <a href="../php/login.php"> Accés à votre compte</a>
</div>

</section>
    
</body>
</html>