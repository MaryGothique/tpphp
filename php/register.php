<?php 
require_once('database.php');

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
        $msg = 'Compila tutti i campi %s';
    } elseif (false === $isUsernameValid) {
        $msg = 'Lo username non è valido. Sono ammessi solamente caratteri 
                alfanumerici e l\'underscore. Lunghezza minina 3 caratteri.
                Lunghezza massima 20 caratteri';
    } elseif ($pwdLenght < 8 || $pwdLenght > 20) {
        $msg = 'Lunghezza minima password 8 caratteri.
                Lunghezza massima 20 caratteri';
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = "
            SELECT id
            FROM users
            WHERE username = :username
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':username', $username, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($user) > 0) {
            $msg = 'Nom utilisé';
        } else {
            $query = "
                INSERT INTO users
                VALUES (0, :name, :mdp)
            ";
        
            $check = $pdo->prepare($query);
            $check->bindParam(':id', $username, PDO::PARAM_STR);
            $check->bindParam(':mdp', $password_hash, PDO::PARAM_STR);
            $check->execute();
            
            if ($check->rowCount() > 0) {
                $msg = 'code bon';
            } else {
                $msg = 'problemes avec les donnees';
            }
        }
    }
    
    printf($msg, '<a href="../register.html">torna indietro</a>');
}
/*echo '<h1>Formulaire Enregistrement</h1>';

if (isset($_POST['ok'])){
    $tab = ['ok' => $_POST];
    $message = '';
    $nom = filter_input(INPUT_POST,'nom', FILTER_SANITIZE_STRING);
   // $nom = filter_input(INPUT_POST,'nom', FILTER_SANITIZE_STRING);
      
    if (!$nom){
        $message.='le nom doit obligatoirement être valide.<br>';
            }
    if(!$message){
        //traitement
        header('location: Utilisateur.php');
        exit();
    }
}
*/
?>

