<?php

require_once(__DIR__ . '/../pdo.php');

class Cart
{



    public function addToCart($user_id, $id_produit, $product_name, $quantity, $unit_price)
    {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
        $total_price = $quantity * $unit_price;
        $sql = "INSERT INTO cart (user_id, id_produit, product_name, quantity, unit_price, total_price) 
                VALUES (:user_id, :id_produit, :product_name, :quantity, :unit_price, :total_price)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':id_produit', $id_produit);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':unit_price', $unit_price);
        $stmt->bindParam(':total_price', $total_price);
        return $stmt->execute();
    }
    
    public function clearCart() {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
        $sql = "DELETE FROM cart" ;
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function removeFromCart($id_cart)
    {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
        $sql = "DELETE FROM cart WHERE id = :id_cart";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_cart', $id_cart);
        return $stmt->execute();
    }

    public function updateStock($product_id ,$quantity) {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
        $sql1="SELECT stock FROM produits WHERE id_produit='$product_id'";
        $stmt = $pdo->query($sql1); 
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result > $quantity) {
            $sql="UPDATE produits SET stock = stock - '$quantity' WHERE id_produit = '$product_id'";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute(); 
        }        
    }

    public function updateQuantity($cart_id, $quantity)
    {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
        $sql = "UPDATE cart SET quantity = :quantity WHERE id = :cart_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':cart_id', $cart_id);
        return $stmt->execute();
    }
    public function getUserCart($user_id)
    {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
        $sql = "SELECT * FROM cart WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCartItems($user_id)
    {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
        $sql = "SELECT * FROM cart WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function calculateTotal($user_id)
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $sql = "SELECT SUM(total_price) AS total FROM cart WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
public function restoreStock($user_id)
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    
    $cart_items = $this->getUserCart($user_id);
    foreach ($cart_items as $item) {
        $product_id = $item['id_produit'];
        $quantity_removed = $item['quantity']; 

        $sql_stock = "SELECT stock FROM produits WHERE id_produit = :product_id";
        $stmt_stock = $pdo->prepare($sql_stock);
        $stmt_stock->bindParam(':product_id', $product_id);
        $stmt_stock->execute();
        $current_stock = $stmt_stock->fetchColumn();

        $new_stock = $current_stock + $quantity_removed;
        
        $sql_update = "UPDATE produits SET stock = :new_stock WHERE id_produit = :product_id";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->bindParam(':new_stock', $new_stock);
        $stmt_update->bindParam(':product_id', $product_id);
        $stmt_update->execute();
    }
    
}
public function checkStockAvailability($product_id, $requested_quantity)
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $sql = "SELECT stock FROM produits WHERE id_produit = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && $result['stock'] >= $requested_quantity) {

        return true;
    } else {

        return false;
    }
}
public function countCartRowsPerUser($user_id)
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $sql = "SELECT COUNT(*) AS cart_rows FROM cart WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['cart_rows'])) {
        return $result['cart_rows'];
    } else {
       
        return 0; 
    }
}


}
