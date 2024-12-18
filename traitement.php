<?php

session_start(); // information récupérer via le GET ou le POST ou via le cookie

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
        $_SESSION['message']= "Produit ajouté";
    }else {
        $_SESSION['message']= "Refaire le formulaire";
    }

}
header("Location:index.php"); // c'est une redirection a la page index


?>
