<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Panier</title>
        <link href="../css/style.css" rel="stylesheet">  <!-- on inclut les fichiers .css et .js nécessaires-->
        <script src="../js/script.js"></script>
    </head> 
    <body>
    <header>Bienvenue sur notre site de vente en ligne de sacs</header>
    <h1>Votre panier</h1>
   
           <?php
                session_start();
                require_once("../include/db_connect.php");
                if(isset($_SESSION['id'])){
                $id_client = $_SESSION['id'];
                //la requête SQL qui permet d'obtenir les informations sur un produit 
                $sql = "SELECT p.id , p.nom, p.prix, p.image, dc.quantite
                     FROM details_commande AS dc
                     JOIN produits AS p ON dc.id_produit = p.id
                     WHERE dc.id_client = $id_client AND dc.id_commande IS NULL";

                $resultat = $dblink->query($sql);
                $total_general = 0;
                if($resultat->num_rows === 0){    //si aucun produit ne correspond alors le panier est vide
                     echo "<div class='messages'>Votre panier est vide !
                     Remplissez le avec nos articles de qualité à petits prix !!<br>";
                     echo "<a class='button' href='../index.php'>Acheter</a></div>";
                }else{ //sinon il faut afficher les articles du panier
                     echo" <h2>Validez vos achats avant que les produits ne soient en rupture de stock viiite !!<h2>";
                     echo "<div class='panier'>";
                     while ($row = $resultat->fetch_assoc()){
                              $total = $row['prix'] * $row['quantite'];
                              $total_general += $total ;   //on met à jour à chaque fois le total
                              echo "<div class='product'>";
                              echo "<img src='../images/" . $row['image'] . "'> <br>"; //on affiche une image
                              echo "<div class='details'>";
                              echo "<h2>" , $row['nom'], "</h2>";              //le nom du produit
                              echo "<p>Prix :", $row['prix'],"€</p>";          //son prix
                              echo "<p>Quantite :", $row['quantite'],"</p>";   //et la quantité dans le panier
                              echo"</div> </div>";
       
                      }
                     echo "</div>";
      
                      echo "<div class='total'>Total général ".$total_general."€</div>"; //on met le total final
    
            ?>
            <div class="actions">
            <a href="../index.php">Retour aux produits</a>
            <a href ="vider_panier.php?id_commande=<?php echo $id_client?>" onclick="return viderPanier()">Vider le panier</a> 
            <a href="passer_commande.php?id_client=<?php echo $id_client?>">Acheter</a> 
      
    </div> 
      <?php } }else{
        echo "Connectez-vous";   // en cas de client déconnecté
      } ?>

  </body>
</html> 