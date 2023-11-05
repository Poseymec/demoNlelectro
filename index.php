<?php session_start();
require 'fonction/fonction.php';



?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles_home.css" rel="stylesheet" />
        <link href="css/styles_admin.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
             <a class="navbar-brand" style="color:#ff0000; font-weight: 600;font-size:40px;" href="#!"><span style="color:#0a58ca; font-weight: 900;">NL </span>Business</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Accueil</a></li>
                        <!--<li class="nav-item"><a class="nav-link" href="#!">About</a></li>-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">Produits</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Promotion</a></li>
                                <li><a class="dropdown-item" href="#!">Arrivage</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                            <li  class="nav-item"><a  class="nav-link"  href="admin/index.php">Administration</a></li>
                            <?php if(isset($_SESSION['auth'])):?>
                            <li  class="nav-item"><a   class="nav-link" href="connect/deconnection.php">Deconnection</a></li>
                            <?php else:?>
                            <li  class="nav-item"><a  class="nav-link"  href="connect/connection.php">Connection</a></li>
                            <li  class="nav-item"><a  class="nav-link"  href="connect/inscription.php">Inscription</a></li>
                            <?php endif;?>
                        </ul>
                       
                       
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
                </div>
            </div>
        </header>
     

        <?php
        require 'db/db.php';
        echo "  <nav class='nav' style='margin-top:25px;'>
                    <ul class='nav nav-pills' role='tablist'>";
                    $db=Database::Connection();
                    $requete=$db->query("SELECT * FROM categories");
                    $categories=$requete->fetchAll();
                    foreach( $categories as $categorie){
                        if($categorie->id=='1'){
                           echo '<li class="nav-item" role="presentation"  >
                                    <a class="nav-link active"  data-bs-target="#tab'.$categorie->id.'" data-bs-toggle="pill" role="tab">'.$categorie->nom.'</a>
                                </li>';
                        }
                        else{
                            echo '<li class="nav-item" role="presentation"  >
                                    <a class="nav-link "  data-bs-target="#tab'.$categorie->id.'" data-bs-toggle="pill" role="tab">'.$categorie->nom.'</a>
                                </li>';
                        }
                    }
                    echo '       </ul>
                            </nav>';

      /*  <!-- Section-->*/

                echo '<section class="py-5  tab-content" >';
                      echo '  <div class="container px-4 px-lg-5 mt-5" >
                                <div class="tab-content">';

                      foreach ($categories as $categorie) {
                          if($categorie->id == '1') {
                              echo '<div class="tab-pane active" id="tab' . $categorie->id .'" role="tabpanel">';
                            } else {
                                echo '<div class="tab-pane" id="tab' . $categorie->id .'" role="tabpanel">';
                            }
                            
                        echo ' <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">';
                        /*echo '<div class="row ">';*/
                        
                        $requete= $db->prepare(' SELECT * FROM produits WHERE produits.categories = ? ');
                        $requete->execute(array($categorie->id));
                        while ($produits = $requete->fetch()) {
                          
                              echo ' <div class="col mb-5">
                                        <div class="card h-100">
                                         <!-- Product image-->
                                            <img class="card-img-top" src="images/'.$produits->image.'" alt="..." />
                                             <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="fw-bolder">'.$produits->nom.'</h5>
                                                   <p>' .$produits->description.'</p>
                                                        <!-- Product price-->
                                                    '. number_format($produits->prix, 2, '.', '').' F
                                                </div>
                                            </div>
                                                <!-- Product actions-->
                                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#"><span class="bi-cart-fill"></span>Commander</a></div>
                                                </div>
                                            </div>
                                    </div>';
                        }
                       
                       echo    '</div>
                            </div>';
                    }
                    Database::deconnection();
                    echo  '</div>
                        </div>
                    </section>';
             ?>
             
           

        <footer class="py-5 bg-dark" style="bottom: 0; margin-top:20px" >
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; NL business 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

       
    </body>
</html>
