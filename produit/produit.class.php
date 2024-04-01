<?php
require_once(__DIR__ . '/../pdo.php');

class Produit
{
    public $image;
    public function listerProduits()
    {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
        $sql = "SELECT * FROM produits LIMIT 12";
        $stmt = $pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function listerProduitsParCategorie($categorie)
    {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
        $sql = "SELECT * FROM produits WHERE categorie = :categorie";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['categorie' => $categorie]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function afficherDerniersProduits()
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $sql = "SELECT * FROM produits ORDER BY id_produit DESC LIMIT 6";
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

    public function selectionnerCategories()
    {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase(); 
        $sql = "SELECT DISTINCT categorie FROM produits";
        $stmt = $pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }
    // Fonction pour ajouter un nouveau produit
    public function ajouterProduit($nom, $description, $categorie, $prix, $stock, $image)
    {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
        $sql = "INSERT INTO produits (nom_produit, description, categorie, prix, stock, image) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $description, $categorie, $prix, $stock, $image]);
    }
    


public function modifierProduit($id, $nom, $description, $categorie, $prix, $stock, $image)
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $sql = "UPDATE produits SET nom_produit = :nom, description = :description, categorie = :categorie, prix = :prix, stock = :stock, image = :image WHERE id_produit = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':categorie', $categorie);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}


// Fonction pour supprimer un produit
public function supprimerProduit($id)
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $sql = "DELETE FROM produits WHERE id_produit = $id";
    $pdo->exec($sql);
}

public function getProduct($id) {
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $sql="SELECT * FROM produits WHERE id_produit='$id'";
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

}
?>
