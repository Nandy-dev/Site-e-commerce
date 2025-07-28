<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Commandes</title>
        <link href="../css/style.css" rel="stylesheet">
    </head>
    <header>Bienvenue sur notre site de vente en ligne de sacs</header>
    <div class="messages">
    <?php 
    session_start();
    require_once("../include/db_connect.php");
    if(isset($_SESSION['id'])){  //si on est connecté
        $id_client = $_SESSION['id'];
        $sql = "INSERT INTO commandes(id_client,date_commande)VALUES('$id_client',NOW())"; //on insere dans commandes qu'une commande a été passé
        $resultat = $dblink->query($sql);
       if($resultat){
           $id_commande = $dblink->insert_id;
           //on met un id_commande valide (pas nul) pour dire que la commande a été validé
           $sql = "UPDATE details_commande SET id_commande = $id_commande where id_commande is NULL and id_client=$id_client";
           $dblink->query($sql);

            echo"<h2>Commande validée avec succès</h2>";
            echo "En attendant de recevoir vos produits, venez découvrir nos nouveaux arrivages toujours à des prix inoubliables !<br>";
            echo"<a href='../index.php' class='button'>Venez découvir nos nouveaux produits !</a>";
        }else{
           echo " Erreur lors de la validation";
        }
    }else{
        echo "Client non trouvé";
    }
    ?>
    </div>

    
