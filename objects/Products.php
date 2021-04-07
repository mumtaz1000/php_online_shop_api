<?php
include("../../config/database_handler.php");

class Products
{
    private $database_connection;
    function __construct($db)
    {
        $this->database_connection = $db;
    }
    function CreateProduct($product_name, $product_description, $product_price, $product_id, $product_amount)
    {
        $error = new stdClass();
        if (!empty($product_name) && !empty($product_price) && !empty($product_id)) {
            $error->message = $this->AddProduct($product_name, $product_description, $product_price, $product_id, $product_amount);
        } else {
            $error->message = "All arguments needs a value!";
            $error->code = "0001";
            print_r(json_encode($error));
            die();
        }
    }
    function AddProduct($product_name, $product_description, $product_price, $product_id, $product_amount)
    {
        $error = new stdClass();
       
        $sql = "SELECT amount FROM product WHERE name=:product_name_IN AND price=:product_price_IN AND product_id=:product_id_IN ";
        $statement = $this->database_connection->prepare($sql);
        // $statement->bindParam(":product_amount_IN", $product_amount);
        $statement->bindParam(":product_name_IN", $product_name);
        $statement->bindParam(":product_price_IN", $product_price);
        $statement->bindParam(":product_id_IN", $product_id);
        if (!$statement->execute()) {
            $error->message = "Could not execute query!";
            $error->code = "0000";
            print_r(json_encode($error));
            die();
        }
        $num_row = $statement->rowCount();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $amount = $row['amount'];
        if ($num_row > 0) {
            $amount = $amount + $product_amount;
            $this->AddProductAmount($product_name, $product_price, $product_id, $amount);
        } else {

            $sql = "INSERT INTO product (name, description, price, amount,product_id) VALUES (:product_name_IN,:product_description_IN,:product_price_IN,:product_amount_IN,:product_id_IN)";
            $statement = $this->database_connection->prepare($sql);
            $statement->bindParam(":product_name_IN", $product_name);
            $statement->bindParam(":product_description_IN", $product_description);
            $statement->bindParam(":product_price_IN", $product_price);
            $statement->bindParam(":product_amount_IN", $product_amount);
            $statement->bindParam(":product_id_IN", $product_id);
            //$statement->bindParam(":product_amount_IN", $product_amount);
            //echo "is this working";
            if (!$statement->execute()) {
                $error->message = "Could not execute query!";
                $error->code = "0000";
                die();
            } else {
                echo "Product is successfully created into database!";
            }
        }
    }

