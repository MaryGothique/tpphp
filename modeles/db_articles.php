<?php
$dsn = "mysql:host=localhost;dbname=tpphp;charset=utf8";
$user = "root";
$password = "root";

try {
    $db_articles = new PDO($dsn, $user, $password);
    $db_articles->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
    $db_articles->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db_articles->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Controlla se il form è stato inviato
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Controlla se i campi del form sono stati compilati
        if (!empty($_POST['titre']) && !empty($_POST['article']) && !empty($_POST['auteur'])) {
            // Prendi i valori dal form
            $titre = $_POST['titre'];
            $article = $_POST['article'];
            $auteur = $_POST['auteur'];

            // Prepara la query di inserimento
            $query = "INSERT INTO articles (titre, article, auteur) VALUES (:titre, :article, :auteur)";

            // Esegui la query con i valori parametrizzati
            $stmt = $db_articles->prepare($query);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':article', $article);
            $stmt->bindParam(':auteur', $auteur);
            $stmt->execute();

            echo "Articolo pubblicato con successo.";
        } else {
            echo "Riempi tutti i campi del form.";
        }
    }
} catch (PDOException $e) {
    echo "Errore durante la connessione al database: " . $e->getMessage();
}
?>
