<?php
session_start(); // On démarre la session AVANT toute chose
?>
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
    //action d'inscription
    elseif ($_GET['action'] == 'inscription'){
        inscription();
    }
    //action de connexion
    elseif ($_GET['action'] == 'postconnexion'){
        postconnexion();
    }
    //action d'inscription
    elseif ($_GET['action'] == 'postinscription'){
        postinscription();
    }
    //action de deconnexion
    elseif ($_GET['action'] == 'deconnexion') {
      deconnexion();
    }
    //action de poster les commenatires
    elseif ($_GET['action'] == 'postComment') {
      if (isset($_POST['author']) && isset( $_POST['comment']) && isset($_GET['id'])){
        if (!empty($_POST['author']) && !empty($_POST['comment']))
         {
          postComment( $_POST['author'], $_POST['comment'], $_GET['id']);
        }
        else {
          throw new Exception ('tous les champs ne sont pas remplis');
        }
      }
    }
  }
  else {
    listPosts();
  }
}
catch(Exception $e){
  echo 'erreur'.$e->getMessage();
}
?>
