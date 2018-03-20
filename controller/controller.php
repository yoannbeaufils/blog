<?php
// Chargement des classes
require_once('model/postManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');
//fonction d'affichage des chapitres
function listPosts()
{
  $postManager = new postManager();
  $posts = $postManager->getPosts();
  require('view/frontend/listPostsView.php');
}
//fonction d'un chapitre
function post()
{
  $postManager = new postManager();
  $CommentManager = new CommentManager();
  $reportcomment = $CommentManager->reportcomment($_POST['idcomment']);
  $post = $postManager->getPost($_GET['id']);
  $comments = $CommentManager->getComments($_GET['id']);
  require('view/frontend/postView.php');
}
//fonction d'ajout de commentaires
function postComment($author, $comment, $postId)
{
  $CommentManager = new CommentManager();
  $affectedLines = $CommentManager->
   postComment($author, $comment, $postId);
  if ($affectedLines === false) {
    throw new Exception('Impossible d\'ajouter le commentaire !');
  }
  else {
    header('Location: index1.php?action=post&id='.$postId);
  }
}
//recuperation des commenatires pour l'admin
function getComments(){
  $CommentManager = new CommentManager();
  $comments = $CommentManager->getReportedComments();
  require('view/frontend/frontadmin.php');
}
//recuperation des chapitres pour l'admin
function getPosts(){
  $PostManager = new PostManager();
  $posts = $PostManager->getPosts();
  require('view/frontend/frontadmin.php');
}
//fonction d'inscription
function inscription()
{
  require('view/frontend/inscription.php');
}
function deconnexion()
{
  require('controller/deconnexion.php');
}
//fonction d'inscription d'un utilisateur
function postinscription()
{
  //je verifie si le champ pseudo n'est pas null
  if(!empty($_POST['pseudo']))
  {
    // Je mets aussi certaines sécurités ici…
    $passe = htmlspecialchars($_POST['passe']);
    $passe2 = htmlspecialchars($_POST['passe2']);
    if($passe == $passe2)
    {
      $pseudo = htmlspecialchars($_POST['pseudo']);
      $email = htmlspecialchars($_POST['email']);
      // Je vais crypter le mot de passe.
      $passe = password_hash($passe, PASSWORD_DEFAULT);
      //
      $userManager=new UserManager();
      $userManager->creationUser($pseudo, $passe, $email);
    }
    else
    {
      echo 'Les deux mots de passe que vous avez rentrés ne correspondent pas…';
    }
  }
    header('Location: index1.php');
}
//fonction de connexion
function postconnexion()
{
  $pseudo = trim (htmlspecialchars($_POST['pseudo']));
  $passe = trim (htmlspecialchars($_POST['passe']));
  //creer un nouveau userconnexion
  $userConnexion=new UserManager();
  $resultat=$userConnexion->connexion($pseudo);
  //si login inconnu message d'erreur
  if (!$resultat)
  {
      throw new Exception ('mauvais login !');
  }
  else // Sinon
  {
      //comparaison du passe envoyé via le formulaire avec la base
      $ispasswordvalide = password_verify($passe, $resultat['passe']);
      if($ispasswordvalide){
        $_SESSION['passe'] = $resultat['passe'];
        $_SESSION['pseudo'] = $pseudo;
        echo 'Vous êtes connecté !';
      //si resultat du mot de passe admin redirection vers la page d'admin
      }
    else{
        throw new Exception('mauvais mot de passe !');
    }
    if ($_SESSION['pseudo'] == 'jean') {
        require('view/frontend/frontadmin.php');
    }
    else{
        header('Location: index1.php');
    }
  }

}
//fonction d'ajout de chapitre après envoyer sur tinymce
function postChapter($id, $title, $content, $image_post, $creation_date_fr)
{
  $postManager = new postManager();
  $lastchapter = $postManager->
   postChapter($id, $title, $content, $image_post, $creation_date_fr);

    header('Location: index1.php?action=post&id='.$postId);
}
function correction($id, $title, $content, $image_post, $creation_date_fr){
  $postManager = new postManager();
  $posts = $postManager->correction();
}
?>
