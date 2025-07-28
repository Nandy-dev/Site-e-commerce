<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Connexion</title>
        <link href="css/style.css" rel="stylesheet">
    </head> 
    <body>
        <header>Bienvenue sur notre site de vente en ligne de sacs</header>
        <h2>Connectez-vous pour accéder à votre panier et voir nos nouveautés à couper le soufle !</h2>
        <div class="form">
        <form action="#" method="POST">
          <label>Email :<input type="text" name="email" required></label><br>
          <label>Mot de passe :<input type="password" name="motdepasse"></label><br>
          <button type="submit">Connexion</button>
        </form>
        </div>
         


        <?php
           session_start();     //pour démarrer la session
           require_once("include/db_connect.php"); //pour la connexion à la base
          
           if(isset($_POST['email']) && isset($_POST['motdepasse'])){  //si les champs sont bien remplis
            $email = $_POST['email'];
            $motdepasse = $_POST['motdepasse'];
            $sql = "SELECT *from clients where email='$email'";  //on récupère les informations correspondants à l'email
            $resultat = $dblink->query($sql);
            if($resultat ){
                $client = $resultat->fetch_assoc();
                if($client){ //un client existe avec cet email
                  if($motdepasse === $client['motdepasse']){  //on vérifie si le mot de passe est le bon
                    $_SESSION['id'] = $client['id'];
                    $_SESSION['role'] = $client['role'];
                    echo "Bienvenue ", $client['nom'],"!";
                    header("Location: accueil_client.php?id={$client['id']}");  //pour rediriger automatiquement sans avoir à cliquer sur un lien
                  }else{ 
                    echo "<div class='messages'>Mot de passe incorrect</div>";
                }
               }else{//si on ne trouve pas d'informations sur l'email entré
                echo "<div class='messages'>Pas d'utilisateur trouvé avec cet email<br>
                <a  href='inscription.php' >Pas de compte ? Inscrivez-vous ! </a></div>";
              
               }
            }  
           
            
           }
        ?>
    </body>
 </html> 
 