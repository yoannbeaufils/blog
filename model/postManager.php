<?php
//manager=connexion
require_once("Manager.php");

class postManager extends Manager
{
  //récupération des champs pour posts page index1 chapitres, liste des chapitres
  public function getPosts()
  {
      $db =$this-> dbConnect();
      $req = $db->query('SELECT id, title, content,image_post, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');
      return $req;
    }
    /*récupération des champs pour chapitre en entier, 1 chapitre*/
    public function getPost($postId)
    {
      $db =$this-> dbConnect();
      $req = $db->prepare('SELECT id, title, content,image_post, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") AS creation_date_fr FROM posts WHERE id = ?');
      $req->execute(array($postId));
      $post = $req->fetch();
      return $post;
    }
    /*insertion du dernier chapitre ecrit par l'auteur dans la table post*/
    public function postChapter($title, $content)
    {
      $db =$this-> dbConnect();
      $lastchapter = $db->prepare('INSERT INTO posts (title, content) VALUES( :title, :content,)');
      $lastchapter->execute(array(
        'title' => $title,
        'content' => $content,
    ));
      return $lastchapter;
    }
    //recuperation des chapitres par l'admin
    public function getAdminPosts(){
      $db =$this-> dbConnect();
      $posts = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") AS comment_date FROM posts');
      $posts->execute();
      return $posts;
    }
  }
