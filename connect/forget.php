<?php

require '../fonction/fonction.php';
require '../db/db.php';
if(!empty($_POST) && !empty($_POST["email"])){
    $email=verification($_POST["email"]);
    
    $requete=$pdo->prepare(" SELECT * FROM utilisateur WHERE email=? AND validation_date IS NOT NULL");
    $requete->execute([$email]);
    $utilisateur=$requete->fetch();
    debug($utilisateur);
    if($utilisateur){
        $utilisateur_id=$utilisateur->id;
        session_start();
        $restaure_passe=str_random(60);
       $pdo= Database::Connection();
        $requete=$pdo->prepare(" UPDATE utilisateur SET restaure_passe=? , restaure_date=NOW() WHERE id=? ");
        $requete->execute([ $restaure_passe,$utilisateur_id]);
        $_SESSION['flash']['success']=' les instruction de rappel du mot de passe été envoyées pas email';
        mail($email,"reinitialisation  de votre mot de passe","cliquez sur ce lien pour reinitialiservotre mot de passe\n\nhttp://localhost:8090/nl/connect/restaure.php?id=$utilisateur_id&token=$restaure_passe");
        Database::deconnection();
        header('location:forget.php');
        exit();

    }
    else{
        $_SESSION['flash']['danger']='Aucun compte trouvé!';
        header('location:forget.php');
    }

}

?>



<?php require 'inc/header.php';?>

<div class="page-content">
		<div class="form-v5-content">
			<h1><span>NL.</span>business</h1>
		<form class="form-detail" action="#" method="post">
				
				<div><h2> Mot de passe oublié</h2></div>
			
				<div class="form-row">
					<label for="email">Adresse Email</label>
					<input type="email" name="email" id="email" class="input-text" placeholder="Email"  >
				
					<i class="fas fa-envelope"></i>
				</div>
				
					<button type="submit" name=" submit" class="register" >Continuer</button>
					
				</div>
			</form>
		</div>
	</div>
<?php require 'inc/footer.php';?>
