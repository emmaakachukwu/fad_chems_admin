<?php
$title = 'Products';
require_once "./lib/nav.php";

$sql = "SELECT * FROM products WHERE deleted_at IS NULL ORDER BY created_at DESC";
$result = $link->query($sql);
$products = [];
if ( $result->num_rows ) {
    while($res = $result->fetch_object())
        array_push($products, $res);
}

function shorten_sring(string $var): string {
    return strlen($var) > 25 ? substr($var, 0, 25).'...' : $var;
}
?>

<div class="page-header">
    <?php $heading = trim(explode('|', $title)[0]) ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4><?php echo $heading ?? '' ?></h4>
            </div>
        </div>
    </div>
    <a href="./add_product.php" class="btn btn-primary text-white mt-3"><i class="fa fa-plus"></i> &nbsp; Add Product</a>
</div>

<div class="card-box pd-20 height-100-p mb-30">
    <table class="table table-responsive">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Formula</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">Created On</th>
            <th scope="col">Actions</th>
        </thead>
        <?php if ( count($products) ) { ?>
            <tbody>
                <?php for ( $i = 0; $i < count($products); $i++ ) { ?>
                    <tr>
                        <td><?php echo  $i+1 ?></td>
                        <td>
                            <?php if ( isset($products[$i]->image_path) ) { ?>
                                <img src="./uploads/products/<?php echo $products[$i]->image_path ?>" alt="<?php echo $products[$i]->name ?>" class="image-fluid rounded table-image">
                            <?php } ?>
                        </td>
                        <td><?php echo $products[$i]->name ?></td>
                        <td><?php echo $products[$i]->formula ?></td>
                        <td><?php echo number_format($products[$i]->price) ?></td>
                        <td><?php echo shorten_sring($products[$i]->desc) ?></td>
                        <td><?php echo date('d M, Y h:i a', strtotime($products[$i]->created_at)) ?? '' ?></td>
                        <td><a href="./edit_product.php?product_id=<?php echo $products[$i]->id ?>" class="btn btn-primary btn-sm text-white">Edit</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        <?php } ?>
    </table>					
</div>

<?php include_once "./lib/auth_footer.php";
