<?php
include("../../config/database_handler.php");
include("../../objects/Users.php");

$name = $_GET["name"];
$email = $_GET["email"];
$password = $_GET["password"];
$user = new Users($pdo);
$user->SignUpUser($name, $email, $password);
