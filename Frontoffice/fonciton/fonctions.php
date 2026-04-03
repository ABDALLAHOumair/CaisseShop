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

$selectVente='SELECT vt.Id, pr.Nom_produit FROM paniers pa
JOIN ventes vt ON pa.Id_vente = vt.Id
JOIN produits pr ON pa.Id_produit = pr.Id
WHERE pa.Id_vente=:Id_vente';
$selection_Vente=$mysqlClient->prepare($selectVente);
$selection_Vente->execute([
    'Id' => $_POST['id_postulation'],
    ]);
$listeVente=$selection_Vente->fetchAll();

?>