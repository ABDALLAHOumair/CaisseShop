<?php 
session_start();

if (!$_SESSION['LOGGED_USER']) {
    header("Location: login.php");
exit;
}

require_once(__DIR__ . '/../fonciton/fonctions.php');
require_once(__DIR__ . '/../fonciton/ConnexionBDD.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détail de vente — CaisseShop</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/detail-vente.css">
</head>
<body>
<div class="app">

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-logo">
      <img src="../images/logo-removebg-preview.png" alt="CaisseShop">
    </div>
    <nav class="sidebar-nav">
      <a href="point-de-vente.php" class="nav-item">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        Point de vente
      </a>
      <a href="inventaire.php" class="nav-item">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
        Inventaire
      </a>
      <a href="historique.php" class="nav-item active">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        Historique
      </a>
    </nav>
    <div class="sidebar-bottom">
      <a href="#" class="nav-item">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        <?php 
        if (isset($_SESSION['LOGGED_USER'])){
          echo $_SESSION['LOGGED_USER']['nom'].' '.$_SESSION['LOGGED_USER']['prenom'];
        } 
        ?>
      </a>
      <a href="login.html" class="btn-logout">Déconnexion</a>
    </div>
  </aside>

  <!-- Main -->
  <main class="main">

    <!-- Flèche retour -->
    <a href="historique.php" class="btn-back">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
        <path d="M19 12H5m7-7-7 7 7 7"/>
      </svg>
    </a>

    <!-- Titre page -->
    <div class="page-header">
      <h1 class="page-title">Detail de vente</h1>
      <p class="page-subtitle">Consulter les informations de la vente.</p>
    </div>

    <!-- Ticket -->
    <div class="ticket">

      <h2 class="ticket-title">Ticket de Caisse</h2>
      <?php
      $selectPanier='SELECT vt.Id, pr.Nom_produit, pa.Quantite, pr.Prix FROM paniers pa
      JOIN ventes vt ON pa.Id_vente = vt.Id
      JOIN produits pr ON pa.Id_produit = pr.Id
      WHERE pa.Id_vente=:Id_vente';
      $selection_Panier=$mysqlClient->prepare($selectPanier);
      $selection_Panier->execute([
          'Id_vente' => $_GET['id_vente'],
          ]);
      $listePanier=$selection_Panier->fetchAll();
      
      //Requête select des ventes
      $selectVente='SELECT * FROM ventes WHERE Id=:Id';
      $selection_Vente=$mysqlClient->prepare($selectVente);
      $selection_Vente->execute([
          'Id' => $_GET['id_vente'],
          ]);
      $listeVente=$selection_Vente->fetchAll();
      ?>
      <div class="ticket-meta">
        <p>Date : <?php echo $listeVente[0]['Date'] ?></p>
        <p>Caissiée : <?php echo $_SESSION['LOGGED_USER']['nom'].' '.$_SESSION['LOGGED_USER']['prenom']?></p>
      </div>

      <div class="ticket-divider"></div>

        
      <?php for ($i=0; $i < count($listePanier); $i++) { ?>

        <div class="ticket-lines">

          <div class="ticket-line">
            <span class="line-name"><?php echo $listePanier[$i]['Nom_produit'] ?></span>
            <span class="line-qty">x<?php echo $listePanier[$i]['Quantite'] ?></span>
            <span class="line-price"><?php echo $listePanier[$i]['Prix'] ?> €</span>
          </div>


        </div>

        <div class="ticket-divider"></div> 
      <?php }?>
        <div class="ticket-total">
          <span class="total-label">TOTAL</span>
          <span class="total-amount"><?php echo $listeVente[0]['Total'] ?> €</span>
        </div>
    </div>

    <!-- Bouton imprimer -->
    <button class="btn-print" onclick="window.print()">Imprimer</button>

  </main>
</div>
</body>
</html>
