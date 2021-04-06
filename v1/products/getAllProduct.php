<?php
include("../../config/database_handler.php");
include("../../objects/Products.php");
include("../../objects/Users.php");
$user = new Users($pdo);
$product = new Products($pdo);
$token = "";
if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    $error = new stdClass();
    $error->message = "No token specified!";
    $error->code = "0009";
    print_r(json_encode($error));
    die();
}
if ($user->isTokenValid($token)) {
    $products = $product->getAllProducts();
    print_r(json_encode($products));
} else {
    $error = new stdClass();
    $error->message = "Invalid token! Login to create a new token!";
    $error->code = "0008";
    print_r(json_encode($error));
}
