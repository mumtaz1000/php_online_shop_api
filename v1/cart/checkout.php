<?php
include("../../config/database_handler.php");
include("../../objects/Users.php");
//include("../../objects/Products.php");
include("../../objects/Carts.php");
$user = new Users($pdo);
//$product = new Products($pdo);
$cart = new Carts($pdo);
$token = "";


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

    $cart->CartCheckout($token);
} else {
    $error = new stdClass();
    $error->message = "Invalid token!";
    $error->code = "0010";
    print_r(json_encode($error));
}
