<?php
// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=blog.php;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO blog.php(author, comment) VALUES(?, ?)');
$req->execute(array($_POST['author'], $_POST['comment']));
// Redirection du visiteur vers la page du minichat
header('Location:postView.php');
?>
