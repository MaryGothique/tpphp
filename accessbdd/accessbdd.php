<?php
{
    $dsn = "mysql:host=localhost;dbnale = utilisateur";
    $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
    $pdo = new PDO  ($sdn, 'root','',$options);
    $pdo-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRORMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DRIVER_NAME).'<br>';
    }
    catch(PDOException $e){
    $msg = 'ERREUR PDO DANS' .$e ->getFile().':<br>';
    $e->getLine().':<br>' .$e->getmessage();
    die($msg);
}
