<?php
// session_start();
// require_once(__DIR__ . '/../fonciton/fonctions.php');
// require_once(__DIR__ . '/../fonciton/ConnexionBDD.php');
// $postData = $_POST;

// if (isset($postData['id_produit']) 
//     && isset($postData['nom_produit']) 
//     && isset($postData['description']) 
//     && isset($postData['code_barre']) 
//     && isset($postData['prix']) 
//     && isset($postData['stock'])
//     && !empty($postData['id_produit']) 
//     && !empty($postData['nom_produit']) 
//     && !empty($postData['description']) 
//     && !empty($postData['code_barre']) 
//     && !empty($postData['prix']) 
//     && !empty($postData['stock'])) {
//         $UpdateProduit=$mysqlClient->prepare('UPDATE produits SET Nom_produit=:Nom_produit, Description=:Description, Reference=:Reference, Prix=:Prix, Code_barre=:Code_barre, Stock=:Stock WHERE Id=:Id');
//         $UpdateProduit->execute([
//             'Id' => $_POST['id_produit'],
//             'Nom_produit' => $_POST['nom_produit'],
//             'Description' => $_POST['description'],
//             'Reference' => $_POST['code_barre'],
//             'Prix' => $_POST['prix'],
//             'Code_barre' => $_POST['code_barre'],
//             'Stock' => $_POST['stock'],
//         ]);
//         redirectToUrl('inventaire.php');
// }
?>