<?php
session_start();

if (!$_SESSION['LOGGED_USER']) {
    header("Location: login.php");
exit;
}

require_once(__DIR__ . '/../fonciton/fonctions.php');
require_once(__DIR__ . '/../fonciton/ConnexionBDD.php');
$postData = $_POST;

// if (isset($postData['id_produit']) 
//     && isset($postData['nom_produit']) 
//     && isset($postData['description']) 
//     && isset($postData['code_barre']) 
//     && isset($postData['prix']) 
//     && isset($postData['stock'])
//     && isset($postData['ImgProduit'])
//     && !empty($postData['id_produit']) 
//     && !empty($postData['nom_produit']) 
//     && !empty($postData['description']) 
//     && !empty($postData['code_barre']) 
//     && !empty($postData['prix']) 
//     && !empty($postData['stock'])
//     && !empty($postData['ImgProduit'])) {
  


$target_dir ="imgUtilisateur/";

$target_file = $target_dir . basename($_FILES["ImgProduit"]["name"]);

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


move_uploaded_file($_FILES["ImgProduit"]["tmp_name"], $target_file);
    
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
// }
?>