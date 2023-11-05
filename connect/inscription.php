
<?php 

session_start();
	require '../fonction/fonction.php';
	require_once '../db/db.php';

	$username=$email=$password=$password_c='';
	$usernameErreur=$emailErreur=$passwordErreur="";
	$isSuccess=true;

//traimenet du formulaire dinscription
if(!empty($_POST))
{  
	//verifier  les données passées dans la variable post
	$username  =verification($_POST['username']);
	$email     =verification($_POST['email']);
	$password  =verification($_POST['password']);
	$password_c=verification($_POST['password_c']);
	//tableau qui vas contenir les differentes erreurs

	

	if(empty($_POST['username'])|| !preg_match("/^[a-zA-Z0-9_]*$/",$_POST['username'])){
		$usernameErreur="veillez entrer un nom valide";
		$isSuccess=false;
	}else{
		$pdo=Database::Connection();
		$requete=$pdo->prepare('SELECT id FROM utilisateur WHERE nom=?');
		$requete->execute([$username]);
		$utilisateur=$requete->fetch();
		if($utilisateur){
		$usernameErreur="nom d'utilisateur deja pris";
		$isSuccess=false;
		}
	}

	if(empty($_POST['email'])||  !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		$emailErreur='adresse email non valide';
		$isSuccess=false;
	}else{
		$requete=$pdo->prepare('SELECT id FROM utilisateur WHERE email=?');
		$requete->execute([$email]);
		$utilisateur=$requete->fetch();
		if($utilisateur){
			$emailErreur="adresse email deja pris";
			$isSuccess=false;
		}
	}

	if(empty($_POST['password'])|| $_POST['password']!=$_POST['password_c']){
		$passwordErreur='mot de passe non valide';
		$isSuccess=false;

	}
	//debug($erreurs);

	if($isSuccess){

		//crypter le mot de passe
		$password=password_hash($password,PASSWORD_BCRYPT);
		//code de validation
		$token=str_random(60);

		$requete=$pdo->prepare(' INSERT INTO utilisateur SET nom=?, passe=? ,email=?,validation_token=?');
		$requete->execute([$username, $password,$email,$token]);
		//envoi du mail de validation
		$user_id=$pdo->lastInsertId();
		mail($email,"Comfirmation de votre compte","cliquez sur ce lien pour valider votre compte\n\nhttp://localhost:8090/nl/connect/confirm.php?id=$user_id&token=$token");
		$_SESSION['flash']['success']="un email de confirmation vous a ete envoyé";
		Database::deconnection();
		header("location:inscription.php");
		exit;
	}



}



?>
  
<?php require 'inc/header.php'?>

	<div class="page-content">
		<div class="form-v5-content">
			<h1><span>NL.</span>business</h1>
		<form class="form-detail" action="#" method="post">
				
				<h2>  <a href="connection.php">connectez-vous</a>, si vous avez deja un compte</h2>
				<div class="form-row">
					<label for="username">Nom</label>
					<input type="text" name="username" id="username" class="input-text" placeholder="votre Nom" >
					<div class="erreur"><?php echo $usernameErreur?></div>
					<i class="fas fa-user"></i>
				</div>
				<div class="form-row">
					<label for="email">Adresse Email</label>
					<input type="text" name="email" id="email" class="input-text" placeholder="Email"  >
					<div class="erreur"><?php echo $emailErreur?></div>
					<i class="fas fa-envelope"></i>
				</div>
				<div class="form-row">
					<label for="password">Mot de passe</label>
					<input type="password" name="password" id="password" class="input-text" placeholder="votre mot de passe" >
					<div class="erreur"><?php echo $passwordErreur?></div>
					<i class="fas fa-lock"></i>
				</div>
				<div class="form-row">
					<label for="password">Confirmez le mot de passe</label>
					<input type="password" name="password_c" id="password" class="input-text" placeholder="votre mot de passe" >
					<i class="fas fa-lock"></i>
				</div>
				<div class="form-row-last">
					<button type="submit" name=" submit" class="register" > S'inscrire</button>
					
				</div>
			</form>
		</div>
	</div>
<?php  require'inc/footer.php';?>