<?php
session_start();

if (!$_SESSION['LOGGED_USER']) {
    header("Location: login.php");
exit;
}

require_once(__DIR__ . '/../fonciton/fonctions.php');
require_once(__DIR__ . '/../fonciton/ConnexionBDD.php');

if (isset($_POST['produits']) && isset($_POST['total'])) {
    
    $produits = $_POST['produits'];

    // Ajout dans la table ventes
    $insertVente='INSERT INTO ventes (Id_user,  Total) VALUE(:Id_user, :Total)';
    $insertVente=$mysqlClient->prepare($insertVente);
    $insertVente->execute([
        'Id_user' => $_SESSION['LOGGED_USER']['user_id'],
        'Total' =>$_POST['total'],
    ]);

    //Recupération des ventes
    $selectVente='SELECT Id FROM ventes 
    WHERE Id_user =:Id_user 
    ORDER BY Id DESC';
    $selection_Vente=$mysqlClient->prepare($selectVente);
    $selection_Vente->execute([
        'Id_user' => $_SESSION['LOGGED_USER']['user_id'],
    ]);
    $listeVente=$selection_Vente->fetchAll();

    //Recupération de la dernière vente
    $DerniereVente = $listeVente[0]['Id'];

    // Ajout des produits dans la table paniers
    for ($i = 0; $i < count($produits); $i++) {
        $insertPanier='INSERT INTO paniers (Id_produit, Id_vente, Quantite) VALUE(:Id_produit, :Id_vente, :Quantite)';
        $insertPanier=$mysqlClient->prepare($insertPanier);
        $insertPanier->execute([
            'Id_produit' => $_POST['produits'][$i]['id'],
            'Id_vente' => $DerniereVente,
            'Quantite' => $_POST['produits'][$i]['quantite'],
        ]);
    }

    // Diminution du stock
    for ($i = 0; $i < count($produits); $i++) {

        //Requête select du produit visé
        $ProduitTarget='SELECT * FROM produits WHERE Id=:Id';
        $selection_Produit_Target=$mysqlClient->prepare($ProduitTarget);
        $selection_Produit_Target->execute([
            'Id' => $_POST['produits'][$i]['id'],
        ]);
        $Produit=$selection_Produit_Target->fetchAll();

        // Définition du nouveau stock
        $newStock=$Produit[0]['Stock'] - $_POST['produits'][$i]['quantite'];

        $UpdateProduit=$mysqlClient->prepare('UPDATE produits SET Stock=:Stock WHERE Id=:Id');
        $UpdateProduit->execute([
            'Id' => $_POST['produits'][$i]['id'],
            'Stock' => $newStock,
        ]); 
    }

    $_SESSION['SUCCESS_MESSAGE'] = 
    "Payement effectué avec succé.";
    die(redirectToUrl('point-de-vente.php'));
}
else {
    $_SESSION['ERROR_MESSAGE'] = 
    "Payement refusé.";
    die(redirectToUrl('point-de-vente.php'));
}

