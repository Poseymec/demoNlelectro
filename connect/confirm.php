<?php



//traitement de l'email de confirmation



$user_id=$_GET['id'];
$token=$_GET['token'];


require_once '../db/db.php';
$pdo=Database::Connection();
$requete=$pdo->prepare('SELECT * FROM utilisateur WHERE id=?');
$requete->execute([$user_id]);

$user=$requete->fetch();

if($user && $user->validation_token==$token){

    session_start();

    $requete=$pdo->prepare('UPDATE utilisateur SET validation_token=NULL, validation_date=NOW() WHERE id=?');
    $requete->execute([$user_id]);

    $_SESSION['auth']=$user;
    $_SESSION['flash']['success']="binevenue mr ".$user->nom;
    Database::deconnection();
    header('location:/../nl/index.php');
  

}
else{

    $_SESSION['flash']['danger']="cest code n'est plus valide";
   header('location:connection.php');

}

