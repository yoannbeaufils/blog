<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');
//fonction d'affichage des chapitres
function listPosts()
{
  $postManager = new PostManager();
  $posts = $postManager->getPosts();
  require('view/frontend/listPostsView.php');
}
//fonction d'un chapitre
function post()
{
  $postManager = new PostManager();
  $CommentManager = new CommentManager();
  //$reportcomment = $CommentManager->reportcomment($_POST['idcomment']);
  $post = $postManager->getPost($_GET['id']);
  if($post == false){
    throw new Exception('chapitre inconnu');
  }
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
      throw new Exception('');
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
//suppression des chapitres par l'admin ainsi que des commentaires associés
function suppPost($id){
  $CommentManager = new CommentManager();
  $comments = $CommentManager->suppComments($id);
  $postManager = new PostManager();
  $posts = $postManager->suppPost($id);
  require('view/frontend/frontadmin.php');
}
//update des chapitres par l'admin
function upChapter($id,$title, $content){
  $postManager = new PostManager();
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
  require('view/frontend/deconnexion.php');
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
    throw new Exception ('erreur de saisie');
    }
  }
    header('Location: index1.php');
}
//fonction de connexion
function postconnexion()
{
  //trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
  $pseudo = trim (htmlspecialchars($_POST['pseudo']));
  $passe = trim (htmlspecialchars($_POST['passe']));
  //creer un nouveau userconnexion
  $userConnexion=new UserManager();
  $resultat=$userConnexion->connexion($pseudo);
  //si login inconnu message d'erreur
  if (!$resultat)
  {
      throw new Exception ('erreur de saisie');
  }
  else // Sinon
  {
      //comparaison du passe envoyé via le formulaire avec la base
      $ispasswordvalide = password_verify($passe, $resultat['passe']);
      if($ispasswordvalide){
        $_SESSION['passe'] = $resultat['passe'];
        $_SESSION['pseudo'] = $pseudo;
        if ($_SESSION['pseudo'] == 'jean') {
            require('view/frontend/frontadmin.php');
            echo 'vous etes connecté';
        }
        else{
            header('Location: index1.php');
        }
      //si resultat du mot de passe admin redirection vers la page d'admin
      }
    else{
        throw new Exception('');
    }
  }
}
//fonction d'ajout de chapitre après ecriture sur tinymce
function postChapter($title, $content)
{
  $postManager = new PostManager();
  $postManager = $postManager->
   postChapter($title, $content);
     require('view/frontend/admin.php');
}
//function de modification ou de suppresion d'un chapitre par l'admin en le renvoyant dans tinymce a l'aide du textarea de tinymce
function correction($id)
{
  $postManager = new PostManager();
  $posts = $postManager->correction($id);
   require('view/frontend/admin.php');
}
function signalComment($idcomment){
$CommentManager = new CommentManager();
$comments = $CommentManager->reportcomment($idcomment);
header('Location:index1.php');
require('view/frontend/postView.php');
}
?>
