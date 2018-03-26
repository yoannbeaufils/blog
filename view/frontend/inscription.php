<link rel="icon" type="image/png" href="../blog/public/image/icon.jpg" />
<link href="public/css/style.css" rel="stylesheet" />
<div id="pageinscription">
  <form method="post" id="inscription" action="index1.php?action=postinscription">
    <label>Pseudo: <input type="text" name="pseudo"/></label><br/>
    <label>Mot de passe: <input type="password" name="passe"/></label><br/>
    <label>Confirmation du mot de passe: <input type="password" name="passe2"/></label><br/>
    <label>Adresse e-mail: <input type="text" name="email"/></label><br/>
    <input id="submit" type="submit" value="inscription"/>
  </form>
</div>
<div id="pageconnexion">
  <form method="post" id="connexion" action="index1.php?action=postconnexion">
    <label>Pseudo: <input type="text" name="pseudo"/></label><br/>
    <label>Mot de passe: <input type="password" name="passe"/></label><br/>
    <input id="submit" type="submit" value="connexion"/>
  </form>
</div>
<?php require('view/frontend/footer.php') ?>
