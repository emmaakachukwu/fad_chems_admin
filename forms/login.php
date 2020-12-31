<?php

require_once "./../lib/config.php";

validate_empty_fields($post);

$sql = $link->prepare("SELECT id, username, email, password FROM users WHERE (username = ? or email = ?) && role = 'admin' LIMIT 1");
$sql->bind_param("ss", $user, $user);
if ( $sql->execute() ) {
    $sql->bind_result($_id, $_username, $_email, $_password);
    $sql->fetch();
    if ( $_username || $_email ) {
        if ($_password === $password) {
            $_SESSION['user'] = $_id;
            on_success('products');
        }
    }
    array_push($errors, 'Invalid login');
}
$sql->close();

check_errors($errors);

array_push($errors, 'Something went wrong; retry');

check_errors($errors);
