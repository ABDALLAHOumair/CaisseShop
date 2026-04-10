<?php 
session_start();
if (!$_SESSION['LOGGED_USER']) {
    header("Location: login.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un produit — CaisseShop</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/form-produit.css">
  <script src="https://cdn.jsdelivr.net/gh/dymosoftware/dymo-connect-framework/dymo.connect.framework.js"></script>
</head>
<body>
<div class="app">
  <aside class="sidebar">
    <div class="sidebar-logo">
      <img src="../images/logo-removebg-preview.png" alt="CaisseShop">
    </div>
    <nav class="sidebar-nav">
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
      <h1 class="form-title">Ajouter un produit</h1>
      <p class="form-subtitle">Ajouter les informations du produit.</p>
      <form action="submit_ajout_produit.php" method="GET" enctype="multipart/form-data" class="form-layout">
          <div class="form-left">
            <div class="form-group">
              <label class="form-label">Nom du produit</label>
              <input class="form-input" type="text" id="productName" name="nom_produit">
            </div>
            <div class="form-group">
              <label class="form-label">Description</label>
              <textarea class="form-textarea" name="description"></textarea>
            </div>
            <div class="form-group">
              <label class="form-label">Référence / Code-barres</label>
              <input class="form-input" type="text" id="barcodeValue" name="code_barre">
            </div>
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Prix</label>
                <input class="form-input" type="number" step=0.01 id="priceValue" name="prix" min="0">
              </div>
              <div class="form-group">
                <label class="form-label">Stock</label>
                <input class="form-input" type="number" min="0" name="stock">
              </div>
            </div>
            
            <!-- Zone aperçu code-barre -->
            <div class="barcode-section">
              <p class="form-label">Code-barres</p>
              <div id="statusBox" class="status">Initialisation de DYMO…</div>
              <div class="barcode-box" id="previewZone">
                <div class="muted">Aucun aperçu généré.</div>
              </div>
              <div class="field">
                <label class="form-label" for="copies">Nombre d’exemplaires</label>
                <input class="form-input" id="copies" type="number" min="1" max="100" step="1" value="1" />
              </div>
              <button class="btn-generate" id="refreshBtn" type="button">Actualiser les imprimantes</button>
              <button class="btn-generate" id="previewBtn" type="button">Aperçu</button>
              <button class="btn-generate" id="printBtn" type="button">Imprimer</button>
            </div>
            <div class="field">
              <label class="form-label" for="printerSelect">Imprimante DYMO</label>
              <select class="form-input" id="printerSelect"></select>
            </div>
            
            <button class="btn-save" type="submit">Enregistrer</button>
          </div>

          <div class="form-right">
            <div class="img-box" id="img-box">
              <img id="preview-img">
            </div>
            <label class="btn-import">
              importer une image
              <input type="file" name="ImgProduit" accept="image/*" onchange="previewImage(event)">
            </label>
          </div>
        </form> 
    </div>
  </main>
</div>

<script>
  const statusBox = document.getElementById('statusBox');
  const printerSelect = document.getElementById('printerSelect');
  const barcodeValue = document.getElementById('barcodeValue');
  const productName = document.getElementById('productName');
  const priceValue = document.getElementById('priceValue');
  const copiesInput = document.getElementById('copies');
  const refreshBtn = document.getElementById('refreshBtn');
  const previewBtn = document.getElementById('previewBtn');
  const printBtn = document.getElementById('printBtn');
  const previewZone = document.getElementById('previewZone');

  const LABEL_XML = `<?xml version="1.0" encoding="utf-8"?>
<DieCutLabel Version="8.0" Units="twips" MediaType="Default">
<PaperOrientation>Portrait</PaperOrientation>
<Id>Small30334</Id>
<IsOutlined>false</IsOutlined>
<PaperName>30334 2-1/4 in x 1-1/4 in</PaperName>
<DrawCommands>
  <RoundRectangle X="0" Y="0" Width="3240" Height="1800" Rx="270" Ry="270" />
</DrawCommands>
<ObjectInfo>
  <BarcodeObject>
    <Name>BARCODE</Name>
    <ForeColor Alpha="255" Red="0" Green="0" Blue="0" />
    <BackColor Alpha="0" Red="255" Green="255" Blue="255" />
    <LinkedObjectName />
    <Rotation>Rotation0</Rotation>
    <IsMirrored>False</IsMirrored>
    <IsVariable>True</IsVariable>
    <GroupID>-1</GroupID>
    <IsOutlined>False</IsOutlined>
    <Text>REF-1234</Text>
    <Type>Code128Auto</Type>
    <Size>Medium</Size>
    <TextPosition>Bottom</TextPosition>
    <TextFont Family="Arial" Size="8" Bold="False" Italic="False" Underline="False" Strikeout="False" />
    <CheckSumFont Family="Arial" Size="8" Bold="False" Italic="False" Underline="False" Strikeout="False" />
    <TextEmbedding>None</TextEmbedding>
    <ECLevel>0</ECLevel>
    <HorizontalAlignment>Center</HorizontalAlignment>
    <QuietZonesPadding Left="0" Top="0" Right="0" Bottom="0" />
  </BarcodeObject>
  <Bounds X="228" Y="885" Width="2880" Height="720" />
</ObjectInfo>
<ObjectInfo>
  <TextObject>
    <Name>NOM_PRODUIT</Name>
    <ForeColor Alpha="255" Red="0" Green="0" Blue="0" />
    <BackColor Alpha="0" Red="255" Green="255" Blue="255" />
    <LinkedObjectName />
    <Rotation>Rotation0</Rotation>
    <IsMirrored>False</IsMirrored>
    <IsVariable>True</IsVariable>
    <GroupID>-1</GroupID>
    <IsOutlined>False</IsOutlined>
    <HorizontalAlignment>Center</HorizontalAlignment>
    <VerticalAlignment>Top</VerticalAlignment>
    <TextFitMode>ShrinkToFit</TextFitMode>
    <UseFullFontHeight>True</UseFullFontHeight>
    <Verticalized>False</Verticalized>
    <StyledText>
      <Element>
        <String xml:space="preserve">10 KG de RIZ</String>
        <Attributes>
          <Font Family="Arial" Size="12" Bold="False" Italic="False" Underline="False" Strikeout="False" />
          <ForeColor Alpha="255" Red="0" Green="0" Blue="0" HueScale="100" />
        </Attributes>
      </Element>
    </StyledText>
  </TextObject>
  <Bounds X="888" Y="135" Width="1410" Height="255" />
</ObjectInfo>
<ObjectInfo>
  <TextObject>
    <Name>PRIX</Name>
    <ForeColor Alpha="255" Red="0" Green="0" Blue="0" />
    <BackColor Alpha="0" Red="255" Green="255" Blue="255" />
    <LinkedObjectName />
    <Rotation>Rotation0</Rotation>
    <IsMirrored>False</IsMirrored>
    <IsVariable>True</IsVariable>
    <GroupID>-1</GroupID>
    <IsOutlined>False</IsOutlined>
    <HorizontalAlignment>Center</HorizontalAlignment>
    <VerticalAlignment>Top</VerticalAlignment>
    <TextFitMode>ShrinkToFit</TextFitMode>
    <UseFullFontHeight>True</UseFullFontHeight>
    <Verticalized>False</Verticalized>
    <StyledText>
      <Element>
        <String xml:space="preserve">Prix : 9,99€</String>
        <Attributes>
          <Font Family="Arial" Size="12" Bold="False" Italic="False" Underline="False" Strikeout="False" />
          <ForeColor Alpha="255" Red="0" Green="0" Blue="0" HueScale="100" />
        </Attributes>
      </Element>
    </StyledText>
  </TextObject>
  <Bounds X="903" Y="480" Width="1560" Height="270" />
</ObjectInfo>
</DieCutLabel>`;


// Validation du label DYMO
function validateLabel() {
  try {
      const label = dymo.label.framework.openLabelXml(LABEL_XML);

      const isValid = label.isValidLabel();
      const isDLS = label.isDLSLabel();
      const isDCD = label.isDCDLabel();

      const result = document.getElementById("validationResult");

      result.innerHTML = `
          Label valide : ${isValid}<br>
          Format DYMO Label Software (DLS) : ${isDLS}<br>
          Format DYMO Connect (DCD) : ${isDCD}
      `;

  } catch (e) {
      document.getElementById("validationResult").innerText = "Erreur de validation : " + e;
  }
}

  function setStatus(message, type = '') {
    statusBox.textContent = message;
    statusBox.className = 'status' + (type ? ' ' + type : '');
  }

  function getSelectedPrinter() {
    return printerSelect.value;
  }

  function openLabel() {
    return dymo.label.framework.openLabelXml(LABEL_XML);
  }

  function updateLabelValues(label) {
    const barcode = barcodeValue.value.trim();
    const name = productName.value.trim();
    const price ='Prix : '+ priceValue.value.trim() + ' €';

    if (!barcode) {
      throw new Error('Veuillez saisir une valeur pour BARCODE.');
    }

    label.setObjectText('BARCODE', barcode);
    label.setObjectText('NOM_PRODUIT', name || '');
    label.setObjectText('PRIX', price || '');
  }

  function loadPrinters() {
    try {
      const printers = dymo.label.framework.getPrinters() || [];
      const dymoPrinters = printers.filter(printer => {
        const type = (printer.printerType || '').toLowerCase();
        const name = (printer.name || '').toLowerCase();
        return type.includes('labelwriter') || name.includes('dymo');
      });

      printerSelect.innerHTML = '';

      if (dymoPrinters.length === 0) {
        setStatus('Aucune imprimante DYMO LabelWriter détectée.', 'error');
        const option = document.createElement('option');
        option.value = '';
        option.textContent = 'Aucune imprimante trouvée';
        printerSelect.appendChild(option);
        return;
      }

      dymoPrinters.forEach(printer => {
        const option = document.createElement('option');
        option.value = printer.name;
        option.textContent = printer.name;
        printerSelect.appendChild(option);
      });

      setStatus('Imprimante DYMO détectée. Vous pouvez générer un aperçu ou imprimer.', 'ok');
    } catch (error) {
      setStatus('Impossible de charger les imprimantes DYMO : ' + error.message, 'error');
    }
  }

function renderPreview() {
try {
  const label = openLabel();
  updateLabelValues(label);

  const printerName = getSelectedPrinter();
  const renderParamsXml = "";

  const pngData = label.render(renderParamsXml, printerName);

  previewZone.innerHTML = "";
  const img = document.createElement("img");
  img.src = "data:image/png;base64," + pngData;
  img.alt = "Aperçu de l’étiquette DYMO";
  previewZone.appendChild(img);

  setStatus("Aperçu généré.", "ok");
} catch (error) {
  previewZone.innerHTML = '<div class="muted">Impossible de générer l’aperçu.</div>';
  setStatus("Erreur d’aperçu : " + error.message, "error");
  console.error(error);
}
}

function printLabel() {
try {
  const printerName = getSelectedPrinter();
  if (!printerName) {
    throw new Error("Aucune imprimante DYMO sélectionnée.");
  }

  const copies = Number(copiesInput.value) || 1;
  const label = openLabel();
  updateLabelValues(label);

  const printParamsXml = `
    <LabelWriterPrintParams>
      <Copies>${copies}</Copies>
    </LabelWriterPrintParams>
  `;

  label.print(printerName, printParamsXml, "");
  setStatus("Impression envoyée à " + printerName + ".", "ok");
} catch (error) {
  setStatus("Erreur d’impression : " + error.message, "error");
  console.error(error);
}
}

  function initDymo() {
    try {
      if (!window.dymo || !dymo.label || !dymo.label.framework) {
        setStatus('Le framework DYMO n’est pas chargé.', 'error');
        return;
      }

      dymo.label.framework.init(() => {
        loadPrinters();
        renderPreview();
      });
    } catch (error) {
      setStatus('Initialisation DYMO impossible : ' + error.message, 'error');
    }
  }

  refreshBtn.addEventListener('click', loadPrinters);
  previewBtn.addEventListener('click', renderPreview);
  printBtn.addEventListener('click', printLabel);
  barcodeValue.addEventListener('input', renderPreview);
  productName.addEventListener('input', renderPreview);
  priceValue.addEventListener('input', renderPreview);

  initDymo();

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
</script>
</body>
</html>