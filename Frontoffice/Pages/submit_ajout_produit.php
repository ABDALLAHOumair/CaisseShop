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
    && !empty($postData['nom_produit']) 
    && !empty($postData['description']) 
    && !empty($postData['code_barre']) 
    && !empty($postData['prix']) 
    && !empty($postData['stock'])) {
        $insertProduit='INSERT INTO produits(Nom_produit, Description, Prix, Code_barre, Stock) VALUE(:Nom_produit, :Description, :Prix, :Code_barre, :Stock)';
        $insertionProduit=$mysqlClient->prepare($insertProduit);
        $insertionProduit->execute([
            'Nom_produit' => $_POST['nom_produit'],
            'Description' => $_POST['description'],
            'Prix' => $_POST['prix'],
            'Code_barre' => $_POST['code_barre'],
            'Stock' => $_POST['stock'],
        ]);
        redirectToUrl('inventaire.php');
}
?>