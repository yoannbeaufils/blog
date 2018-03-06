<?php
// Chargement des classes
require_once('model/postManager.php');
require_once('model/CommentManager.php');
function listPosts()
{
  $postManager = new postManager();
  $posts = $postManager->getPosts();
  require('view/frontend/listPostsView.php');
}
function post()
{
  $postManager = new postManager();
  $CommentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $CommentManager->getComments($_GET['id']);
  require('view/frontend/postView.php');
}
function addComment($postId, $author, $comment)
{
    $CommentManager = new CommentManager();
    $affectedLines = $CommentManager-> postComment($postId, $author, $comment);
    if ($affectedLines === false) {
      throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index1.php?action=post&id=' . $postId);
    }
}
function inscription()
{
  require('view/frontend/inscription.php');
}
