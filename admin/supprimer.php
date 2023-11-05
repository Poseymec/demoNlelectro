<?php
require '../db/db.php';

if(!empty($_GET['id'])){
    $id=verification($_GET['id']);
}

if(!empty($_POST)){
    $id= verification($_POST['id']);

    $db=Database::Connection();
    $requet=$db->prepare("DELETE  FROM produits WHERE id=?");
    $requet->execute(array($id));
    $db=Database::deconnection();

    header("location: index.php");
}








/**fonction  */

//fonction qui verifie si les donnees sont justes

function verification($data){
    $data=htmlspecialchars($data);
    $data=trim($data);
    $data=stripslashes($data);

    return $data;
}


?>



<?php require'../header_footer/header.php';?>
        <div class="container admin">
            <div class="row">
               
                    <h1><strong>supprimer un produit</strong></h1> <br>
                    <form action="supprimer.php" method="POST"  class="form" role="form">

                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <p class="alert alert-warning">voulez vous vraiment supprimer ce produit?</p>
                        <div class="form-actions"> 
                            <button type="submit" class="btn btn-warning"  >Oui</button>
                            <a href="index.php" class="btn btn-default" >Non</a> 
                        </div>
                       
                    </form>
                </div>
        </div>
        <?php require'../header_footer/footer.php';?>