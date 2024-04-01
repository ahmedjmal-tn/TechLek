<?php
require_once('cart.class.php');
$cart = new Cart();
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_POST['id_user'];
    $product_id = $_POST['id_produit'];
    $product_name = $_POST['nom_produit'];
    $product_price = $_POST['prix_produit'];
    $quantity = $_POST['quantite'];
    $id_produit = $_POST['id_produit'];
    

    $stock_available = $cart->checkStockAvailability($product_id, $quantity);

    if ($stock_available) {
        $cart->addToCart($user_id, $id_produit, $product_name, $quantity, $product_price);
        $cart->updateStock($product_id , $quantity);
        header("Location: ../shop.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Stock insuffisant. La quantité demandée n'est pas disponible en stock.";
        header("Location: ../shop.php");
        exit;
    }
    
} 
?>
