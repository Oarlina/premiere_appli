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
        <a href="recap.php">recap</a>
        <a>(
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
            ?>)
        </a>
    </nav>
    <section class="text">
        <h1>Ajouter un produit</h1>
        <form action="traitement.php" method="post"> <!-- creer un formulaire qui sera dans traitement et qui transmet les information via un formulaire -->
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
                    <input type="number" id="qtt" name="qtt" value="1">
                </label>
            </p>
            <p>
                <button><input type="submit" name="envoyer" class="button" value="Ajouter le produit"></button> <!-- boutton pour ajouter le produit -->
            </p>
        </form>
    </section>
    <!-- <script>
        var total=0 ;
        const button = document.querySelector("button");
        button.addEventListener("click",(function(total)
        {
            const qtt = document.getElementById("qtt").value;
            // alert(qtt);
            total += parseInt(qtt);
            alert(total);
        }));
        console.log(total);
    </script> -->
</body>
</html>






