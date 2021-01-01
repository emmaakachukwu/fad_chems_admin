<?php

require_once "./../lib/config.php";

// confirm id availablity
if ( !isset($_GET['product_id']) || empty(trim($_GET['product_id'])) ) {
    array_push($errors, 'Something went wrong.. please refresh');
    check_errors($errors);
} else {
    $product_id = $_GET['product_id'];
}

$required = ['product_name'];
validate_empty_fields($post, $required);

$sql = $link->prepare("SELECT `name` FROM products WHERE `name` = ? AND id != $product_id LIMIT 1");
$sql->bind_param("s", $product);
if ( $sql->execute() ) {
    $sql->bind_result($_product);
    $sql->fetch();
    if ($_product) {
        array_push($errors, 'Product name already added');
    }
}
$sql->close();
check_errors($errors);

$newFileName = !isset($post['newFileName']) || empty(trim($post['newFileName'])) ? null : trim($post['newFileName']);

if ( isset($_FILES['file']) && !empty(trim($_FILES['file']['name'])) ) {
    $target_dir = "./../uploads/products/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $newFileName = md5($product).'.'.$imageFileType;
    $path = $target_dir.$newFileName;
    $imageSize = $_FILES['file']['size'];
    $allowed = ['jpg', 'png', 'jpeg', 'gif'];

    if ( !isset($imageFileType) || !$imageFileType || !in_array($imageFileType, $allowed) ) {
        array_push($errors, 'File type not allowed; allowed file types: '.implode(', ', $allowed));
    }
    if ( !getimagesize($_FILES["file"]["tmp_name"]) ) {
        array_push($errors, 'File is not a valid image file');
    }
    if ( $imageSize > 500000 ) {
        array_push($errors, 'File is larger than 500KB');
    }
    check_errors($errors);

    if ( !move_uploaded_file($_FILES["file"]["tmp_name"], $path) ) {
        array_push($errors, 'File upload error; retry');
    }
    check_errors($errors);
}

$at = date('Y-m-d H:i:s');
$sql = $link->prepare("UPDATE `products` SET `name`=?, price=?, formula=?, `desc`=?, image_path=?, updated_at=? WHERE id=?");
$sql->bind_param("sssssss", $product, $price, $formula, $description, $newFileName, $at, $product_id);
if ( $sql->execute() ) {
    $_SESSION['success'] = ["Product updated"];
    $sql->close();
    on_success('edit_product');
}

array_push($errors, 'Something went wrong; retry.. '.$link->error);

check_errors($errors);