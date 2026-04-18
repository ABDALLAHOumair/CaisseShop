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


//Requête select des ventes
$selectVente='SELECT * FROM ventes';
$selection_Vente=$mysqlClient->prepare($selectVente);
$selection_Vente->execute();
$listeVente=$selection_Vente->fetchAll();
?>