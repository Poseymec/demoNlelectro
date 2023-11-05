
<?php

require '../db/db.php';

if(!empty($_GET['id'])){
    $id=checkInput($_GET['id']);
}

$db=Database::Connection();
$requete=$db->prepare('SELECT produits.id,produits.nom,produits.prix,produits.description, produits.image,categories.nom AS categories
FROM produits  LEFT JOIN categories ON produits.categories=categories.id
WHERE produits.id=?');

$requete->execute(array($id));

$produits=$requete->fetch();
Database::deconnection();





/**fonction */

function checkInput($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}




?>





<?php require'../header_footer/header.php';?>
    <div class="container  admin">
        <div class="row">
            <div class="col-sm-6  col-md-6 col-lg-6">
                <h1><strong>voir un produit</strong></h1> <br>
                <form>
                    <div class="form-group">
                        <label >Nom:<?php echo'   '.$produits->nom;?></label>
                    </div><br>
                    <div class="form-group">
                        <label >Description:<?php echo'   '.$produits->description;?></label>
                    </div><br>
                    <div class="form-group">
                        <label >Prix:<?php echo'   '.number_format((float)$produits->prix,2,'.','');?> fcfa</label>
                    </div><br>
                    <div class="form-group">
                        <label >Categories:<?php echo'   '.$produits->categories;?></label>
                    </div><br>
                    <div class="form-group">
                        <label >Image:<?php echo'   '.$produits->image;?></label>
                    </div>
                </form>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6 site">
                <div class="img-thumbnail">
                    <img src="<?php echo '../images/'.$produits->image ;?>" class='img-fluid' alt="...">
                    <div class='prix'><?php echo'   '.number_format((float)$produits->prix,2,'.','');?> FCFA</div>
                        <div class="caption">
                            <h4><?php echo'   '.$produits->nom;?></h4>
                            <p><?php echo'   '.$produits->description;?></p>
                            <a href="#" class="btn btn-order" role="button"><span class="bi-cart-fill"></span>commander</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="action-form">
                <a href="index.php" class="btn btn-primary" ><span class="bi-arrow-left"></span>retour</a>
            </div>
            
    </div>

        
    <?php require'../header_footer/footer.php';?>