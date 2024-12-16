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
                    <input type="text" name="prix" step="any"> 
                </label>
            </p>
            <p>
                <label>
                    Quantité désirée : 
                    <input type="text" name="qtt" value="1">
                </label>
            </p>
            <p>
                <input type="submit" name="envoyer" class="button" value="Ajouter le produit"> <!-- boutton pour ajouter le produit -->
            </p>
        </form>
    </section>
</body>
</html>






