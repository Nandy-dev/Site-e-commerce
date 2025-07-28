<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Produits</title>
        <link href="../css/style.css" rel="stylesheet">
    </head> 
    <body>
    <header>Bienvenue sur notre site de vente en ligne de sacs</header>
    <h2>Fontionnalité réservée aux administrateurs du site</h2>
        <div class="form">
        <form action="#" method="POST">    <!-- un formulaire pour ajouter un produit-->
          <label>Nom du produit : <input type="text" name="nom" required></label><br>
          <label>Prix : <input type="number" step="0.01" name="prix" required></label><br>
          <label>Image (URL) : <input type="text" name="image"></label><br>
          <label>Description : <textarea name="description" required></textarea></label><br>
          <label>Stock : <input type="number" step="1" min="0" name="stock" required></label><br>
          <button type="submit">Ajouter le produit</button>
        </form>
        </div>

        <div class="messages">
        <?php 
           require_once("../include/db_connect.php");
           //on s'assure que tous les champs soient saisis
           if(isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['image']) && isset($_POST['description']) && isset($_POST['stock'])){
            $nom = $_POST['nom'];
            $prix = $_POST['prix'];
            $image = $_POST['image'];
            $description =$_POST['description'];
            $stock = $_POST['stock'];
            $sql = "INSERT INTO produits (nom,prix,image,description,stock) VALUES ('$nom','$prix','$image','$description','$stock')";
            $resultat = $dblink->query($sql);
            if($resultat){  //si tout s'est bien passé
                echo "<h2>Produit ajouté avec succès</h2>";
            } else {
                echo "<h2>Erreur lors de l'ajout</h2>";
            }
           }
        ?>
         <a href='afficher_produits.php' class='button'>Retour à la page de gestion</a>
        </div>
        </body>
        </html>