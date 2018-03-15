
<?php $title = "billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>
<div class="news">
          <p><a href="index1.php">Retour à la liste des chapitres</a></p>
    <h3>
        <?= htmlspecialchars($post['title']); ?>
        <em>le <?=  $post['creation_date_fr']; ?></em>
    </h3>
    <p>
    <?= nl2br(htmlspecialchars($post['content']));
    ?>
    </p>
</div>
<h2>Commentaires</h2>
<form id="formulaire" method="post" action="index1.php?action=postComment">
    <div id="commentaires">
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div id="commentaires">
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input id="bouton" type="submit" value="Envoyer"/>
    </div>
</form>
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
//récupération des commentaires
$reponse = $bdd->query('SELECT author, comment FROM comments ORDER BY ID DESC LIMIT 0, 10');

// Affichage de chaque commentaire (toutes les données sont protégées par htmlspecialchars)
while ($data = $comments->fetch())
{

echo'<p><strong>' . htmlspecialchars($data['author']) . '</strong>' .
htmlspecialchars($data['comment']). '</p>';
}
$comments->closeCursor();
?>
</body>
</html>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php');?>
