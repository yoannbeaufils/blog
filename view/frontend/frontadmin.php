<link href="/blog/public/css/style.css" rel="stylesheet" />
<div id="frontadmin">
  <p id="tuto">
    <?php if(isset($_SESSION['pseudo'])){
      echo ' Bienvenue '. $_SESSION['pseudo'];} ?>
    <br /><br /><br />
    dans votre<br />
    <span>Tableau de bord:</span><br /><br />(Modération des messages, action sur les chapitres, écriture d'un nouveau chapitre, retour à l'accueil et déconnexion.)
  </p>
    <a id="lienadmin" href="index1.php?action=adminmessage"><input id="btnadmin" name="btn1" type="submit" value="Messages"/></a>
    <a href="index1.php?action=adminchapitre"><input id="btnadmin" name="btn2" type="submit" value="Chapitres"/></a>
    <a href="index1.php?action=ecriturechapitre"><input id="btnadmin" type="button" value="Ecrire"/></a>
    <a href="index1.php"><input id="btnadmin" type="button" value="Accueil"/></a>
    <a href="index1.php?action=deconnexion"><input id="btnadmin" type="button" value="Déconnexion"></a>
<?php
if (isset($comments)){
  while ($data = $comments->fetch())
  {
    echo'<p class="modal"><strong>' . htmlspecialchars($data['author']) . '</strong>' ."   ".
    htmlspecialchars($data['comment'])."   ".'</p>';
  }
}
 ?>
 <?php
 if (isset($posts)){
   while ($data = $posts->fetch())
   {
     echo'<p class="modal"><strong>' . htmlspecialchars($data['id']) . '</strong>' ."   ".
     htmlspecialchars($data['title'])."   ".htmlspecialchars($data['content']) .htmlspecialchars($data['comment_date']) .'</p>';
   }
 }
  ?>
</div>
