<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css" >


    <title>TP PHP</title>
</head> 
<h1>Tp php</h1>
<h2>To do list</h2>
<!--liste home-->
    <nav>
        <ul>
            <li class="logo" ><a href="index.php"> <img href="image/cuore.jpg"></a></li>
            <li><a href="login.html">LogIn</a></li>
            <li><a href="register.html">Register </a></li>
            <li>Articles</li>
            <li>To Do List</li>

        </ul>
    </nav>
    <!--Si l'utilisateur est enregistré il faut faire simplement la connection, sinon il faut l'enregistrer-->
    <?php
    $id = "";
    $nom = "";
    $mdp = "";

    $query = 'INSERT INTO utilisateur(id, nom, mdp)VALUES(:id, :nom, :mdp);';
?>
</body>
</html>