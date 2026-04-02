<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Point de Vente — CaisseShop</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/point-de-vente.css">
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
      <a href="point-de-vente.php" class="nav-item active">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        Point de vente
      </a>
      <a href="inventaire.php" class="nav-item">
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
    <div class="main-header">
      <h1 class="page-title">Point de Vente</h1>
      <div class="toolbar">
        <div class="search-box">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="text" placeholder="Rechercher un produit...">
        </div>
        <div class="scanner-box">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="16" rx="2"/><line x1="7" y1="9" x2="7" y2="15"/><line x1="10" y1="9" x2="10" y2="15"/><line x1="14" y1="9" x2="14" y2="15"/><line x1="17" y1="9" x2="17" y2="15"/></svg>
          <input type="text" placeholder="Scanner code-barres...">
        </div>
      </div>
    </div>

    <div class="product-grid">

      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1570913149827-d2ac84ab3f9a?w=200&h=200&fit=crop" alt="Pommes"></div>
        <p class="product-name">Pommes</p>
        <p class="product-price">2.50 €</p>
        <p class="product-stock">Stock: 45</p>
      </div>

      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?w=200&h=200&fit=crop" alt="Bananes"></div>
        <p class="product-name">Bananes</p>
        <p class="product-price">1.80 €</p>
        <p class="product-stock">Stock: 75</p>
      </div>

      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1547514701-42782101795e?w=200&h=200&fit=crop" alt="Oranges"></div>
        <p class="product-name">Oranges</p>
        <p class="product-price">3.00 €</p>
        <p class="product-stock">Stock: 40</p>
      </div>

      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1607305387299-a3d9611cd469?w=200&h=200&fit=crop" alt="Tomates"></div>
        <p class="product-name">Tomates</p>
        <p class="product-price">2.20 €</p>
        <p class="product-stock">Stock: 8</p>
      </div>

      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=200&h=200&fit=crop" alt="Carottes"></div>
        <p class="product-name">Carottes</p>
        <p class="product-price">1.50 €</p>
        <p class="product-stock">Stock: 60</p>
      </div>

      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=200&h=200&fit=crop" alt="Pain"></div>
        <p class="product-name">Pain</p>
        <p class="product-price">1.20 €</p>
        <p class="product-stock">Stock: 30</p>
      </div>

      <div class="product-card out-of-stock">
        <span class="out-badge">Rupture</span>
        <div class="product-img"><img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=200&h=200&fit=crop" alt="Croissant"></div>
        <p class="product-name">Croissant</p>
        <p class="product-price">1.50 €</p>
        <p class="product-stock stock-zero">Stock: 0</p>
      </div>

      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1608270586620-248524c67de9?w=200&h=200&fit=crop" alt="Coca-Cola"></div>
        <p class="product-name">Coca-Cola</p>
        <p class="product-price">1.80 €</p>
        <p class="product-stock">Stock: 100</p>
      </div>

      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1548839140-29a749e1cf4d?w=200&h=200&fit=crop" alt="Eau"></div>
        <p class="product-name">Eau</p>
        <p class="product-price">0.80 €</p>
        <p class="product-stock">Stock: 120</p>
      </div>

      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1613478223719-2ab802602423?w=200&h=200&fit=crop" alt="Jus d'orange"></div>
        <p class="product-name">Jus d'orange</p>
        <p class="product-price">2.10 €</p>
        <p class="product-stock">Stock: 22</p>
      </div>

      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1566478989037-eec170784d0b?w=200&h=200&fit=crop" alt="Chips"></div>
        <p class="product-name">Chips</p>
        <p class="product-price">1.60 €</p>
        <p class="product-stock">Stock: 54</p>
      </div>

      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1606312619070-d48b4c652a52?w=200&h=200&fit=crop" alt="Chocolat"></div>
        <p class="product-name">Chocolat</p>
        <p class="product-price">2.40 €</p>
        <p class="product-stock">Stock: 36</p>
      </div>

    </div>
  </main>

  <aside class="receipt">
    <h2 class="receipt-title">Ticket de Caisse</h2>
    <div class="receipt-items">
      <p class="receipt-empty">Panier vide</p>
    </div>
    <div class="receipt-footer">
      <div class="receipt-total">
        <span class="total-label">TOTAL</span>
        <span class="total-amount">0.00€</span>
      </div>
      <button class="btn-pay" disabled>Payer</button>
    </div>
  </aside>

</div>
</body>
</html>
