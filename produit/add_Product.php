<?php
require_once('produit.class.php');
session_start();
require_once('../session.php');

// Vérification de la session utilisateur
Verifier_session();

// Création d'une instance de la classe Produit
$produit = new Produit();

// Récupération des données du formulaire
$nom = $_POST['nom'];
$description = $_POST['description'];
$categorie = $_POST['categorie'];
$prix = $_POST['prix'];
$stock = $_POST['stock'];
$photo_tmp = $_FILES['image']['tmp_name'];
$photo_nom = $_FILES['image']['name'];

// Déplacement de la photo vers le dossier des images
$destination = '../img/' . $photo_nom;
move_uploaded_file($photo_tmp, $destination);

// Attribution du nom de la photo à l'objet produit
$produit->image = $photo_nom;

// Appel de la méthode d'ajout du produit
$produit->ajouterProduit($nom, $description, $categorie, $prix, $stock, $photo_nom);

// Redirection vers la page de liste des produits
header('location:../dashboard/dashboard.php');
?>
