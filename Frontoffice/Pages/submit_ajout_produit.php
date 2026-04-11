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


    $target_dir ="imgUtilisateur/";
    
    $target_file = $target_dir . basename($_FILES["ImgProduit"]["name"]);
    
    $uploadOk = 1;

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // vérifie si l'image est actuellement une image
    $check = getimagesize($_FILES["ImgProduit"]["tmp_name"]);
    if($check !== false) {
        echo "Le fichier est une image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est une image.";
        $uploadOk = 0;
        }

    // Vérifie si le ficher existe déjà
    if (file_exists($target_file)) {
    echo "Desolé, le fichier existe déjà.";
    $uploadOk = 0;
    }

    // Vérification de la taille du fichier
    if ($_FILES["ImgProduit"]["size"] > 500000) {
    echo "Desolé, ton fichier est trop volumineux.";
    $uploadOk = 0;
    }

    // Autorisation qu'à certain type fichier
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "webp" ) {
    echo "Desolé, seulement les fichiers JPG, JPEG, PNG & WEBP sont autorisé.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["ImgProduit"]["tmp_name"], $target_file)) {
        echo "Le fichier ". htmlspecialchars( basename( $_FILES["ImgProduit"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }


//     $insertProduit='INSERT INTO produits(Nom_produit, Description, Prix, Code_barre, Stock, ImgChemin) VALUE(:Nom_produit, :Description, :Prix, :Code_barre, :Stock, :Img)';
//     $insertionProduit=$mysqlClient->prepare($insertProduit);
//     $insertionProduit->execute([
//         'Nom_produit' => $postData['nom_produit'],
//         'Description' => $postData['description'],
//         'Prix' => $postData['prix'],
//         'Code_barre' => $postData['code_barre'],
//         'Stock' => $postData['stock'],
//         'Img' =>  $target_file,
//     ]);
//    redirectToUrl('inventaire.php');
}
?>