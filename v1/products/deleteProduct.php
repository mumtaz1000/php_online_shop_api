<?php
include("../../config/database_handler.php");
include("../../objects/Products.php");

$name = $_GET['name'];
$product_id = $_GET['product_id'];
$product = new Products($pdo);
echo json_encode($product->DeleteProduct($name, $product_id));
