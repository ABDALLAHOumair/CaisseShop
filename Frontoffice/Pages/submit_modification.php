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
    && isset($_FILES['ImgProduit'])
    && !empty($postData['id_produit']) 
    && !empty($postData['nom_produit']) 
    && !empty($postData['description']) 
    && !empty($postData['code_barre']) 
    && !empty($postData['prix']) 
    && !empty($postData['stock'])
    && $_FILES['ImgProduit']['error'] === 0) {
  


    $target_dir ="imgUtilisateur/";

    $target_file = $target_dir . basename($_FILES["ImgProduit"]["name"]);

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    move_uploaded_file($_FILES["ImgProduit"]["tmp_name"], $target_file);

    // vérifie si l'image est actuellement une image
    // $check = getimagesize($_FILES["ImgProduit"]["tmp_name"]);
    // if($check !== false) {
    //     echo "Le fichier est une image - " . $check["mime"] . ".";
    //     $uploadOk = 1;
    // } 
    // else {
    //     echo "Le fichier n'est une image.";
    //     $uploadOk = 0;
    //     die();
    // }
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }
        
    $UpdateProduit=$mysqlClient->prepare('UPDATE produits SET Nom_produit=:Nom_produit, Description=:Description, Prix=:Prix, Code_barre=:Code_barre, Stock=:Stock, ImgChemin=:Img WHERE Id=:Id');
    $UpdateProduit->execute([
        'Id' => $_POST['id_produit'],
        'Nom_produit' => $_POST['nom_produit'],
        'Description' => $_POST['description'],
        'Prix' => $_POST['prix'],
        'Code_barre' => $_POST['code_barre'],
        'Stock' => $_POST['stock'],
        'Img' => $target_file,
    ]);
    redirectToUrl('inventaire.php');
}
?>