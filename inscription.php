<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Inscription</title>
        <link href="css/style.css" rel="stylesheet"> 
        
    </head> 
    <body>
    <header>Bienvenue sur notre site de vente en ligne de sacs</header>
    <h2>Inscrivez-vous pour bénéficiez d'une reduction de 10% sur l'ensemble de notre collection à couper le soufle !</h2>
        <div class="form">
            <form onsubmit="return verifFormulaire()" action="#" method="POST">
              <label>Nom : <input type="text" name="nom" id="nom" required></label><br>
              <label>Email :<input type="text" name="email" id="email" required></label><br>
              <label>Mot de passe :<input type="password" name="motdepasse" id="motdepasse"></label><br>
              <label>Confirmez votre mot de passe: <input type="password" name="motdepasseconfirm" id="motdepasseconfirm" required></label><br>
              <button type="submit" >Inscription</button>
            </form>
        </div>

        <?php 
          session_start();     //obligatoire quand on utilise les sessions
           require_once("include/db_connect.php"); //pour la connexion à la base
         
           if(isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['motdepasse'])){  //si toutes les informations ont bien été saisies 
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $motdepasse = $_POST['motdepasse'];
            $sql = "INSERT INTO clients(nom,email,motdepasse) VALUES ('$nom','$email','$motdepasse')";  //on insere le nouveau client dans la BD
            $resultat = $dblink->query($sql);
            if($resultat){  //tout s'est bien passé
                $_SESSION['id'] = $dblink->insert_id;     
                echo "Client ajouté avec succès";
                echo "<a href='accueil_client.php'>Acceder</a>";
            } else {
                echo "Erreur lors de l'ajout";
            }
           }
        ?>
        <script src="js/script.js"></script>
       </body>
       </html> 
 