<?php

require_once("Manager.php");//connexion

class CommentManager extends Manager
{
  public function getComments($postId)//récupération des commentaires
  {
    $db =$this-> dbConnect();
    $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id_posts = ? ORDER BY comment_date DESC');
    $comments->execute(array($postId));
    return $comments;
  }
  public function postComment($author, $comment)//inserer des commentaires dans la base de données
  {
    $db =$this-> dbConnect();
    $comments = $db->prepare("INSERT INTO comments VALUES('$author', '$comment')");
    $affectedLines = $comments->execute(array(
    'author' =>   $author,
    'comment' => $comment
  ));
    return $affectedLines;
  }
  }
