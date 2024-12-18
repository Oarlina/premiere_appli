<?php

// doit être mis en premier pour recuperer les informations du formulaire
session_start(); // information récupérer via le GET ou le POST ou via le cookie




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">acceuil (
            <?php // on implemente du php pour calculer le nombre de produit dans le panier
            $qtt = 0; 
            if (!(!isset($_SESSION['produits']) || empty($_SESSION['produits']))) // si le panier n'est pas vide
            {
                foreach ( $_SESSION['produits'] as $index => $produit  ) // on parcours le tableau des produits
                {
                    $qtt += $produit['qtt']; // on implemente le nombre de produit
                }
            }
            echo $qtt; // on retourne la quantite de tous les produits
            $_SESSION['qtts'] = $qtt;
            ?>)
        </a>
    </nav>
    <section class="text">
        <?php
        if (!isset($_SESSION['produits']) || empty($_SESSION['produits'])) // on verifie si session est different de null(existe) ou si elle est vide
        {
            echo "<p>Aucun produit en session </p>";
        } else 
        {
            // debut du tableau des produits
            echo "<table border 1 >",
                    "<thead>",
                        "<tr>",
                            "<th> # </th>",
                            "<th> Nom </th>",
                            "<th> Prix </th>",
                            "<th> Quantité </th>",
                            "<th> Total </th>",
                        "</tr>",
                    "</thead>",
                    "</tbody>";
            $totalGeneral = 0;
            $nbproduit = 0;
            // on parcours la clé produits avec la clé index et la valeur  produit
            foreach ( $_SESSION['produits'] as $index => $produit  )
            {
                echo "<tr>",
                        "<td>".$index."</td>",
                        "<td>".$produit['nom']."</td>",
                        "<td>".number_format($produit['prix'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td>".$produit['qtt']."</td>",
                        "<td>".number_format($produit['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "</tr>"; // on concatènes des éléments html
                $totalGeneral += $produit ['total']; // on ajoute le prix d'un produit au prixGeneral
                $nbproduit += $produit['qtt']; // on ajoute le nombre de produit mis dans le panier
            }
            echo "<tr>",
                    "<td colspan=4> Total général : </td>",
                    "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;"). "&nbsp;€</strong></td>",
                "</tr>",
                "</tbody>";
        }
        ?>
    </section>

</body>
</html>

