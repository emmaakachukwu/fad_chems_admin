<?php

include "./../lib/config.php";

if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
    logout();
} else {
    $id = $_SESSION['user'];
}

validate_empty_fields($post);
$updated_at = date('Y-m-d H:i:s');

if ( $tab == 'wallet' ) {
    foreach ( $post as $key => $value ) {
        if ( $key != 'tab' ) {
            try {
                $sql = $link->prepare("UPDATE `wallets` SET wallet_id=?, updated_at=? WHERE type=?");
                // dd($link->error);
                $sql->bind_param("sss", $value, $updated_at, $key);
                $sql->execute();
                $sql->close();
            } catch (Exception $e) {
                array_push($errors, 'Something went wrong updating your '.$key.'ID');
                $sql->close();
                check_errors($errors);
            }
        }
    }

    $_SESSION['success'] = ["Wallet info updated"];
    on_success('settings');
}

if ( $tab == 'password' ) {
    $sql = $link->prepare("SELECT id, password FROM users WHERE id = ? AND role = 'admin' LIMIT 1");
    $sql->bind_param("s", $id);
    if ( $sql->execute() ) {
        $sql->bind_result($_id, $_password);
        $sql->fetch();
        if (!$_id) {
            array_push($errors, 'Something went wrong; please login again');
            $_SESSION['errors'] = $errors;
            logout();
        }

        if ( $_password !== $current) {
            array_push($errors, 'Current password is wrong');
        }
    }
    $sql->close();

    if ( strlen($new) < 8 ) {
        array_push($errors, 'New password must be up to eight characters');
    }

    if ( $new !== $confirm ) {
        array_push($errors, 'Passwords do not match');
    }

    check_errors($errors);

    $sql = $link->prepare("UPDATE `users` SET password=?, updated_at=? WHERE id=?");
    $sql->bind_param("sss", $new, $updated_at, $id);
    if ( $sql->execute() ) {
        $_SESSION['success'] = ["Password updated"];
        $sql->close();
        on_success('settings');
    }
}

array_push($errors, 'Something went wrong; retry');
    
check_errors($errors);