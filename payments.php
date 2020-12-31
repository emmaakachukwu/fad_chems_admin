<?php

if ( isset($_GET['approved']) ) {
    $is_approved = $_GET['approved'];
    if ( $is_approved == 'true' ) {
        $is_approved = true;
    } else if ( $is_approved == 'false' ) {
        $is_approved = false;
    }
}

$is_approved = $is_approved ?? false;

$prefix = $is_approved ? 'Approved' : 'UnApproved';
$title = $prefix.' Payments';
require_once "./lib/nav.php";

$sql = !$is_approved ? "SELECT * FROM payments WHERE approved_at IS NULL ORDER BY created_at DESC" : "SELECT * FROM payments WHERE approved_at IS NOT NULL ORDER BY created_at DESC";
$result = $link->query($sql);
$payments = [];
if ( $result->num_rows ) {
    while($res = $result->fetch_object())
        array_push($payments, $res);
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
</div>

<div class="card-box pd-20 height-100-p mb-30">
    <table class="table table-responsive">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Amount</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </thead>
        <?php if ( count($payments) ) { ?>
            <tbody>
                <?php for ( $i = 0; $i < count($payments); $i++ ) { ?>
                    <tr>
                        <td><?php echo  $i+1 ?></td>
                        <td><?php echo $payments[$i]->email ?></td>
                        <td><?php echo $payments[$i]->amount ?></td>
                        <td><?php echo date('d M, Y h:i a', strtotime($payments[$i]->created_at)) ?? '' ?></td>
                        <td><button class="btn btn-primary btn-sm">View</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        <?php } ?>
    </table>					
</div>

<?php include_once "./lib/auth_footer.php";
