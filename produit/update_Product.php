<?php
require_once('produit.class.php');
$us = new Produit();
$id = $_POST['id'];
$new_nom = $_POST['nom'];
$new_desc = $_POST['description'];
$new_cat = $_POST['categorie'];
$new_prix = $_POST['prix'];
$new_stock = $_POST['stock'];  

if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    $uploadPath = '../img/'. $fileName;

    if (move_uploaded_file($fileTmpPath, $uploadPath)) {
        $new_image = $uploadPath;
    } else {
        echo "Failed to move the uploaded file.";
        exit;
    }
}

$us->modifierProduit($id, $new_nom, $new_desc, $new_cat, $new_prix, $new_stock, $new_image);
header('location: ../dashboard/produit.php');
?> 