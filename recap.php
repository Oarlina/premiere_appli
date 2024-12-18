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
            $_SESSION['qtts'] = $qtt; // on cree un tableau avec la quantite des produits
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
            echo "<table class='table' border 1>",
                    "<thead>",
                        "<tr>",
                            "<th class='thd'> # </th>",
                            "<th class='thd'> Nom </th>",
                            "<th class='thd'> Prix </th>",
                            "<th class='thd'> Quantité </th>",
                            "<th class='thd' colspan=3> Total </th>",
                        "</tr>",
                    "</thead>",
                    "</tbody>";
            $totalGeneral = 0;
            $nbproduit = 0;
            // on parcours la clé produits avec la clé index et la valeur  produit
            foreach ( $_SESSION['produits'] as $index => $produit  )
            {
                $nom = $produit['nom']; // on cree la variable nom 
                $qtt = $produit['qtt']; // on cree la variable qtt
                echo "<tr>",
                        "<td class='thd'>".$index."</td>",
                        "<td class='thd' >".$nom."</td>", // on reutilise la variable nom pour la mettre dans le tableau
                        "<td class='thd'>".number_format($produit['prix'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td class='thd'>".$qtt."</td>",
                        "<td class='thd'><button><a href='traitement.php?action=down-qtt&id=$qtt&name=$nom'> - </a></button></td>",
                        "<td class='thd'>".number_format($produit['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td class='thd'><button><a href='traitement.php?action=up-qtt&id=$qtt&name=$nom'&class=''> + </a></button></td>",
                        "<td class='thd'><button><a href='traitement.php?action=delete&id=$index&name=$nom'>vider</a></button></td>", // on recupere l'indentation du tableau et on met une action delete on recupere aussi le nom du produit pour pouvoir l'afficher dans l'acceuil
                    "</tr>"; // on concatènes des éléments html
                $totalGeneral += $produit ['total']; // on ajoute le prix d'un produit au prixGeneral
                $nbproduit += $produit['qtt']; // on ajoute le nombre de produit mis dans le panier
            }
            echo "<tr>",
                    "<td class='thd' colspan=7> Total général : </td>",
                    "<td class='thd'><strong>".number_format($totalGeneral, 2, ",", "&nbsp;"). "&nbsp;€</strong></td>",
                    "</tr>",
                    "<tr>",
                    "<td class='thd' colspan=8><a href='traitement.php?action=clear'>vider</a></td>",
                    "</tr>",
                "</tbody>";
        }
        ?>
    </section>

</body>
</html>

