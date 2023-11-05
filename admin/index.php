
<?php  require '../fonction/fonction.php';

?>
<?php require'../header_footer/header.php';?>
    <div class="container admin">
        <div class="row">
            <h1><strong>Liste des produits</strong> <a href="ajouter.php" class="btn btn-success btn-md"><span class="bi-plus"></span> ajouter</a></h1>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Categories</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require '../db/db.php';
                    $db=Database::connection();
                    $requete=$db->query('SELECT produits.id,produits.nom,produits.prix,produits.description,categories.nom AS categories 
                                          FROM produits  LEFT JOIN categories ON produits.categories=categories.id
                                          ORDER BY produits.id DESC  ');
                    while($produits=$requete->fetch()){

                      echo ' <tr>';
                      echo '<td>'.$produits->nom.'</td>';
                      echo '<td>'.$produits->description.'</td>';
                      echo '<td>'.$produits->prix.'F</td>';
                      echo '<td>'.$produits->categories.'</td>';
                      echo '<td width=320px>';
                            echo '<a class="btn btn-secondary vue" href="vue.php?id='.$produits->id.'"><span class="bi-eye "></span>Voir</a>';
                            echo ' ';
                            echo '<a class="btn btn-primary modifier" href="modifier.php?id='.$produits->id.'"><span class="bi-pencil"></span>Modifier</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger supprimer" href="supprimer.php?id='.$produits->id.'"><span class="bi-x"></span>Spprimer</a>';
                           
                    echo'</td>';
                    echo'</tr>';
                    }
                    Database::deconnection();
                    ?>
                </tbody>
            </table>
        </div>
    </div>


        
    <?php require'../header_footer/footer.php';?>