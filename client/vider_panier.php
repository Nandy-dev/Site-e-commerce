<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Panier</title>
        <link href="../css/style.css" rel="stylesheet">
    </head> 
    <body>
    <header>Bienvenue sur notre site de vente en ligne de sacs</header>
  
      <div class="messages">
       <?php
       session_start();
       require_once("../include/db_connect.php");
      if(isset($_SESSION['id'])){          //si on est connecté
      $id_client =$_SESSION['id'];          //on garde l'id du client connecté

      $sql = "SELECT id_produit , quantite from details_commande WHERE id_client =$id_client";
      $resultat = $dblink->query($sql);

      while($row = $resultat->fetch_assoc()){   //on obltient les informations associées 
        $id_produit = $row['id_produit'];
        $quantite = $row['quantite'];

        $sql = "UPDATE produits SET stock = stock+ $quantite where id = $id_produit";  //on remet le stock initial
        $dblink->query($sql);
      }
      $sql = "DELETE dc  From details_commande as dc  where id_client=$id_client and dc.id_commande is NULL";
      $dblink->query($sql);
      echo "<h2>Panier vidé avec succès</h2>";
      echo "Votre panier est vide !! Remplissez le à nouveau avec nos produits de qualité à des prix incroyables<br>";
      echo "<a href='panier.php' class='button'>Retour au panier</a>";
    }else{  //si on est pas connecté
      echo "Connectez-vous pour vider le panier";
    }
      ?>
      </div>
    </body>
</head>
