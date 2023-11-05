
<?php

//importer la bd
require '../db/db.php';

require '../fonction/fonction.php';
reconnect_cookie();
//session_start();
if(isset($_SESSION['auth'])){
	header('location:index.php');
	exit;
}

if(isset($_POST) && isset($_POST['email'])){

	$email=verification($_POST['email']);
	
	if(empty($_POST['password'])){
		$passwordErreur='veillez ajouter votre mot de passe';
		$isSuccess=false;
		
	}
	$password=verification($_POST['password']);

	$pdo=Database::Connection();
	
	$requete=$pdo->prepare("SELECT * FROM utilisateur WHERE (email=:email OR nom=:email) AND validation_date is not NULL ");
	$requete->execute(['email'=>$email]);
	$utilisateur=$requete->fetch();

	if(password_verify($password,$utilisateur->passe)){
		session_start();

		$_SESSION['auth']=$utilisateur;
		$_SESSION['flash']['success']="connection reussie";
		if($_POST['souvenir']){
			$souvenir=str_random(250);
			$requete=$pdo->prepare(" UPDATE  utilisateur SET souvenir=? WHERE id=?")->execute([$souvenir,$utilisateur->id]);
			setcookie('souvenir',$utilisateur->id.'//'.$souvenir.sha1($utilisateur->id.'incorrect'.time()*60*60*24*7));

			Database::deconnection();
			
		}
		header('location:/../nl/index.php');
		exit();
		
	}
	else{
		$_SESSION['flash']['danger']='identifiant ou mot de passe incorrect';
	}

	


	


}





?>

<?php require 'inc/header.php';?>

    <div class="page-content">
        <div class="form-v5-content container ">
            <h1><span>NL.</span>business</h1>
			<form class="form-detail" action="#" method="post">
                <h2>Si vous n'avez pas de compte, <a href="inscription.php">Inscrivez-vous</a></h2>
				<div class="form-row">
					<label for="email">Nom ou Email</label>
					<input type="text" name="email" id="email" class="input-text" placeholder="Nom ou Email" >
					<i class="fas fa-envelope"></i>
				</div>
				<div class="form-row">
					<label for="password">Mot de passe</label>
					<input type="password" name="password" id="password" class="input-text" placeholder="votre mot de passe" >
					<i class="fas fa-lock"></i>
				</div>
				<div >
					<p>
						<input type="checkbox"    name="souvenir" value="1" />se souvenir de moi

					</p>
					
				</div>
					<div><a href="forget.php">Mot de passe oublié?</a></div>
				
				<div class="form-row-last">
					<button type="submit" name=" submit" class="register" > Se connecter</button>
					
				</div>
			</form>
		</div>
	</div>
	<?php require 'inc/footer.php';?>