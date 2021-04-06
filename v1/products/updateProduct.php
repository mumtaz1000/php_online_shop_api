<?php
include("../../config/database_handler.php");
include("../../objects/Products.php");


$name = "";
$image = "";
$description = "";
$price = "";
$amount = "";
$product_id = "";
if (isset($_GET['name'])) {
    $name = $_GET['name'];
}
if (isset($_FILES['image'])) {
    $image = $_FILES['image'];
}
if (isset($_GET['description'])) {
    $description = $_GET['description'];
}
if (isset($_GET['price'])) {
    $price = $_GET['price'];
}
if (isset($_GET['amount'])) {
    $amount = $_GET['amount'];
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
}
$product = new Products($pdo);
//$product->updateProductImage($image, $name, $product_id);

echo json_encode($product->UpdateProduct($product_name, $product_description, $product_price, $product_id, $product_amount));
