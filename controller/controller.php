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
  //si pas connecté pas possible de poster un commentaire
  if(isset($_SESSION['pseudo'])){
    $CommentManager = new CommentManager();
    $affectedLines = $CommentManager->
     postComment($author, $comment, $postId);
    if ($affectedLines === false) {
      throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    header('Location: index1.php?action=post&id='.$postId);
  }
  else {

      throw new Exception('');
  }
}
//recuperation des commenatires pour l'admin
function getComments(){
  $CommentManager = new CommentManager();
  $comments = $CommentManager->getReportedComments();
  require('view/frontend/frontadmin.php');
}
//suppression des commenatires par l'admin
function suppComment($id){
  $CommentManager = new CommentManager();
  $comments = $CommentManager->suppComment($id);
  require('view/frontend/frontadmin.php');
}
//suppression des chapitres par l'admin
function suppPost($id){
  $postManager = new postManager();
  $posts = $postManager->suppPost($id);
  require('view/frontend/frontadmin.php');
}
//update des chapitres par l'admin
function upChapter($id,$title, $content){
  $postManager = new postManager();
  $posts = $postManager->upChapter($id, $title, $content);
  require('view/frontend/admin.php');
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
    throw new Exception ('');
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
      throw new Exception ('');
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
        throw new Exception('');
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
function postChapter($title, $content)
{
  $postManager = new postManager();
  $postManager = $postManager->
   postChapter($title, $content);
     require('view/frontend/admin.php');
}
//function de modification ou de suppresion d'un chapitre par l'admin en le renvoyant dans tinymce a l'aide du textarea de tinymce
function correction($id)
{
  $postManager = new postManager();
  $posts = $postManager->correction($id);
   require('view/frontend/admin.php');
}
?>
