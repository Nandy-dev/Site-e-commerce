<?php
    session_start();  //pour démarrer la session, obligatoire avec les variables de session
    require_once("../include/db_connect.php"); //pour se connecter à la base,obligatoire
    if(isset($_GET['id'])){      //si id est rempli
        $id=$_GET['id'];
        $sql="SELECT * from produits where id = $id";   //on récupère les informations relatives à cet id
        $resultat = $dblink->query($sql);
        if($resultat && $resultat->num_rows > 0){   //si il y a des lignes alors le produit existe
          $produit = $resultat->fetch_assoc();   //on récupère ses informations grâce à fetch_assoc()
          //si les champs ont été rempli
          if(isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['stock']) && isset($_POST['image']) && isset($_POST['description'])){
          $nom = $_POST['nom'];  //on met à jour chaque champ
          $prix = $_POST['prix'];
          $stock = $_POST['stock'];
          $image = $_POST['image'];
          $description = $_POST['description'];
          //grâce à update on met à jour dans la base
          $sql = "UPDATE produits SET nom='$nom', prix='$prix', stock='$stock',image='$image',description='$description' where id=$id";
          if($dblink->query($sql)){
            echo "Produit modifié avec succès";
          
          }else{
            echo "Erreur lors de la modification";
          }
          }
        }else{   //si pas de lignes le produit n'existe pas
            echo "Produit introuvable";
        }
    }else{ //si le champ id n'est pas rempli 
        echo "Produit non spécifié";
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des produits</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
        <h1>Modifier un produit</h1>
    <div class="form">
    <form action="#" method="POST"> 
        <!-- les champs sont préremplis par les anciennes valeurs pour faciliter la modification c'est pour ça que le php est mis au début-->
        <label>Nom du produit : 
        <input type="text" name="nom" value="<?php echo $produit['nom']; ?>" required>
        </label><br>
        <label>Prix : 
          <input type="number" step="0.01" name="prix" value="<?php echo $produit['prix']; ?>" required>
        </label><br>

        <label>Image (URL) : 
            <input type="text" name="image" value="<?php echo $produit['image']; ?>">
        </label><br>

        <label>Description : 
            <textarea name="description" required><?php echo $produit['description']; ?></textarea>
        </label><br>

        <label>Stock : 
           <input type="number" step="1" min="0" name="stock" value="<?php echo $produit['stock']; ?>" required>
        </label><br>

        <button type="submit">Modifier le produit</button>
    </form>
    </div>
    <a href='afficher_produits.php' class='button'>Retour à la page de gestion</a> 
</body>
</html>

    
