<?php
include("../../config/database_handler.php");
include("../../objects/Users.php");
include("../../objects/Products.php");
include("../../objects/Carts.php");
$user = new Users($pdo);
$product = new Products($pdo);
$cart = new Carts($pdo);
$token = "";
//$product_name = $_GET['product_name'];
$product_id =  $_GET['product_id'];
$order_id = $_GET['order_id'];
if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    $error = new stdClass();
    $error->message = "No token specifiend!";
    $error->code = "0009";
    print_r(json_encode($error));
    die();
}

if ($user->isTokenValid($token)) {
    if (isset($_GET['amount'])) {
        $amount = $_GET['amount'];
    }
    $cart->RemoveFromCart($order_id,  $product_id);
} else {
    $error = new stdClass();
    $error->message = "Invalid token!";
    $error->code = "0010";
    print_r(json_encode($error));
}
