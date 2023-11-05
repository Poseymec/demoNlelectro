<?php
session_start();
require 'fonction.php';

connect_only();


?>


<?php require 'inc/header.php';?>



<?php if(isset($_SESSION['auth'])):?>
<div style="font-size: large;color:brown;text-align:right;"><a href="deconnection.php">deconnection</a></div>
<?php else:?>
<div style="font-size: large;color:brown;text-align:right;"><a href="connection.php">se connecter</a></div>
<div style="font-size: large;color:brown;text-align:right;"><a href="inscription.php">s'inscrire</a></div>

<?php endif;?>


<h1 style="text-align: center; color:brown;">bienvenue</h1>
<?php require 'inc/footer.php'?>