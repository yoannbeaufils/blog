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
  //recuperation des commenatires signalés par l'admin
  public function getReportedComments(){
    $db =$this-> dbConnect();
    $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE reported > 0 ORDER BY comment_date DESC');
    $comments->execute();
    return $comments;
  }
  public function postComment($author, $comment, $postId)//inserer des commentaires dans la base de données
  {
    $db =$this-> dbConnect();
    $comments = $db->prepare("INSERT INTO comments (id_posts, author, comment, comment_date) VALUES(:postId, :author, :comment, NOW() )");
    $affectedLines = $comments->execute(array(
    'author' =>   $author,
    'comment' => $comment,
    'postId' => $postId
  ));
    return $affectedLines;
  }
  }
