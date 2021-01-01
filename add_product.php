<?php
$title = 'Add Product';
require_once "./lib/nav.php";

?>

<div class="page-header">
    <?php $heading = trim(explode('|', $title)[0]) ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4><?php echo $heading ?? '' ?></h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./products.php">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $heading ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card-box pd-20 height-100-p mb-30">
    <form action='./forms/add_product.php' method='POST' enctype="multipart/form-data">
        <div class="row">
            <div class="input-group custom col-md-6">
                <input type="text" class="form-control form-control-lg" placeholder="Product Name" name='product_name' required>
            </div>
            <div class="input-group custom col-md-6">
                <input type="number" class="form-control form-control-lg" placeholder="Price (optional)" name='price'>
            </div>
            <div class="input-group custom col-md-6">
                <input type="text" class="form-control form-control-lg" placeholder="Formula (optional)" name='formula'>
            </div>
            <div class="input-group custom col-md-6">
                <input type="file" class="form-control form-control-lg" placeholder="Product Image (optional)" name='file' accept="image/*" >
            </div>
            <div class="input-group custom col-md-12">
                <textarea class="form-control form-control-lg" placeholder="Decription (optional)" name="description" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-0">
                    <input type='submit' class="btn btn-primary btn-lg btn-block" value='Add Product'>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include_once "./lib/auth_footer.php";
