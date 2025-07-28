<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Accueil</title>
        <link href="css/style.css" rel="stylesheet">
        <script src="js/script.js"></script>
    </head> 
    <body>
        <header>Bienvenue sur notre site de vente en ligne de sacs
        <div class="liens">
        <?php
        session_start();  // à mettre au début avant tout echo 
        if(!(isset($_SESSION['id']))){
         echo " <a class='button1' href='connexion.php'>Se connecter</a>";
         echo "<a class='button1' href='inscription.php'>S'inscrire</a>";
        }else{
            echo"<a class='button1' href='client/panier.php'>Voir mon panier</a>";
            echo "<a class='button1' href='deconnexion.php' onclick='return Deconnexion()'>Se déconnecter</a>";
        } ?>
        </div>
        </header>
        <h2>Venez découvrir nos modèles à prix imbattables</h2>
        <?php 
           require_once("include/db_connect.php");
           $sql="SELECT* from produits";   //on prend tous les produits de notre table produits

           $resultat  = $dblink->query($sql);
           echo "<div class='panier'>";
           while($row = $resultat->fetch_assoc()){  //on prend les informations et on les affiches dans une boucle
            echo "<div class='product'>";
            echo "<p class='nom'>", $row['nom'], "<br></p>";
            echo $row['prix'], "€ <br>" ;
            echo "<p class='descrip'><img src='images/" . $row['image'] . "'> <br>";
            echo $row['description'] ,"</p>" ; 
            if ($row['stock'] > 0) {
                echo "<p>En stock : " . $row['stock'] . "</p>";
            } else {  //si le stock est inférieur ou égal à 0
                echo "<p id='rupture'>Rupture de stock</p>"; 
            }           
           
            echo "<a class='button' href='client/ajouter_panier.php?id_produit={$row['id']}'>Ajouter au panier</a>";
            echo "</div>";
           }
           echo "</div>";
        ?>
        
    </body>
</html> 


