<?php
session_start();
// if (!$_SESSION['LOGGED_USER']) {
//     header("Location: login.php");
// exit;
// }
require_once(__DIR__ . '/../fonciton/fonctions.php');
require_once(__DIR__ . '/../fonciton/ConnexionBDD.php');

if (isset($_POST['produits']) && isset($_POST['total'])) {
    $produits = $_POST['produits'];
    
    for ($i = 0; $i < count($produits); $i++) {
        echo $_POST['produits'][$i]['id'];
        echo '<br/>';
        echo $_POST['produits'][$i]['quantite'];
        echo '<br/>';
        echo $_POST['total'];
        echo '<br/>';
        echo '<br/>';
    }
}
