<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des produits</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="messages">
      <?php 
        session_start();
        require_once("../include/db_connect.php");
        if(isset($_GET['id'])){ 
           $id = $_GET['id'];  //on récupère l'id du produit à supprimer
           $sql = "DELETE from produits where id = $id";  //on supprime dans la base
           if($dblink->query($sql)){
              echo "<h2>Produit supprimé avec succès</h2>";   //on le signale
           }else{
              echo "<h2>Erreur lors de la suppression</h2>";
           } 
        }
      ?>
    </div>
    <a href="afficher_produits.php" class="button">Retour à la gestion des produits</a>
</body>
</html>
