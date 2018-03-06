<?php
require('controller/controller.php');
try{
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
      listPosts();
    }
    elseif ($_GET['action'] == 'post') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        post();
      }
      else {
        echo 'Erreur : aucun identifiant de billet envoyé';
      }

    }
    elseif(isset($_GET['action'])) {
      if ($_GET['action'] == 'inscription') {
        inscription();
      }
    }
    elseif ($_GET['action'] == 'addComment') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
          addComment($_GET['id'], $_POST['author'], $_POST['comment']);
        }
        else {
          echo 'Erreur : tous les champs ne sont pas remplis !';
        }
      }
      else {
        echo 'Erreur : aucun identifiant de billet envoyé';
      }
    }
  }
  else {
    listPosts();
  }
}
catch(Exception $e){
  echo 'Erreur :'.$e->getMessage();
}
// on teste si le visiteur a soumis le formulaire de connexion
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
   if ((isset($_POST['pseudo']) && !empty($_POST['pseudo'])) && (isset($_POST['passe']) && !empty($_POST['passe']))) {

      $base = mysql_connect ('localhost', 'root', '');
      mysql_select_db ('blog.php', $base);

      // on teste si une entrée de la base contient ce couple login / pass
      $sql = 'SELECT count(*) FROM membre WHERE pseudo="'.mysql_escape_string($_POST['pseudo']).'" AND passe2="'.mysql_escape_string(md5($_POST['passe'])).'"';
      $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
      $data = mysql_fetch_array($req);

      mysql_free_result($req);
      mysql_close();

      // si on obtient une réponse, alors l'utilisateur est un membre
      if ($data[0] == 1) {
         session_start();
         $_SESSION['pseudo'] = $_POST['pseudo'];
         header('Location: membre.php');
         exit();
      }
      // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
      elseif ($data[0] == 0) {
         $erreur = 'Compte non reconnu.';
      }
      // sinon, alors la, il y a un gros problème
      else {
         $erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
      }
   }
   else {
      $erreur = 'Au moins un des champs est vide.';
   }
}
