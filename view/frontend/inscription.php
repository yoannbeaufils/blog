
<link href="public/css/style.css" rel="stylesheet" />
<div id="pageinscription">
  <form method="post" id="inscription">
    <label>Pseudo: <input type="text" name="pseudo"/></label><br/>
    <label>Mot de passe: <input type="password" name="passe"/></label><br/>
    <label>Confirmation du mot de passe: <input type="password" name="passe2"/></label><br/>
    <label>Adresse e-mail: <input type="text" name="email"/></label><br/>
    <input id="submit" type="submit" value="inscription"/>
  </form>
</div>
<?php
// on teste si le visiteur a soumis le formulaire
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription') {
  // on teste l'existence de nos variables. On teste également si elles ne sont pas vides
  if ((isset($_POST['pseudo']) && !empty($_POST['pseudo'])) && (isset($_POST['passe']) && !empty($_POST['passe'])) && (isset($_POST['passe2']) && !empty($_POST['passe2']))) {
    // on teste les deux mots de passe
    if ($_POST['passe'] != $_POST['passe2']) {
      $erreur = 'Les 2 mots de passe sont différents.';
    }
    else {
      $base = mysql_connect ('localhost', 'root', '');
      mysql_select_db ('blog.php', $base);

      // on recherche si ce login est déjà utilisé par un autre membre
      $sql = 'SELECT count(*) FROM validation WHERE pseudo="'.mysql_escape_string($_POST['pseudo']).'"';
      $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
      $data = mysql_fetch_array($req);

      if ($data[0] == 0) {
        $sql = 'INSERT INTO validation VALUES("", "'.mysql_escape_string($_POST['pseudo']).'", "'.mysql_escape_string(md5($_POST['passe'])).'")';
        mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

        session_start();
        $_SESSION['pseudo'] = $_POST['pseudo'];
        header("Location: index1.php");;
      }
      else {
        $erreur = 'Un membre possède déjà ce login.';
      }
    }
  }
  else {
    $erreur = 'Au moins un des champs est vide.';
  }
}
?>
<?php
if (isset($erreur)) echo '<br />',$erreur;
?>

<div id="pageconnexion">
  <form method="post" id="connexion">
    <label>Pseudo: <input type="text" name="pseudo"/></label><br/>
    <label>Mot de passe: <input type="password" name="passe"/></label><br/>
    <input id="submit" type="submit" value="connexion"/>
  </form>
</div>

<?php require('view/frontend/footer.php') ?>
