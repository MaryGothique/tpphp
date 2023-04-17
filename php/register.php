<?php 
//quand je m' enregistre ne registre pas dans la base de données
echo '<h1>Enregistrez vous!</h1>';

require_once('database.php');
if (isset($_SESSION['session_id'])) {
    header('Location: bienvenue.php');
    exit;
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
            FROM users
            WHERE username = :username
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':username', $id, PDO::PARAM_STR);
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

