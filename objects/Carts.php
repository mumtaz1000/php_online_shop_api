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
    function AddToCart($token, $product_name, $product_id, $purchased_amount)
    {
        //$error = new stdClass();
        $order_number = $this->GetOrderNumber();
        $id = $this->GetUserId($token);
        // die();
        $this->AddOrdertoCart($id, $order_number);
        $product_data = $this->CheckProductAvailability($product_name, $product_id, $purchased_amount);
        $product_remain = $product_data[0];
        $product_id = $product_data[1];
        if ($product_remain > -1) {
            $this->AddProducttoCart($order_number, $product_id, $purchased_amount, $product_remain, $token);
        } else {
            echo " Required product is not available!";
        }
    }
    function GetOrderNumber()
    {
        $time = time();
        $date = date('Ymd');
        $order_number = $date . $time;
        return ($order_number);
    }
    function AddOrdertoCart($user_id, $order_number)
    {
        $error = new stdClass();
        $order_number = md5($order_number . $user_id);

        $sql = "INSERT INTO cart (user_id,order_number) VALUES (:user_id_IN,:order_number_IN)";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":user_id_IN", $user_id);
        $statement->bindParam(":order_number_IN", $order_number);
        if (!$statement->execute()) {
            $error->message = "Could not execute query!";
            $error->code = "0000";
            die();
        }
    }
    function AddProducttoCart($order_number, $product_id, $purchased_amount, $product_remain, $token)
    {
        $error = new stdClass();
        $checkout = $this->CheckCartStatuts($token);
        if ($checkout < 1) {
            $sql = "INSERT INTO order_items ( order_number,product_id, product_amount ) VALUES (:order_number_IN,:product_id_IN,:product_amount_IN)";
            $statement = $this->database_connection->prepare($sql);
            $statement->bindParam(":order_number_IN", $order_number);
            $statement->bindParam(":product_id_IN", $product_id);
            $statement->bindParam(":product_amount_IN", $purchased_amount);

            if (!$statement->execute()) {
                $error->message = "Could not execute query!";
                $error->code = "0000";
                die();
            }
            $this->SubtractProductAmount($product_id, $product_remain);
            echo "Product is added to cart!";
            die();
        } else {
            echo "Product cannot be added to cart because you have checkout! ";
            die();
        }
    }
    //this function checks if cart is checkout or not 
    function CheckCartStatuts($token)
    {
        $error = new stdClass();

        $sql = "SELECT checkout_status FROM sessions WHERE token=:token_number_IN ";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":token_number_IN", $token);
        if (!$statement->execute()) {
            $error->message = "Could not execute query!";
            $error->code = "0000";
            print_r(json_encode($error));
            die();
        }
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row['checkout_status'];
    }
    function CheckProductAvailability($product_name, $product_id, $required_amount)
    {
        $error = new stdClass();
        $sql = "SELECT id,amount FROM product WHERE name=:product_name_IN AND product_id=:product_id_IN ";
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
        if ($num_row < 0 || $row['amount'] < 1) {
            return 0;
        }
        $available_product_amount = $row['amount'] - $required_amount;
        $id = $row['id'];
        $data = array($available_product_amount, $id);
        if ($available_product_amount < 0) {
            return 0;
        }
        return $data;
    }
    function SubtractProductAmount($product_id, $product_amount)
    {
        $error = new stdClass();
        $sql = "UPDATE product SET amount=:product_amount_IN WHERE  id = :product_id_IN";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":product_amount_IN", $product_amount);
        //$statement->bindParam(":product_name_IN", $product_name);
        //$statement->bindParam(":product_price_IN", $product_price);
        $statement->bindParam(":product_id_IN", $product_id);
        if (!$statement->execute()) {
            $error->message = "Could not execute query!";
            $error->code = "0000";
            die();
        }
        echo "Done!";
    }
    function CartCheckout($token)
    {
        $error = new stdClass();
        $checkout = 1;
        $last_used = time() - 3600;
        $sql = "UPDATE  SESSIONS SET  last_used=:last_used_IN,checkout_status=:checkout_IN  WHERE token=:token_number_IN ";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":last_used_IN", $last_used);
        $statement->bindParam(":checkout_IN", $checkout);
        $statement->bindParam(":token_number_IN", $token);
        if (!$statement->execute()) {
            $error->message = "Could not execute query!";
            $error->code = "0000";
            print_r(json_encode($error));
            die();
        }
        echo "You have successfully checkout!";
    }
}
