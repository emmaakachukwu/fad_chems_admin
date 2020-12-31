<?php

$sql = "CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(50) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `email` varchar(100) NOT NULL,
    `username` varchar(100) NOT NULL,
    `role` VARCHAR(50) NOT NULL DEFAULT 'user',
    `password` varchar(250) NOT NULL,
    `fname` varchar(100) DEFAULT NULL,
    `lname` varchar(100) DEFAULT NULL,
    `country` varchar(100) DEFAULT NULL,
    `state` varchar(100) DEFAULT NULL,
    `city` varchar(100) DEFAULT NULL,
    `phone` varchar(20) DEFAULT NULL,
    `balance` int(50) DEFAULT 0,
    `image_path` varchar(250) DEFAULT NULL,

    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL
)";
$link->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `products` (
    `id` INT(50) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `price` INT(50) NOT NULL,
    `desc` MEDIUMTEXT NULL,
    `image_path` varchar(250) NULL,
    `deleted_at` TIMESTAMP NULL,

    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL
)";
$link->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `deposits` (
    `id` INT(50) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT(50) NOT NULL,
    `amount` INT(50) NULL,
    `approved_at` TIMESTAMP NULL,

    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,

    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL
)";
$link->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `orders` (
    `id` VARCHAR(100) NOT NULL PRIMARY KEY,
    `user_id` INT(50) NOT NULL,
    `product_id` INT(50) NOT NULL,
    `quantity` INT(50) NOT NULL,
    `paid` BOOLEAN DEFAULT TRUE,
    `delivered_at` TIMESTAMP NULL,

    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,

    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL
)";
$link->query($sql);

$admin_email = 'admin@fadchems.com';
$sql = "SELECT email FROM users WHERE email = '$admin_email' LIMIT 1";
$result = $link->query($sql);
if ( !$result->num_rows ) {
    $sql = "INSERT INTO users (username, email, fname, lname, password, role) VALUES ('fadchemsadmin', '$admin_email', 'fad', 'chemicals', 'fadchemspass100', 'admin')";
    $link->query($sql);
}
