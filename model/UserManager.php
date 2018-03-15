<?php
class UserManager extends Manager{
  public function creationUser($pseudo, $passe, $email){
    $db= $this->dbConnect();
    //prepare and execute
    $req = $db->prepare("INSERT INTO validation VALUES('', '$pseudo', '$passe', '$email')");
    $req->execute(array(
      'pseudo' => $pseudo,
      'passe' => $passe,
      'email' => $email
    ));
  }
  public function connexion($pseudo){
    $db= $this->dbConnect();
    //prepare and execute
    $req = $db->prepare('SELECT pseudo, passe from validation where pseudo = :pseudo');
    $req->execute(array(
      'pseudo' => $pseudo
    ));
      $user = $req->fetch();
    return $user;
  }
}
