<?php
/**
 * Création d'une instance PDO pour se connecter à tpphp
 */
require_once 'modeles/db_articles.php';


$dsn = "mysql:host=localhost;dbname=tpphp;charset=utf8";
$user = "root";
$password = "root";

try {
    $db_article = new PDO($titre, $article, $auteur);
    $db_article->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
    $db_article->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db_article->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "article publié";
} catch (PDOException $e) {
    echo "Riemplir tous les champs<br/>";
}

