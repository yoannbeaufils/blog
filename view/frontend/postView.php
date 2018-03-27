
<?php $title = "billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>
<div class="news">
  <p><a href="index1.php">Retour à la liste des chapitres</a></p>
  <h3>
    <?= htmlspecialchars($post['title']); ?>
    <em>le <?=  $post['creation_date_fr']; ?></em>
  </h3>
  <p>
    <?=($post['content']);
    ?>
  </p>
</div>
<h2>Commentaires</h2>
<form id="formulaire" method="post" action="index1.php?action=postComment&id=<?= $post['id']?>">
  <div id="commentaires">
    <br />
    <input hidden type="text" id="author" name="author" value="<?php echo $_SESSION['pseudo'];?>">
  </div>
  <div id="commentaires">
    <label for="comment">Commentaire</label><br />
    <textarea id="comment" name="comment"></textarea>
  </div>
  <div>
    <input class="bouton" type="submit" value="Envoyer"/>
  </div>
</form>
<?php
// Connexion à la base de données
try
{
  $bdd = new PDO('mysql:host=localhost;dbname=gretaxao_yoannbp4;charset=utf8', 'gretaxao_yoannb', 'yoannb2017');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}
//récupération des commentaires
$reponse = $bdd->query('SELECT author, comment FROM comments ORDER BY ID DESC LIMIT 0, 10');
// Affichage de chaque commentaire (toutes les données sont protégées par htmlspecialchars)
while ($data = $comments->fetch()):?>
<p><strong><?=htmlspecialchars($data['author']);?></strong>:<?=htmlspecialchars($data['comment']);?></p>
<form id="formulaire" method="post" action="index1.php?action=signal&id=<?= $data['id']?>">
  <input hidden value="<?=$data['id']?>" name="idcomment"/>
  <input id="signal" type="submit" name="reportcomment" value="signaler">
</form>
<?php endwhile; ?>
<?php
$comments->closeCursor();
?>
</body>
</html>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php');?>
