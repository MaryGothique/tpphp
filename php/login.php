<?php
//la partie que j'ai fait avec les tuto
echo '<h1>Log in</h1>';
session_start();
require_once('database.php');

if (isset($_SESSION['session_id'])) {
    header('Location: connected.php');
    exit;
}

if (isset($_POST['login'])) {
    $id = $_POST['username'] ?? '';
    $mdp = $_POST['password'] ?? '';
    
    if (empty($id) || empty($mdp)) {
        $msg = 'id et mdp, s\'il te plait!';
    } else {
        $query = "
            SELECT username, password
            FROM users
            WHERE username = :username
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':username', $id, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || password_verify($mdp, $user['password']) === false) {
            $msg = 'n\'est pas bon';
        } else {
            session_regenerate_id();
            $_SESSION['session_id'] = session_id();
            $_SESSION['session_user'] = $user['username'];
            
            header('Location: connected.php');
            exit;
        }
    }
    
    printf($msg, '<a href="../login.html">torna indietro</a>');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    
    <h1>Login</h1>
    <form action="connected.php" method="POST" enctype="multipart/form-data">

        <label for="idNom">alias:</label>
        <input id="idNom" type="text" name='nom' required>
        <br>
        
        
                <label for="idMotDePasse">Mot de passe : </label>
                <input type="password" name="motDePasse" id="idMotDePasse" required
                       title="8 caractÃ¨res minimum avec majuscule, minuscule et chiffre"
                       pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"><br>
        
        <input type="submit" name="ok" value="ok">
        </form>
       
           
</body>
</html>

