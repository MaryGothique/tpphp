<?php #balise php
session_start();  #overture de session

$erreur = "";

if (isset($valider)) { #si le code c'est le même de l'inscription alor je me peux me connecter
    if ($nom == $bonLogin && $mdp == $bonPass) {
        $_SESSION["autoriser"] = "oui";
        header("location:connected.php"); # et du coup je me retrouve dans la page "connected"
    } else # sinon
        $erreur = "Mauvais login ou mot de passe!"; #j'ai ce message
}

//pour la registration des articles
include_once('modeles/db_articles.php');

const ERROR_REQUIRED = 'Veuillez riemplire tous ces champs!';


/**
 * Initialisation d'un tableau contenant les erreurs possibles lors des saisies 
 */

 $errors = [
    'titre' => '',
    'texte' => '',
];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        'titre' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'texte' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ]);
    
/**
     * Initialisation des variables qui vont recevoir les datas des champs de formulaire
     */
    $titre = $_POST['texte'] ?? '';
    $texte = $_POST['texte'] ?? '';

    if (($titre) && ($texte)) {
        /**
         * On vérifie si l' article existe dans la table
         */
        $sql = 'SELECT titre FROM articles
        WHERE titre = :titre '; 
        $db_statement = $db_articles->prepare($sql);
        $db_statement->execute(
            array(
                ':titre' => $titre

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
            $sql = "INSERT INTO articles VALUES (DEFAULT,:titre,:article)";
            $db_statement = $db_articles->prepare($sql);
            $db_statement->execute(
                array(
                    ':titre' => $titre,
                    ':texte' => $texte
                )
            );
            $message = "<span class='message'>Article crée!</span>";

            ///// refaire un select comme dans index
            $rqt = 'SELECT * FROM articles 
            WHERE titre = :titre'; 
            $db_statement = $db_articles->prepare($rqt);
            $db_statement->execute(
                array(
                    ':titre' => $titre,
                )
            );
            $data = $db_statement->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $data; #au lieu de 'id' je ne sais pas quoi mettre
           
            header('location: includes/dashboard.php');
        } else {
            $message = "<span class='message'>Le l'article existe déja ! </span>";
        }
    } else {
        $message = "<span class='message'>Veuillez renseigner tous les champs! </span>";
    }
}  




?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
 
    <style>
       
    </style>
</head>

<body>
    <h1>Authentification</h1> 
    <!-- l' html du formulaire-->
    <div class="erreur"><?php echo $erreur ?></div>
    <form name="nom" method="post" action="">
        <input type="text" name="nom" placeholder="nom" /><br />
        <input type="mdp" name="pass" placeholder="Mot de passe" /><br />
        <input type="submit" name="valider" value="S'authentifier" />
    </form>
</body>

</html>
