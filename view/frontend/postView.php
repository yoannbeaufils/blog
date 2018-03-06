<?php $title = "Mon blog"; ?>
<?php ob_start(); ?>
        <p><a href="index1.php">Retour à la liste des billets</a></p>
<div class="news">
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
<form id="formulaire"action="enregistrementetredirection.php" method="post">
    <div id="commentaires">
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div id="commentaires">
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" value="Envoyer"/>
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
//récupération des messages
$reponse = $bdd->query('SELECT author, comment FROM blog.php ORDER BY ID DESC LIMIT 0, 10');

// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($comment = $comments->fetch())
{
?>
<p><strong><?= htmlspecialchars($comment['author']); ?></strong> le <?=  $comment['comment_date_fr']; ?></p>
<p><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>
<?php
}
?>
</body>
</html>
<
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php');?>
