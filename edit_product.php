<?php

$title = 'Edit Product';
require_once "./lib/nav.php";

$id = isset($_GET['product_id']) ? trim($_GET['product_id']) : null;

if ( !$id || empty(trim($id)) ) {
    _404_error();
}

$sql = "SELECT * FROM products WHERE id = '$id' AND deleted_at IS NULL LIMIT 1";
$result = $link->query($sql);
if ( !$result->num_rows ) {
    _404_error();
}
$product = $result->fetch_object();

function _404_error(): void {
    http_response_code(404);
    exit;
}

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
    <form action='./forms/edit_product.php?product_id=<?php echo $product->id ?>' method='POST' enctype="multipart/form-data">
        <div class="row">
            <div class="input-group custom col-md-6">
                <input type="text" class="form-control form-control-lg" placeholder="Product Name" name='product_name' value="<?php echo $product->name ?>" required>
            </div>
            <div class="input-group custom col-md-6">
                <input type="number" class="form-control form-control-lg" placeholder="Price (optional)" name='price' value="<?php echo $product->price ?? '' ?>">
            </div>
            <div class="input-group custom col-md-6">
                <input type="text" class="form-control form-control-lg" placeholder="Formula (optional)" name='formula' value="<?php echo $product->formula ?? '' ?>">
            </div>
            <div class="input-group custom col-md-6">
                <input type="file" class="form-control form-control-lg" placeholder="Product Image (optional)" name='file' accept="image/*" >
            </div>
            <div class="input-group custom col-md-12">
                <textarea class="form-control form-control-lg" placeholder="Decription (optional)" name="description" cols="30" rows="10"><?php echo $product->desc ?></textarea>
            </div>
        </div>

        <?php if ( isset($product->image_path) && !empty(trim($product->image_path)) ) { ?>
            <p class="mt-4">Product Image</p>
            <div class="row mb-4">
                <img src="./uploads/products/<?php echo $product->image_path ?>" alt="<?php echo $product->name ?>" class="image-fluid rounded col-md-4">
            </div>
            <input type="hidden" value="<?php echo $product->image_path ?>" name="newFileName">
        <?php } ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-0">
                    <input type='submit' class="btn btn-primary btn-lg btn-block" value='Update Product'>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include_once "./lib/auth_footer.php";
