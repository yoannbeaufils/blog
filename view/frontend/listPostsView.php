
<?php $title = "Mon blog"; ?>
<?php ob_start();?><!--enclenche la temporisation de sortie-->
<p id="bienvenue">
 <img src="public/image/favicon.jpg" alt="iconmembre" />
<?php if(isset($_SESSION['pseudo'])){
  echo ' Bienvenue '. $_SESSION['pseudo'];} ?>
</p>
<h2>Les Derniers Chapitres :</h2>
<!--recuperation des valeurs sql-->
<?php
while ($data = $posts->fetch())
{
  ?>
  <div class="news">
    <h3>
      <?=  htmlspecialchars($data['title']); ?><!--recuperation du titre-->
      <em>le <?= $data['creation_date_fr']; ?></em><!--recuperation de la date de crea-->
    </h3>
    <img class="imagechapitre" alt="<?=  htmlspecialchars($data['image_post']); ?>" src="public/image/<?=  htmlspecialchars($data['image_post']); ?>"><!--recuperation de l'image-->
    <p>
      <?=
    substr(strip_tags($data['content']),0,300);
      ?>...<!--recuperation du contenu-->
      <br /><!--action de redirection vers le chapitre entier-->
      <em><a href="index1.php?action=post&id=<?= $data['id'] ?>">Lire ce chapitre</a></em>
    </p>
  </div>
  <?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?><!--Lit le contenu courant du tampon de sortie puis l'efface-->
<!--mise en place du template-->
<?php require('view/frontend/template.php');?>
