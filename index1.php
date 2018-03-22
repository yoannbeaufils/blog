<?php
session_start(); // On démarre la session AVANT toute chose
?>
<?php
require('controller/controller.php');
try{
//affichage de la liste des chapitres
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
      listPosts();
    }
    elseif ($_GET['action'] == 'post') {
      if (isset($_GET['id']) && $_GET['id'] > 0)
       {
        post();
      }
      else {
        echo 'Erreur : aucun identifiant de billet envoyé';
      }
    }
    //action de redirection vers frontadmin
    elseif ($_GET['action'] == 'ecriturechapitre'){
      require('view/frontend/admin.php');
    }
    //action btn1 recuperation des commentaires signalé
    elseif ($_GET['action'] == 'adminmessage'){
        getComments();
    }
    //action btn2 recuperation des chapitres par l'admin
    elseif ($_GET['action'] == 'adminchapitre'){
        getPosts();
    }
    // action de modification ou suppression des chapitres par l'admin
    //renvoi le chapitre a modifier ou supprimer sur textarea
    elseif ($_GET['action'] == 'correction')
    {
          if (isset($_GET['id']) && $_GET['id'])
          {
          correction();
        }
    }
    //action de suppression des commentaires par l'admin
    elseif ($_GET['action'] == 'suppComment'){
      //tester que id existe bien avec isset
      suppComment($_GET['id']);
    }
    //action de suppression des chapitres par l'admin
    elseif ($_GET['action'] == 'suppPost'){
      //tester que id existe bien avec isset
      suppPost($_GET['id']);
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
    //action de post dans la base de donnees du dernier chapitre
    elseif ($_GET['action'] == 'postchapter') {
    if (isset($_POST['title']) && isset($_POST['content']))
    {
     postChapter( $_POST['title'], $_POST['content']);
   }
   else {
     throw new Exception ('saisie incorrecte');
   }
 }
    //action de poster les commenatires sur postview
    elseif ($_GET['action'] == 'postComment') {
      if (isset($_POST['author']) && isset( $_POST['comment']) && isset($_GET['id']))
      {
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
