<?php

require('model/model.php');
function listPosts()
{
  $posts = getPosts();
  require('view/frontend/listPostsView.php');
}
function post()
{
  $post = getpost($_GET['id']);
  $comments = getComments($_GET['id']);
  require('view/frontend/postView.php');
}
function addComment($postId, $author, $comment)
{
    $affectedLines = postComment($postId, $author, $comment);
    if ($affectedLines === false) {
        die('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index1.php?action=post&id=' . $postId);
    }
}
