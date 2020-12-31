<?php
$title = 'Orders';
require_once "./lib/nav.php";

$sql = "SELECT o.*, u.username, p.name, p.image_path FROM orders AS o LEFT JOIN users AS u ON o.user_id = u.id LEFT JOIN products AS p ON o.product_id = p.id ORDER BY o.created_at DESC";
$result = $link->query($sql);
$orders = [];
if ( $result->num_rows ) {
    while($res = $result->fetch_object())
        array_push($orders, $res);
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
                    <li class="breadcrumb-item"><a href="./dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $heading ?? '' ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card-box pd-20 height-100-p mb-30">
    <table class="table table-responsive">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Ordered By</th>
            <th scope="col">Product Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Status</th>
            <th scope="col">Ordered On</th>
            <th scope="col">Actions</th>
        </thead>
        <?php if ( count($orders) ) { ?>
            <tbody>
                <?php for ( $i = 0; $i < count($orders); $i++ ) { ?>
                    <tr>
                        <td><?php echo  $i+1 ?></td>
                        <td>
                            <?php if ( isset($orders[$i]->image_path) ) { ?>
                                <img src="./uploads/products/<?php echo $orders[$i]->image_path ?>" alt="<?php echo $orders[$i]->name ?>" class="image-fluid">
                            <?php } ?>
                        </td>
                        <td><?php echo $orders[$i]->username ?></td>
                        <td><?php echo $orders[$i]->name ?></td>
                        <td><?php echo $orders[$i]->quantity ?></td>
                        <td><span class="text-muted"><?php echo $orders[$i]->paid ? 'Paid' : 'Not Paid' ?></span></td>
                        <td><?php echo date('d M, Y h:i a', strtotime($orders[$i]->created_at)) ?? '' ?></td>
                        <td><button class="btn btn-primary btn-sm">Mark as delivered</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        <?php } ?>
    </table>					
</div>

<?php include_once "./lib/auth_footer.php";
