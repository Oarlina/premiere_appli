<?php

session_start(); // information récupérer via le GET ou le POST ou via le cookie

if (isset($_GET['action'])) // si le get action est pas vide
{
    switch ($_GET['action']) { // alors je regarde quel conditions je dois faire
        case "add":
            if (isset($_POST['envoyer'])) // si le formulaire a été envoyer 
            {
                // filter_input permet d'effectuer unevalidation ou un nettoyage des données sinon elle renvoie false ou rien
                $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //il supprime l'élément si la chaine de caractere contient des caracteres speciaux
                $prix = filter_input(INPUT_POST, "prix", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // float : valide uniquement les réels      fraction : permet l'utilisation de . ou , 
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT); // validera uniquement un entier different de 0
            
                if($nom && $prix && $qtt) // verifie si les variables sont vrai 
                {
                    $total = $prix * $qtt;
                    $produit = [ // creation d'un tableau associatif pour un produit
                        "nom" => $nom,
                        "prix" => $prix,
                        "qtt" => $qtt,
                        "total" => $total
                    ];

                    $_SESSION['produits'][] = $produit; // ajoute chaque produit dans le tableau SESSION et la clé produits (qui est crée si elle n'existe pas)
                    $_SESSION['message']= "<section class='message True'>Produit ajouté</section>"; // je stock une chaine dans une session message
                }else { //sinon
                    $_SESSION['message']= "<section class='message False'>Refaire le formulaire</section>"; // je stock une chaine dans une session message
                }
            }
            header("Location:index.php"); // c'est une redirection a la page index
            break;

        case "delete":
            $index = $_GET['id']; // on crée  la valeur de l'indentation du tableau a supprimer
            $nom = $_GET['name']; // on cree la variable qui contiendra le nom du produit pour pouvoir l'afficher
            $_SESSION['message']= "<p>$nom a ete supprimé</p>"; // on affiche que le produit a ete supprimer et on dit lequel
            UNSET($_SESSION['produits'][$index]); // on supprime le produit du tableau 
            header("Location:recap.php"); // c'est une redirection a la page index
            break;
        case "clear":
            UNSET($_SESSION['produits']); // on vide le tableau
            $_SESSION['message']= "<p>Tout a ete supprimé</p>"; // on affiche que le tableau a ete vider
            header("Location:recap.php"); // c'est une redirection a la page index
            break;

        case "up-qtt":
            $_SESSION['produits'][$_GET['id']]['qtt']++; // dans les produits je prend l'id du bouton cliquer et je rajoute 1 a qtt
            $_SESSION['produits'][$_GET['id']]['total'] += $_SESSION['produits'][$_GET['id']]['prix']; // j'augmente le prix du total
            header("Location:recap.php"); // je redirige vers la page recap
            break;
           
        case "down-qtt":
            if ($_SESSION['produits'][$_GET['id']]['qtt']>1) // si le produit a plus de 1 quantité
            {
                $_SESSION['produits'][$_GET['id']]['qtt']--; // elle retire 1 de quantité
                $_SESSION['produits'][$_GET['id']]['total'] -= $_SESSION['produits'][$_GET['id']]['prix']; // je retire le prix du produit au total ce qui remet a jour le total general
                header("Location:recap.php"); // je redirige vers la page recap
            } else //sinon
            {
                UNSET($_SESSION['produits'][$_GET['id']]); // je supprime le produit
            }
            header("Location:recap.php"); // je redirige vers la page recap
            break;
    }
}
?>
