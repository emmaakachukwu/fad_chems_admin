<?php

$post = $_POST;
$errors = [];
$error_redirect = basename($_SERVER['PHP_SELF'], '.php');

// die n dump
function dd($var) : void {
    print_r($var);
    exit;
}

// for top spacing
function top_space (int $num = 3) : void {
    $i = 0;
    while ( $i < $num ) {
        echo '<br>';
        $i++;
    }
}

function ddd($var, int $num = 3) : void {
    top_space($num);
    dd($var);
}

function readable_key($key) : string {
    return ucfirst(trim(implode(' ', explode('_', $key))));
}

function toast_errors() : void {
    if ( isset($_SESSION['errors']) && count($_SESSION['errors']) ) {
        foreach ( $_SESSION['errors'] as $error ) {
          echo "<script>toastr.error('$error')</script>";
        }
        unset($_SESSION['errors']);
    }

    if ( isset($_SESSION['success']) && count($_SESSION['success']) ) {
        foreach ( $_SESSION['success'] as $msg ) {
          echo "<script>toastr.success('$msg')</script>";
        }
        unset($_SESSION['success']);
    }
}

// logout function for forms
function logout(bool $from_form = true): void {
    $from_form ? header("Location: ./../logout.php") : header("Location: ./logout.php");
    die();
}

function validate_empty_fields (array $post, array $required = []): void {
    $required = count($required) ? $required : array_keys($post);
    $error_redirect = $GLOBALS['error_redirect'];
    $errors = [];
    $vars = [];
    foreach ( $post as $key => $value ) {
        if ( empty(trim($value)) && in_array($key, $required) ) {
            array_push($errors, readable_key($key) . ' can not be empty');
        } else if ( $key != 'password' && $key != 'confirm_password' ) {
            if ( $error_redirect == 'add_product' )
                $_SESSION[$key] = $value;

            $short_key = explode('_', $key)[0];
            global $$short_key;
            $$short_key = $key == 'email' ? strtolower(trim($value)) : trim($value);
        } else {
            $short_key = explode('_', $key)[0];
            global $$short_key;
            $$short_key = $value;
        }
    }

    if ( $error_redirect == 'signup' ) {
        if ( !isset($post['agree']) || empty($post['agree']) ) {
            array_push($errors, 'Agree to the terms and conditions to continue');
        }        
    }
    check_errors($errors);
}

function check_errors(array $errors): void {
    if ( count($errors) ) {
        $error_redirect = $GLOBALS['error_redirect'];
        $params = count($_GET) ? '?'.http_build_query($_GET) : '';

        $errors = array_reverse($errors);
        $_SESSION['errors'] = $errors;

        header("Location: ../".$error_redirect.".php".$params);
        die();
    }
}

function on_success (string $path): void {
    $params = count($_GET) ? '?'.http_build_query($_GET) : '';
    header("Location: ./../".$path.".php".$params);
    die();
}
