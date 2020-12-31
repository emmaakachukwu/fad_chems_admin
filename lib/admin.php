<?php

if ( $user->role != 'admin' ) {
    logout(false);
}

?>

<style>
    table {
        display: table !important;
    }
</style>