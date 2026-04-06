<?php 
session_start();
require_once(__DIR__ . '/../fonciton/fonctions.php');
require_once(__DIR__ . '/../fonciton/ConnexionBDD.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventaire — CaisseShop</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/inventaire.css">
</head>
<body>
<div class="app">

  <aside class="sidebar">
    <div class="sidebar-logo">
      <img src="../images/logo-removebg-preview.png" alt="CaisseShop">
    </div>
    <nav class="sidebar-nav">
      <a href="#" class="nav-item">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        Tableau de bord
      </a>
      <a href="point-de-vente.php" class="nav-item">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        Point de vente
      </a>
      <a href="inventaire.php" class="nav-item active">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
        Inventaire
      </a>
      <a href="historique.php" class="nav-item">
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
      <a href="deconnexion.php" class="btn-logout">Déconnexion</a>
    </div>
  </aside>

  <main class="main">

    <div class="page-header">
      <div>
        <h1 class="page-title">Inventaire</h1>
        <p class="page-subtitle">Gérez vos produits et stocks</p>
      </div>
      <a href="ajouter-produit.php" class="btn-add">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Ajouter un produit
      </a>
    </div>

    <div class="search-wrap">
      <form action="inventaire.php" method="post" class="search-box">
        <button style="text-decoration: none" type="submit"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></button>
        <input type="text" name="recherche" placeholder="Rechercher par nom ou code-barres..." value="<?php echo isset($_POST['recherche']) ? $_POST['recherche'] : ''; ?>">
      </form>
    </div>

    <div class="table-wrap">
      <table class="table">
        <thead>
          <tr>
            <th class="th-produit">Produit</th>
            <th>Code-barres</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <?php foreach ($listeProduit as $produit) {?>
          <tbody>
            <tr>
              <td class="td-product"><img src="https://images.unsplash.com/photo-1570913149827-d2ac84ab3f9a?w=80&h=80&fit=crop" alt="Pommes"><span><?php echo $produit['Nom_produit'] ?></span></td>
              <td class="td-code"><?php echo $produit['Code_barre'] ?></td>
              <td class="td-desc"><?php echo $produit['Description'] ?></td>
              <td class="td-price"><?php echo $produit['Prix'].' €' ?></td>
              <td><?php echo $produit['Stock'] ?></td>
              <td><span class="badge badge-stock">En stock</span></td>
              <td class="td-actions">
                <a href="modifier-produit.php?id_produit=<?php echo $produit['Id']?>" class="btn-icon edit" title="Modifier"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></a>
                <form action="suppression_produit.php" method="post">
                  <input type="hidden" name="id_produit" value="<?php echo $produit['Id']?>">
                  <button type="submit" class="btn-icon delete" title="Supprimer"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6m4-6v6"/><path d="M9 6V4h6v2"/></svg></button>
                </form>
              </td>
            </tr>
          </tbody>
        <?php  } ?>
      </table>
    </div>

  </main>
</div>
</body>
</html>
