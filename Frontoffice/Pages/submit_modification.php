
<?php
session_start();

if (!$_SESSION['LOGGED_USER']) {
    header("Location: login.php");
    exit;
}

require_once(__DIR__ . '/../fonciton/fonctions.php');
require_once(__DIR__ . '/../fonciton/ConnexionBDD.php');

$postData = $_POST;

if (isset($postData['id_produit'])
    && isset($postData['nom_produit'])
    && isset($postData['description'])
    && isset($postData['code_barre'])
    && isset($postData['prix'])
    && isset($postData['stock'])
    && !empty($postData['id_produit'])
    && !empty($postData['nom_produit'])
    && !empty($postData['description'])
    && !empty($postData['code_barre'])
    && !empty($postData['prix'])
    && !empty($postData['stock'])) {

    //Récupérer l'ancienne image en BDD
    $getProduit = $mysqlClient->prepare('SELECT ImgChemin FROM produits WHERE Id = :Id');
    $getProduit->execute([
        'Id' => $postData['id_produit']]);
    $ancienProduit = $getProduit->fetch(PDO::FETCH_ASSOC);
    
    $ancienneImage = $ancienProduit['ImgChemin']; 

    //Dans le cas où une nouvelle image est envoyée
    if (isset($_FILES['ImgProduit']) && $_FILES['ImgProduit']['error'] === 0) {

        $target_dir = "imgUtilisateur/";

        //On vérifie que c'est bien une image
        $check = getimagesize($_FILES["ImgProduit"]["tmp_name"]);
        if ($check === false) {
            $_SESSION['ERROR_MESSAGE'] = "Le fichier n'est pas une image valide.";
            die(redirectToUrl('inventaire.php'));
        }

        //On vérifie la taille
        if ($_FILES["ImgProduit"]["size"] > 500000) {
            $_SESSION['ERROR_MESSAGE'] = "L'image est trop lourde (max 500Ko).";
            die(redirectToUrl('inventaire.php'));
        }

        //On Vérifie l'extension
        $imageFileType = strtolower(pathinfo($_FILES["ImgProduit"]["name"], PATHINFO_EXTENSION));
        $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($imageFileType, $extensionsAutorisees)) {
            $_SESSION['ERROR_MESSAGE'] = "Format d'image non autorisé.";
            die(redirectToUrl('inventaire.php'));
        }

        //On génére un nom unique pour éviter les conflits
        $nom_fichier = uniqid('produit_') . '.' . $imageFileType;
        $target_file = $target_dir . $nom_fichier;

        //On déplace le fichier (seulement après toutes les vérifications)
        if (!move_uploaded_file($_FILES["ImgProduit"]["tmp_name"], $target_file)) {
            $_SESSION['ERROR_MESSAGE'] = "Erreur lors de l'upload de l'image.";
            die(redirectToUrl('inventaire.php'));
        }

        //On supprime l'ancienne image du serveur si elle existe
        if ($ancienneImage && file_exists($ancienneImage)) {
            unlink($ancienneImage);
        }

        // UPDATE avec la nouvelle image
        $UpdateProduit = $mysqlClient->prepare('UPDATE produits SET Nom_produit  = :Nom_produit, Description  = :Description, Prix = :Prix, Code_barre = :Code_barre, Stock = :Stock, ImgChemin = :Img WHERE Id = :Id');
        $UpdateProduit->execute([
            'Id' => $postData['id_produit'],
            'Nom_produit' => $postData['nom_produit'],
            'Description' => $postData['description'],
            'Prix' => $postData['prix'],
            'Code_barre' => $postData['code_barre'],
            'Stock' => $postData['stock'],
            'Img' => $target_file,
        ]);

    //Dans le cas où il n'y a pas de nouvelle envoie d'image (on garde l'ancienne)
    } else {
        $UpdateProduit = $mysqlClient->prepare(' UPDATE produits SET Nom_produit = :Nom_produit, Description = :Description, Prix = :Prix, Code_barre = :Code_barre, Stock = :Stock WHERE Id = :Id');
        $UpdateProduit->execute([
            'Id'=> $postData['id_produit'],
            'Nom_produit' => $postData['nom_produit'],
            'Description' => $postData['description'],
            'Prix' => $postData['prix'],
            'Code_barre' => $postData['code_barre'],
            'Stock' => $postData['stock'],
        ]);
    }

    die(redirectToUrl('inventaire.php'));

} else {
    $_SESSION['ERROR_MESSAGE'] = "Données manquantes ou incorrectes lors de la modification.";
    die(redirectToUrl('inventaire.php'));
}
?>