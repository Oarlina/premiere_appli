<?php
session_start();
var_dump($_SESSION['produits']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premiere Appli</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="recap.php">recap (
            <?php 
            if (!(!isset($_SESSION['qtts']) || empty($_SESSION['qtts']))) // si le panier n'est pas vide
            {
                echo $_SESSION['qtts']; // on affiche le nombre de produit a recap
            } else {
                echo "0";
            }
            ?>)
        </a>
    </nav>
    <section class="text">
        <h1>Ajouter un produit</h1>
        <form action="traitement.php?action=add" method="post"> <!-- creer un formulaire qui sera dans traitement et qui transmet les information via un formulaire -->
            <p>
                <label> <!-- premiere legende du formulaire-->
                    Nom du produit :
                    <input type="text" name="nom"> <!-- Zone ou remplir le nom du produit -->
                </label>
            </p>
            <p>
                <label>
                    Prix du produit : 
                    <input type="float" name="prix" step="any"> 
                </label>
            </p>
            <p>
                <label >
                    Quantité désirée : 
                    <input type="number" name="qtt" value="1">
                </label>
            </p>
            <p>
                <button>
                    <input type="submit" name="envoyer" value="Ajouter le produit">
                </button> <!-- boutton pour ajouter le produit -->
            </p>
        </form>
    </section>
    <section class="message">
        <?php
    

        if (isset($_SESSION["message"])) { // si la superglobale message n'est pas vide
            echo $_SESSION["message"];
            unset($_SESSION["message"]); // vide la superglobale message
        }
    
        ?>
    </section>
            

</body>
</html>






