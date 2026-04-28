<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion — CaisseShop</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/login.css">
</head>
<body>

  <div class="card">
    <div class="logo-wrap">
      <img src="../images/logo-removebg-preview.png" alt="CaisseShop">
    </div>

    <h1 class="card-title">Connexion</h1>

    <form class="form" action="submit_login.php" method="POST">

      <div class="form-group">
        <label class="form-label" for="email">Adresse email</label>
        <div class="input-wrap">
          <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
          </svg>
          <input class="form-input" type="email" id="email" name="email" placeholder="admin@caisseshop.fr" autocomplete="email" required>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label" for="password">Mot de passe</label>
        <div class="input-wrap">
          <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
          <input class="form-input" type="password" id="password" name="password" placeholder="••••••••" autocomplete="current-password" required>
        </div>
      </div>
      
      <?php 
      if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])){
          echo $_SESSION['LOGIN_ERROR_MESSAGE'];
          unset($_SESSION['LOGIN_ERROR_MESSAGE']);
      } 
      ?>

      <div class="forgot">
        
      </div>

      <button type="submit" class="btn-submit">Se connecter</button>

    </form>

    <p class="card-footer">
      CaisseShop &copy; 2026 &mdash; <span>Logiciel de Caisse &amp; Gestion</span>
    </p>
  </div>

</body>
</html>
