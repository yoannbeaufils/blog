<link href="../blog/public/css/style.css" rel="stylesheet" />
<link rel="icon" type="image/png" href="../blog/public/image/fadmin.png" />
<div id="frontadmin">
  <p id="tuto">
    <?php if(isset($_SESSION['pseudo'])){
      echo ' Bienvenue '. $_SESSION['pseudo'];} ?>
      <br />
      dans votre<br />
      <span>Tableau de bord:</span><br /><br />(Modération des messages, action sur les chapitres, écriture d'un nouveau chapitre, retour à l'accueil et déconnexion.)
    </p>
    <a id="lienadmin" href="index1.php?action=adminmessage"><input id="btnadmin" name="btn1" type="submit" value="Messages"/></a>
    <a href="index1.php?action=adminchapitre"><input id="btnadmin" name="btn2" type="submit" value="Chapitres"/></a>
    <a href="index1.php?action=ecriturechapitre"><input id="btnadmin" type="button" value="Ecrire"/></a>
    <a href="index1.php"><input id="btnadmin" type="button" value="Accueil"/></a>
    <a href="index1.php?action=deconnexion"><input id="btnadmin" type="button" value="Déconnexion"></a>
    <?php if (isset($comments)):?>
      <?php while ($data = $comments->fetch()):?>
        <p class="modal">
          <?=htmlspecialchars($data['reported']);?></br>
          <?= htmlspecialchars($data['author']);?>
          <?=htmlspecialchars($data['comment']);?>
          <a href="index1.php?action=suppComment&id=<?= $data['id']?>"><input class="btncomment" type="button" id="bouton" value="supprimer"></a></p>
        <?php endwhile; ?>
      <?php endif; ?>
      <?php if (isset($posts)):?>
        <?php while ($data = $posts->fetch()):?>
          <div class="modal">
            <?=htmlspecialchars($data['id'])?>
            <?=htmlspecialchars($data['title'])?></br>
            <?=htmlspecialchars($data['content'])?></br>
            <?=htmlspecialchars($data['creation_date_fr'])?></br>
            <a href="index1.php?action=correction&id=<?=$data['id']?>"><input class="btnchapitre" type="button" id="bouton" value="modifier"></a>
            <a href="index1.php?action=suppPost&id=<?= $data['id']?>"><input class="btnchapitre" type="button" id="bouton" value="supprimer"></a></div></br>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
