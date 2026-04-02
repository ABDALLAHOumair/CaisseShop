<?php
session_start();
require_once(__DIR__ . '/../fonciton/fonctions.php');
require_once(__DIR__ . '/../fonciton/ConnexionBDD.php');

if (isset($_POST['id_produit']) && !empty($_POST['id_produit'])) {

    $deleteproduit= $mysqlClient->prepare('DELETE FROM produits WHERE Id = :Id');
        $deleteproduit->execute([
            'Id' => $_POST['id_produit'],
        ]);
    redirectToUrl('inventaire.php'); 
}
?>