    function AddProductAmount($product_name, $product_price, $product_id, $product_amount)
    {
        $error = new stdClass();
        $sql = "UPDATE product SET amount=:product_amount_IN WHERE name=:product_name_IN AND price=:product_price_IN AND product_id = :product_id_IN";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":product_amount_IN", $product_amount);
        $statement->bindParam(":product_name_IN", $product_name);
        $statement->bindParam(":product_price_IN", $product_price);
        $statement->bindParam(":product_id_IN", $product_id);
        if (!$statement->execute()) {
            $error->message = "Could not execute query!";
            $error->code = "0000";
            die();
        }
        echo "Product amount is successfully added to database!";
    }
    function DeleteProduct($product_name, $product_id)
    {
        $message = new stdClass();
        if (!empty($product_name) && !empty($product_id)) {
            $sql = "DELETE FROM product WHERE name=:product_name_IN AND  product_id = :product_id_IN";
            $statement = $this->database_connection->prepare($sql);
            $statement->bindParam(":product_name_IN", $product_name);
            $statement->bindParam(":product_id_IN", $product_id);
            $statement->execute();
            if ($statement->rowCount() < 1) {
                $message->text = "Product does not exist!";
                return $message;
            }

            $message->text = "Prouct is successfully deleted from database!";
        } else {
            $message->error = "All arguments need a value!";
            $message->code = "0001";
            print_r(json_encode($message));
            die();
        }
    }
    function UpdateProduct($product_name, $product_description, $product_price, $product_id, $product_amount)
    {
        $error = new stdClass();
        if (!empty($product_name) && !empty($product_id)) {

            if (!empty($product_description)) {
                $error->message = $this->UpdateProductDescription($product_description, $product_id);
            }

            if (!empty($product_price)) {
                $error->message = $this->UpdateProductPrice($product_price,  $product_id);
            }
            if (!empty($product_amount)) {
                $error->message = $this->UpdateProductAmount($product_amount, $product_id);
            }
            $error->message = $this->UpdateProductName($product_name, $product_id);
            return $error;
        } else {
            $error->message = "All arguments need a value!";
            $error->code = "0001";
            print_r(json_encode($error));
            die();
        }
    }
    function UpdateProductName($product_name, $product_id)
    {
        $sql = "UPDATE product SET name=:product_name_IN WHERE  product_id = :product_id_IN";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":product_name_IN", $product_name);
        $statement->bindParam(":product_id_IN", $product_id);
        $statement->execute();
        if ($statement->rowCount() < 1) {
            return "Cannot update product name!";
        }
    }
    function UpdateProductDescription($product_description, $product_id)
    {
        $sql = "UPDATE product SET description=:product_description_IN WHERE  product_id = :product_id_IN";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":product_description_IN", $product_description);
        $statement->bindParam(":product_id_IN", $product_id);

        $statement->execute();
        if ($statement->rowCount() < 1) {
            return "Cannot update product description!";
        }
    }
    function UpdateProductImage($product_image,  $product_id)
    {

        print_r($product_image);
        $target_file = $product_image['tmp_name'];
        $img_name = basename($product_image['name']);
        $upload_dir = "../images/";

        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (is_uploaded_file($product_image['tmp_name'])) {
            $check = getimagesize($product_image['tmp_name']);
            if ($check == false) {
                echo "The file is not image";
                die;
            }
        }
        if ($product_image['size'] > 1000000) {
            echo "The file is too big!";
            die;
        }
        /*if ($fileType != "png" && $fileType != "gif" && $fileType != "jpg" && $fileType != "jpeg") {
            echo "You can only upload PNG, GIF, JPG or JPEG.";
            die;
        } */
        if (move_uploaded_file($target_file, $upload_dir)) {
            echo $upload_dir;
        } else {
            echo "Something goes wrong!";
            die;
        }
        $sql = "UPDATE product SET image=:image_IN
        WHERE product_id = :id_IN AND name=:product_name_IN";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":image_IN", $img_name);
        $statement->bindParam(":id_IN", $product_id);
        //$statement->bindParam(":product_name_IN", $product_name);
        $statement->execute();
        if (!$statement->execute()) {
            echo "Could not execute query";
        }
    }
    //function (){}

    function UpdateProductAmount($product_amount,  $product_id)
    {
        $sql = "UPDATE product SET amount=:product_amount_IN WHERE  product_id = :product_id_IN ";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":product_amount_IN", $product_amount);
        $statement->bindParam(":product_id_IN", $product_id);
        //$statement->bindParam(":product_name_IN", $product_name);
        $statement->execute();
        if ($statement->rowCount() < 1) {
            return "Cannot update product amount!";
        }
    }
    function UpdateProductPrice($product_price,  $product_id)
    {
        $sql = "UPDATE product SET price=:product_price_IN WHERE  product_id = :product_id_IN ";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":product_price_IN", $product_price);
        $statement->bindParam(":product_id_IN", $product_id);
        //$statement->bindParam(":product_name_IN", $product_name);
        $statement->execute();
        if ($statement->rowCount() < 1) {
            return "Cannot update product price!";
        }
    }
    function getAllProducts(){
        $sql = "SELECT name, description, price, amount, product_id FROM product";
        $statement = $this->database_connection->prepare($sql);
        $statement->execute();
        echo "<pre>";
        echo json_encode($statement->fetchAll());
        echo "</pre>";
    }
}
