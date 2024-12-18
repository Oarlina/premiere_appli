<?php

session_start(); // information récupérer via le GET ou le POST ou via le cookie

if (isset($_GET['action']))
{
    switch ($_GET['action'])
    {
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
                    $_SESSION['message']= "<section class='messageTrue'>Produit ajouté</section>";
                }else {
                    $_SESSION['message']= "<section class='messageFalse'>Refaire le formulaire</section>";
                }
            }
            break;

        case "delete":
            $index = $_GET['id']; // on crée  la valeur de l'indentation du tableau a supprimer
            $nom = $_GET['name']; // on cree la variable qui contiendra le nom du produit pour pouvoir l'afficher
            $_SESSION['message']= "<p>$nom a ete sup</p>"; // on affiche que le produit a ete supprimer et on dit lequel
            UNSET($_SESSION['produits'][$index]); // on supprime le produit du tableau 
            break;
        case "clear":
            UNSET($_SESSION['produits']); // on vide le tableau
                $_SESSION['message']= "<p>Tout a ete supprimé</p>"; // on affiche que le tableau a ete vider

            break;
        case "up-qtt":
            //
            break;
        case "down-qtt":
            //
            break;
    }
}



header("Location:index.php"); // c'est une redirection a la page index


?>
