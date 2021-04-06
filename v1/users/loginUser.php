<?php
include("../../config/database_handler.php");
include("../../objects/Users.php");

$username = $_GET['name'];
$password = $_GET['password'];

$user = new Users($pdo);
$return = new stdClass();
$return->token = $user->Login($username, $password);
print_r(json_encode($return));
