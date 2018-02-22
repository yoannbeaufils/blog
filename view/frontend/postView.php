<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
    <link href="style.css" rel="stylesheet" />
    </head>
    <body>
        <h1>Mon super blog !</h1>
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
<form action="index1.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>
<?php
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
