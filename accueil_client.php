<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil Client</title>
    <link href="css/style.css" rel="stylesheet">
    <script src="js/script.js"></script>
</head>
<body>
    <?php 
    session_start();
     include_once("include/db_connect.php");
     if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){ //si on est connecté et qu'on est admin
        echo "<header>Bienvenue sur votre espace administrateur</header>";
        echo "<h2>Bienvenue, administrateur !</h2>";
        echo "<div class='form'>";
        echo "<a class ='button' href='admin/afficher_produits.php'>Gérer les produits</a><br>";
        echo "<a class='button' href='admin/ajouter_produit.php'>Ajouter un produit</a><br>";
        echo "<a class='decon' href='deconnexion.php' onclick='return Deconnexion()'>Se déconnecter</a>";
        echo "</div>";
      }
     elseif(isset($_SESSION['id']) ){   //si on est connecté et qu'on est pas admin
        $id =$_SESSION['id'];
        $sql = "SELECT * FROM clients WHERE id=$id";
        $resultat = $dblink->query($sql);
       
        if($resultat && $resultat->num_rows > 0){
        $client = $resultat->fetch_assoc();
        $nom = $client['nom']; //on récupère le nom du client

    ?>
    <header>Bienvenue sur votre espace client <?php echo $nom ?> </header>  <!-- on lui affiche un joli message de bienvenu-->

    <h2>Que souhaitez-vous faire ?</h2>
    <div class="form">
    
        <a class="button" href="index.php">Voir les produits</a>
        <a class ="button" href="client/panier.php">Voir mon panier</a>
        <a class ="decon"onclick = "return Deconnexion()" href="deconnexion.php">Se déconnecter</a>
    
    </div>
  <?php }}
    ?>
</body>
</html>
