
<?php $title = "Mon blog"; ?>
<?php ob_start();?>

<h2>Les Derniers Chapitres :</h2>
<?php
while ($data = $posts->fetch())
{
  ?>
  <div class="news">
    <h3>
      <?=  htmlspecialchars($data['title']); ?>
      <em>le <?= $data['creation_date_fr']; ?></em>
    </h3>
    <img id="imagechapitre" alt="<?=  htmlspecialchars($data['image_post']); ?>" src="public/image/<?=  htmlspecialchars($data['image_post']); ?>">
    <p>
      <?=
      nl2br(htmlspecialchars($data['content']));
      ?>
      <br />
      <em><a href="index1.php?action=post&id=<?= $data['id'] ?>">Lire ce chapitre</a></em>
    </p>
  </div>
  <?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php');?>
