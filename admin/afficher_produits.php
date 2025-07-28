<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des produits</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>
<body>
        <?php
             session_start();
            require_once("../include/db_connect.php");
            //on récupere tous les produits
            $sql = "SELECT * FROM produits";
            $resultat = $dblink->query($sql);
        ?>
        <h1>Gestion des produits</h1>

        <table>
           <thead>
              <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Actions</th>
              </tr>
          </thead>
          <tbody>
            <?php while($produit = $resultat->fetch_assoc()) { ?>   
            <tr><!-- on affiche les informations de chaque produit-->
                <td><?php echo $produit['nom']; ?></td>   
                <td><?php echo $produit['prix']; ?>€</td>
                <td><?php echo $produit['stock']; ?></td>
                <td><img src="../images/<?php echo $produit['image']; ?>" width="50"></td>
                <td><!-- en plus de la possibilté de modifier et de supprimer les produits--> 
                    <a href="modifier_produit.php?id=<?php echo $produit['id']; ?>">Modifier</a> |
                    <a href="supprimer_produit.php?id=<?php echo $produit['id']; ?>" onclick="return confirmerSuppression()">Supprimer</a>
                </td>
            </tr>
           <?php } ?>
         </tbody>
        </table>

    <br>
    <a href="ajouter_produit.php" class="ajouter-produit">Ajouter un nouveau produit</a>
    <a href="../deconnexion.php" class="decon" onclick="return Deconnexion()" >Déconnexion</a>
</body>
</html>
