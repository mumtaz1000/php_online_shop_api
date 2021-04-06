<?php
include("../../config/database_handler.php");
class Carts
{
    private $database_connection;
    function __construct($db)
    {
        $this->database_connection = $db;
    }
    function GetUserId($token)
    {
        $error = new stdClass();
        $sql = "SELECT user_id FROM sessions WHERE token=:token_IN";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":token_IN", $token);
        if (!$statement->execute()) {
            $error->message = "Could not execute query!";
            $error->code = "0000";
            return print_r(json_encode($error));
            die();
        } else {
            $customer = $statement->fetch(PDO::FETCH_ASSOC);
            return $customer['user_id'];
        }
    }
    function AddToCart($user_id, $product_name, $product_id, $product_amount)
    {
        $error = new stdClass();
        $sql = "SELECT name FROM product WHERE name=:product_name_IN AND product_id=:product_id_IN ";
        $statement = $this->database_connection->prepare($sql);
        // $statement->bindParam(":product_amount_IN", $product_amount);
        $statement->bindParam(":product_name_IN", $product_name);
        //$statement->bindParam(":product_price_IN", $product_price);
        $statement->bindParam(":product_id_IN", $product_id);
        if (!$statement->execute()) {
            $error->message = "Could not execute query!";
            $error->code = "0000";
            print_r(json_encode($error));
            die();
        }
        $num_row = $statement->rowCount();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($num_row < 0) {
            echo "Required product is not available!";
        } else {
            $sql = "INSERT INTO order_items ( product_id, product_amount ) VALUES (:product_name_IN,:product_amount_IN,:product_id_IN)";
            $statement = $this->database_connection->prepare($sql);
            $statement->bindParam(":product_name_IN", $product_name);
            $statement->bindParam(":product_amount_IN", $product_amount);
            $statement->bindParam(":product_id_IN", $product_id);
            //$statement->bindParam(":product_amount_IN", $product_amount);
            //echo "is this working";
            if (!$statement->execute()) {
                $error->message = "Could not execute query!";
                $error->code = "0000";
                die();
            } else {
                echo "Product is added to cart!";
            }
        }
    }
}
