<?php 

echo '<h1>Poster votre article!</h1>';

include_once('../modeles/db_articles.php');
if (isset($_SESSION['session_id'])) {
    header('Location: ../classes/Articles.php');
    exit;
}
/**
 * Création de constante des erreurs possibles
 */

 const ERROR_REQUIRED = 'Veuillez renseigner ce champ';
 const ERROR_PASSWORD_NUMBER_OF_CHARACTERS = 'le mot de passe ne répond pas au nombre de caractère demandé';

/**
 * Traitemet des données si la methode est bien POST
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        'Auteur' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'Titre' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'Texte' => FILTER_SANITIZE_FULL_SPECIAL_CHARS

    ]);
    /**
     * Initialisation des variables qui vont recevoir les datas des champs de formulaire
     */
    $auteur = $_POST['auteur'] ?? '';
    $titre = $_POST['titre'] ?? '';
    $texte = $_POST['texte'] ?? '';

    /**
     * Remplissage du tableau concernant les erreurs possibles  
     */
    /* if (!$nom) {
        $errors['nom'] = ERROR_REQUIRED;
    }

    if (!$passwd) {
        $errors['passwd'] = ERROR_REQUIRED;
    } elseif (mb_strlen($passwd) < 10) {
        $errors['passwd'] = ERROR_PASSWORD_NUMBER_OF_CHARACTERS;
    }
    */
    

    /**
     * Execution de la requête INSERT INTO
     */
    if (($auteur) && ($titre) && ($texte)) {
        /**
         * On vérifie si le login existe dans la table
         */
        $sql = 'SELECT auteur FROM article
        WHERE auteur = :auteur ';
        $db_statement = $db_articles->prepare($sql);
        $db_statement->execute(
            array(
                ':auteur' => $auteur
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
            $rqt = "INSERT INTO articles VALUES (DEFAUlT,:auteur,:titre, :texte)";
            $db_statement = $db_articles->prepare($rqt);
            $db_statement->execute(
                array(
                    ':auteur' => $auteur,
                    ':titre' => $titre,
                    ':texte' => $texte,
                )
            );
            $message = "<span class='Article Ajouté ! </span>";
        } 
    } 
}  

if (isset($_POST['register'])) {
    $auteur = $_POST['username'] ?? '';
    $titre = $_POST['titre'] ??'';
    $texte = $_POST ['textel'] ?? '';
  
    $isArticle = filter_var(
        $auteur, 
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{3,20}$/i"
            ]
        ]
    );

    
    if (empty($auteur) || empty($texte) || empty ($titre)) {
        $msg = 'Riemplir tous les champs';
    } elseif (false === $isArticle) {
        $msg = 'article fait';
    } 

       
        
        $check = $pdo->prepare($query);
        $check->bindParam(':utilisateur', $auteur, PDO::PARAM_STR);
        $check->execute();
        
        $auteur = $check->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($titre) > 0) {

            $msg = 'titre utilisé';
        } else {

            $query = "
                INSERT INTO articles
                VALUES (0, :auteur, :titre, :texte)
            ";
        
            $check = $pdo->prepare($query);
            $check->bindParam(':auteur', $auteur, PDO::PARAM_STR);
            $check->bindParam(':titre', $titre, PDO::PARAM_STR);
            $check->bindParam(':texte', $texte, PDO::PARAM_STR);
            $check->execute();
            
            if ($check->rowCount() > 0) {
                $msg = 'cest bon';
            } else {
                $msg = 'problemes avec les donnees';
            }
        }
    }
    
    printf($msg, '<a href="../register.html">retourner</a>');


?>
<h1>Inserimento post:</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Titolo:<br>
<input name="titolo" type="text"><br />
Testo:<br>
<textarea name="testo" cols="30" rows="10"></textarea><br />
Autore:<br>
<input name="autore" type="text"><br />
<input name="submit" type="submit" value="Scrivi">
</form>

