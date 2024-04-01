<?php
require_once('produit.class.php'); // Assurez-vous que le chemin du fichier produit.class.php est correct
$produit = new Produit();
if(isset($_GET['id'])) {
    $produit->supprimerProduit($_GET['id']);
}
header('Location: ../dashboard/produit.php');
?>
