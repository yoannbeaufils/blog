<?php
//manager=connexion
require_once("Manager.php");

class PostManager extends Manager
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
    $lastchapter = $db->prepare('INSERT INTO posts (title, content,creation_date ) VALUES(:title, :content, NOW() )');
    $lastchapter->execute(array(
      'title' => $title,
      'content' => $content
    ));
    return $lastchapter;
  }
  //recuperation des chapitres par l'admin dans son tableau de bord
  public function getAdminPosts(){
    $db =$this-> dbConnect();
    $posts = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") AS comment_date FROM posts');
    $posts->execute();
    return $posts;
  }
  //envoi des chapitres a modifier ou supprimer dans tinymce
  public function correction($id){
    $db =$this-> dbConnect();
    $posts = $db->prepare('SELECT title, content FROM posts WHERE id = :id');
    $posts->execute(array(
      'id' =>$id
    ));
    return $posts->fetch();
  }
  //fonction d'update des chapitres par l'admin
  public function upChapter($id, $title, $content)
  {
    $db =$this-> dbConnect();
    $posts = $db->prepare('UPDATE posts SET title = :title, content = :content WHERE id= :id');
    $posts->execute(array(
      'id' => $id,
      'title' => $title,
      'content' => $content
    ));
  }
  //suppression par l'admin des chapitres dans la base de données
  public function suppPost($id)
  {
    $db =$this-> dbConnect();
    $report = $db->prepare("DELETE FROM posts WHERE id= :id");
    $report->execute(array(
      'id' =>$id
    ));
  }
}
