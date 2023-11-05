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
        <link href="../css/styles_home.css" rel="stylesheet" />
        <link href="../css/styles_admin.css" rel="stylesheet" />
    </head>
    <body>
           <!-- Navigation-->
           <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
             <a class="navbar-brand" style="color:#ff0000; font-weight: 600;font-size:40px;" href="#!"><span style="color:#0a58ca; font-weight: 900;">NL </span>Business</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/../nl/index.php">Accueil</a></li>
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
    