<?php
session_start();

if (!$_SESSION['LOGGED_USER']) {
    header("Location: login.php");
exit;
}

require_once(__DIR__ . '/../fonciton/fonctions.php');
require_once(__DIR__ . '/../fonciton/ConnexionBDD.php');
$postData = $_POST;


echo $postData['nom_produit'] .' ' . $postData['description'] .' ' .$postData['code_barre'] .' ' .$postData['prix'] .' ' .$postData['stock'] .' ' .$_POST['ImgProduit'];
// if (isset($postData['nom_produit']) 
//     && isset($postData['description']) 
//     && isset($postData['code_barre']) 
//     && isset($postData['prix']) 
//     && isset($postData['stock'])
//     && isset($postData['ImgProduit'])
//     && !empty($postData['nom_produit']) 
//     && !empty($postData['description']) 
//     && !empty($postData['code_barre']) 
//     && !empty($postData['prix']) 
//     && !empty($postData['stock'])
//     && !empty($postData['ImgProduit'])) {


    // $target_dir ="imgUtilisateur/";
    
    // $target_file = $target_dir . basename($_FILES["ImgProduit"]["name"]);
    
    // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    // move_uploaded_file($_FILES["ImgProduit"]["tmp_name"], $target_file);

    // $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // // Check if image file is a actual image or fake image
    // if(isset($_POST["submit"])) {
    // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    // if($check !== false) {
    //     echo "File is an image - " . $check["mime"] . ".";
    //     $uploadOk = 1;
    // } else {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    // }
    // }

    // // Check if file already exists
    // if (file_exists($target_file)) {
    // echo "Sorry, file already exists.";
    // $uploadOk = 0;
    // }

    // // Check file size
    // if ($_FILES["fileToUpload"]["size"] > 500000) {
    // echo "Sorry, your file is too large.";
    // $uploadOk = 0;
    // }

    // // Allow certain file formats
    // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    // && $imageFileType != "gif" ) {
    // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    // $uploadOk = 0;
    // }

    // // Check if $uploadOk is set to 0 by an error
    // if ($uploadOk == 0) {
    // echo "Sorry, your file was not uploaded.";
    // // if everything is ok, try to upload file
    // } else {
    // if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //     echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    // } else {
    //     echo "Sorry, there was an error uploading your file.";
    // }
    // }


//     $insertProduit='INSERT INTO produits(Nom_produit, Description, Prix, Code_barre, Stock, ImgChemin) VALUE(:Nom_produit, :Description, :Prix, :Code_barre, :Stock, :Img)';
//     $insertionProduit=$mysqlClient->prepare($insertProduit);
//     $insertionProduit->execute([
//         'Nom_produit' => $postData['nom_produit'],
//         'Description' => $postData['description'],
//         'Prix' => $postData['prix'],
//         'Code_barre' => $postData['code_barre'],
//         'Stock' => $postData['stock'],
//         'Img' =>  $target_file,
//     ]);
//    redirectToUrl('inventaire.php');
// }
?>