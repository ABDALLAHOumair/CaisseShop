<?php
session_start();

if (!$_SESSION['LOGGED_USER']) {
    header("Location: login.php");
    exit;
}

require_once(__DIR__ . '/../fonciton/fonctions.php');
require_once(__DIR__ . '/../fonciton/ConnexionBDD.php');

$postData = $_POST;

if (isset($postData['nom_produit'])
    && isset($postData['description'])
    && isset($postData['code_barre'])
    && isset($postData['prix'])
    && isset($postData['stock'])
    && isset($_FILES['ImgProduit'])
    && !empty($postData['nom_produit'])
    && !empty($postData['description'])
    && !empty($postData['code_barre'])
    && !empty($postData['prix'])
    && !empty($postData['stock'])
    && $_FILES['ImgProduit']['error'] === 0) {

    $target_dir = "imgUtilisateur/";

    // vérifie si l'image est actuellement une image
    $check = getimagesize($_FILES["ImgProduit"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['ERROR_MESSAGE'] = "Le fichier n'est pas une image valide.";
        die(redirectToUrl('ajouter-produit.php'));
    }

    // Vérification de la taille du fichier
    if ($_FILES["ImgProduit"]["size"] > 500000) {
        $_SESSION['ERROR_MESSAGE'] = "L'image est trop lourde (max 500Ko).";
        die(redirectToUrl('ajouter-produit.php'));
    }

    // Autorisation qu'à certain type fichier
    $imageFileType = strtolower(pathinfo($_FILES["ImgProduit"]["name"], PATHINFO_EXTENSION));
    $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'webp'];
    if (!in_array($imageFileType, $extensionsAutorisees)) {
        $_SESSION['ERROR_MESSAGE'] = "Format d'image non autorisé.";
        die(redirectToUrl('ajouter-produit.php'));
    }

    // Générer un nom unique
    $nom_fichier = uniqid('produit_') . '.' . $imageFileType;
    $target_file = $target_dir . $nom_fichier;

    // Si tout est ok upload l'image
    if (!move_uploaded_file($_FILES["ImgProduit"]["tmp_name"], $target_file)) {
        $_SESSION['ERROR_MESSAGE'] = "Erreur lors de l'upload de l'image.";
        die(redirectToUrl('ajouter-produit.php'));
    }

    // Insertion de l'image dans la BDD
    $insertProduit = 'INSERT INTO produits(Nom_produit, Description, Prix, Code_barre, Stock, ImgChemin) 
                      VALUES(:Nom_produit, :Description, :Prix, :Code_barre, :Stock, :Img)';
    $insertionProduit = $mysqlClient->prepare($insertProduit);
    $insertionProduit->execute([
        'Nom_produit' => $postData['nom_produit'],
        'Description' => $postData['description'],
        'Prix' => $postData['prix'],
        'Code_barre' => $postData['code_barre'],
        'Stock' => $postData['stock'],
        'Img' => $target_file,
    ]);

    die(redirectToUrl('inventaire.php'));

} else {
    $_SESSION['ERROR_MESSAGE'] = "Données manquantes ou incorrectes.";
    die(redirectToUrl('ajouter-produit.php'));
}
?>