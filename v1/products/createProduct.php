<?php
include("../../config/database_handler.php");
include("../../objects/Products.php");

$name = "";
$description = "";
$price = "";
$product_id = "";
$amount = 1;
if (isset($_GET['name'])) {
    $name = $_GET['name'];
}

if (isset($_GET['description'])) {
    $description = $_GET['description'];
}
if (isset($_GET['price'])) {
    $price = $_GET['price'];
}
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
}
if (isset($_GET['amount'])) {
    $amount = $_GET['amount'];
}

$product = new Products($pdo);
echo json_encode($product->CreateProduct($name, $description, $price, $product_id, $amount));
//echo json_encode($product->ADescription());
