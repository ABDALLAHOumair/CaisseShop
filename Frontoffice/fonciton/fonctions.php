<?php
require_once(__DIR__ . '/../fonciton/ConnexionBDD.php');
function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}


//Requête select des produit
$selectProduit='SELECT * FROM produits';
$selection_Produit=$mysqlClient->prepare($selectProduit);
$selection_Produit->execute();
$listeProduit=$selection_Produit->fetchAll();
?>