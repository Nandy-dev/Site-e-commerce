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
    <?php session_start();
        require_once("../include/db_connect.php");
         if(!isset($_SESSION['id']) ){   //absence d'id de session donc client pas connecté
               echo "Veuillez-vous connecter pour ajouter au panier<br>";
               echo "<a class='button' href='../connexion.php'>Connexion</a>";  //on lui donne le lien vers la page de connexion
               exit(); //et on sort
         }
         if(isset($_GET['id_produit'])) {  
               $id_client = $_SESSION['id'];
               $id = $_GET['id_produit'];     //on recupère l'id du produit à ajouter
               $sql = "SELECT * FROM produits WHERE id = $id";  
               $resultat = $dblink->query($sql);
               $produit = $resultat->fetch_assoc();
               if($produit && $produit['stock'] > 0){  //si on l'a en stock
                     $sql ="SELECT * from  details_commande where  id_produit = $id and id_commande is NULL and id_client = $id_client";
                     $resultat = $dblink->query($sql);
                    if($resultat->num_rows > 0){  //si il est déjà dans le panier on met à jour sa quantité grace à update
                        $sql = "UPDATE details_commande SET quantite = quantite + 1 Where id_produit =$id and id_commande is NULL";
                        $dblink->query($sql);
                        echo "Quantité augmentée avec succès !<br>";
                     }else{   //sinon on l'y met grace à insert into
                            $sql ="INSERT INTO details_commande (id_produit,quantite,id_commande,id_client) VALUES ($id,1,NULL,$id_client)";
                            $dblink->query($sql);
                            echo "Produit ajouté au panier<br>";
                     }
                     $sql = "UPDATE produits SET stock =stock-1 where id =$id"; //on diminue sa quantité en stock
                     $dblink->query($sql);
               }else{
                     echo "Ce produit est en rupture de stock<br>";
               }
         }else{
              echo "Produit introuvable<br>";
        }
        echo"<br>";
        echo "<a href='panier.php' class='button'>Voir le panier</a><br>";
        echo"<a href='../index.php' class='button'>Continuez à acheter</a>";
   ?>
   </div>
</body>
</html>