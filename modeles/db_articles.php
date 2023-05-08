<?php

/**
 * Création d'une instance PDO pour se connecter à tpphp
 */

$dsn = "mysql:host=localhost;dbname=tpphp;charset=utf8";
$auteur = "root";
$titre = "root";
$texte = "root";
try {
    $db_articles = new PDO($dsn, $auteur, $titre, $texte);
    $db_articles->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
    $db_articles->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db_articles->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connection ouvertes";
} catch (PDOException $e) {
    echo "Impossible d'accéder à la base de données<br/>";
}