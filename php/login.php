<?php 
session_start();
require_once('database.php');

if (isset($_SESSION['session_id'])) {
    header('Location: connected.php');
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $msg = 'Inserisci username e password %s';
    } else {
        $query = "
            SELECT username, password
            FROM users
            WHERE username = :username
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':username', $username, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || password_verify($password, $user['password']) === false) {
            $msg = 'Credenziali utente errate %s';
        } else {
            session_regenerate_id();
            $_SESSION['session_id'] = session_id();
            $_SESSION['session_user'] = $user['username'];
            
            header('Location: dashboard.php');
            exit;
        }
    }
    
    printf($msg, '<a href="../login.html">torna indietro</a>');
}


//Si l'utilisateur est enregistré il faut faire simplement l'access, sinon il faut l'enregistrer
/*
echo '<h1> Welcome!</h1>';

if (isset($_POST['ok'])){
    $tab = ['ok' => $_POST];
    $message = '';
    $nom = filter_input(INPUT_POST,'nom', FILTER_SANITIZE_STRING);
    // dans une variable stocker le mot de pass que etait ecrit dans le formulaire
//ouvrir une connexion vers la bdd
// preparer une requete parametre et nommee 
// attacher mes parametres (bindparam)
// executer ma requete(soit la requete as functionne et il la redige en "connected" si ne marche pas prevenir l 'utilisateur)

    if (!$nom){
        $message.='le nom doit obligatoirement être valide.<br>';
            }
            //un autre pour le mot de passe
            $mdp = filter_input(INPUT_POST,'mdp', FILTER_SANITIZE_STRING);
    if(!$mdp){
        $message.'Enregistrez vous';
    }
 /*   if(!$message){
        //traitement
        header('location: connected.php');
        exit();
    }*/


