<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modification — CaisseShop</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/form-produit.css">
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
    <a href="inventaire.php" class="btn-back">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M19 12H5m7-7-7 7 7 7"/></svg>
    </a>
    <div class="form-card">
      <h1 class="form-title">Modification</h1>
      <p class="form-subtitle">Modifiez les informations du produit.</p>
      <div class="form-layout">
        <div class="form-left">
          <div class="form-group">
            <label class="form-label">Nom du produit</label>
            <input class="form-input" type="text" value="Banane">
          </div>
          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea class="form-textarea">Banane croquante importer de la savane.</textarea>
          </div>
          <div class="form-group">
            <label class="form-label">Référence / Code-barres</label>
            <input class="form-input" type="text" id="ref-input" value="222222222">
          </div>
          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Prix</label>
              <input class="form-input" type="text" value="1.80 €">
            </div>
            <div class="form-group">
              <label class="form-label">stock</label>
              <input class="form-input" type="number" value="75">
            </div>
          </div>
          <button class="btn-save">Enregistrer</button>
        </div>
        <div class="form-right">
          <div class="img-box" id="img-box">
            <img id="preview-img" src="https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?w=500&h=320&fit=crop" alt="Bananes">
          </div>
          <label class="btn-import">
            importer une image
            <input type="file" accept="image/*" onchange="previewImage(event)">
          </label>
          <div class="barcode-section">
            <p class="form-label">Code-barres</p>
            <div class="barcode-box" id="barcode-box"></div>
            <button class="btn-generate" onclick="generateBarcode()">Générer un code barres</button>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<script>
function previewImage(e) {
  const file = e.target.files[0];
  if (!file) return;
  const r = new FileReader();
  r.onload = ev => {
    const img = document.getElementById('preview-img');
    const box = document.getElementById('img-box');
    img.src = ev.target.result;
    img.style.display = 'block';
    if (box) box.classList.remove('img-box--empty');
    const icon = document.querySelector('.img-placeholder-icon');
    if (icon) icon.style.display = 'none';
  };
  r.readAsDataURL(file);
}
function generateBarcode() {
  const val = document.getElementById('ref-input').value.replace(/\D/g,'') || '000000000';
  const box = document.getElementById('barcode-box');
  box.innerHTML = '';
  const svg = document.createElementNS('http://www.w3.org/2000/svg','svg');
  svg.setAttribute('width','100%'); svg.setAttribute('height','64');
  const pattern = [3,1,2,1,3,2,1,2,3,1,2,3,1,2,1,3,2,1,3,1,2,1,2,3];
  let x = 6;
  for (let i = 0; i < val.length * 3; i++) {
    const w = pattern[i % pattern.length];
    if (i % 2 === 0) {
      const rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
      rect.setAttribute('x', x); rect.setAttribute('y', 6);
      rect.setAttribute('width', w); rect.setAttribute('height', 48);
      rect.setAttribute('fill', '#1A1A2E');
      svg.appendChild(rect);
    }
    x += w + 1;
  }
  const txt = document.createElementNS('http://www.w3.org/2000/svg','text');
  txt.setAttribute('x','50%'); txt.setAttribute('y','62');
  txt.setAttribute('text-anchor','middle'); txt.setAttribute('font-size','9');
  txt.setAttribute('fill','#9CA3AF'); txt.setAttribute('font-family','monospace');
  txt.textContent = val;
  svg.appendChild(txt);
  box.appendChild(svg);
}
</script>
</body>
</html>