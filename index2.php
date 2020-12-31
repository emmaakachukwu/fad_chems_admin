<?php
require_once "./lib/header.php";
?>

<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <div class="row">
            <?php for($i=0; $i < 10; $i++) { ?>
                <div class="col-md-3 p-2">
                    <div class="card">
                        <img class="image-fluid rounded" src="./assets/images/product-01.jpg" alt="img">
                        <div class="p-2">
                            <p class="text-muted mb-1">Infinix Zero 8</p>
                            <span>$100</span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>