<?php


//fonction pour debuguer les erreurs

function debug($varialble)
{
    echo '<pre>'.print_r($varialble,true).'</pre>';
}


//fonction pour verifier les information entrées par l'utilisqateur


function verification($varialble){
    $varialble=htmlspecialchars($varialble);
    $varialble=stripslashes($varialble);
    $varialble=trim($varialble);

    return $varialble;
}


//fonction de validation

function str_random($length){
    $alpabet="0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alpabet,$length)),0,$length);
}

//fonction qui permet de verifier  si l'utilisateur a le droit ou non d'accedre a une page

function connect_only(){
    
 if(session_status()==PHP_SESSION_NONE){

    session_start();
    }

    if(!isset($_SESSION['auth'])){
        $_SESSION['flash']['danger']="vous n'avez pas le droit d'acceder a cette page!";
        header('location:connect/connection.php');
        exit();
    }
    
    
}

//fonction de reconnection par cookie

function reconnect_cookie(){

 /* if(session_start()==PHP_SESSION_NONE){
        session_start();
    }*/
    require 'db.php';
    if(isset($_COOKIE["souvenir"]) && !isset($_SESSION['auth'])){
        $souvenir=$_COOKIE['souvenir'];
    
        $partie=explode('==',$souvenir);
        $utilisateur_id=$partie[0];
        $requete=$pdo->prepare('SELECT * FROM utilisateur WHERE id=?');
        $requete->execute([$utilisateur_id]);
        $utilisateur=$requete->fetch();
        if($utilisateur){
            $expected=$utilisateur_id.'=='.$utilisateur->souvenir.sha1($utilisateur_id.'incorrect');
            if($expected==$souvenir){
             
                $_SESSION['auth']=$utilisateur;
                setcookie('souvenir',$souvenir,time()*60*60*24*7);

            }else{

                setcookie('souvenir',NULL,-1);
            }
            
            
        }else{
            setcookie('souvenir',NULL,-1);
        }

    }
}