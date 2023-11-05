<?php
session_start();
if(isset($_GET['id']) && isset($_GET['token'])){
    require 'fonction.php';
    $id=verification($_GET['id']);


    require '../db/db.php';

    $requete=$pdo->prepare(" SELECT * FROM utilisateur WHERE id=? AND restaure_passe IS NOT NULL AND restaure_passe=? AND restaure_date > DATE_SUB(NOW(), INTERVAL 30 MINUTE)");
    $requete->execute([$id,$_GET['token']]);
    $utilisateur=$requete->fetch();
    if($utilisateur){
      if(!empty($_POST['password'])&& $_POST['password']==$_POST['password_c']){
            $password=verification($_POST['password']);
            $password=password_hash($password,PASSWORD_BCRYPT);
            $pdo=Database::Connection();
            $requete=$pdo->prepare(' UPDATE utilisateur SET passe=?,restaure_passe=NULL ,restaure_date=NULL');
            $requete->execute([$password]);
            Database::deconnection();


            $_SESSION['falsh']['success']='votre mot de passe a été modifier';
            header('location:connection.php');
            exit();
      }

    }else{
        $_SESSION['flash']['danger']="token invalide";
       header('location:connection.php');
       exit();
    }

}else{
    header('location:connection.php');
    exit();
}



?>





<?php require 'inc/header.php';?>

    <div class="page-content">
        <div class="form-v5-content container ">
            <h1><span>NL.</span>business</h1>
			<form class="form-detail" action="#" method="post">
                <h3>Reinitialiser mon mot de passe</h3>
				<div class="form-row">
                    <label for="password">Mot de passe</label>
					<input type="password" name="password" id="password" class="input-text" placeholder="votre mot de passe" >
					<i class="fas fa-lock"></i>
				</div>
                <div class="form-row">
                    <label for="password">Confirmez le mot de passe</label>
                    <input type="password" name="password_c" id="password" class="input-text" placeholder="votre mot de passe" >
                    <i class="fas fa-lock"></i>
                </div>
                
				<div class="form-row-last">
					<button type="submit" name=" submit" class="register" > appliquer</button>
					
				</div>
			</form>
		</div>
	</div>
	<?php require 'inc/footer.php';?>