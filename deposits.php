<?php
$title = 'Deposits';
require_once "./lib/nav.php";

$sql = "SELECT d.*, u.username FROM deposits AS d LEFT JOIN users AS u ON d.user_id = u.id ORDER BY d.created_at DESC";
$result = $link->query($sql);
$deposits = [];
if ( $result->num_rows ) {
    while($res = $result->fetch_object())
        array_push($deposits, $res);
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
            <th scope="col">Username</th>
            <th scope="col">Amount</th>
            <th scope="col">Created On</th>
            <th scope="col">Actions</th>
        </thead>
        <?php if ( count($deposits) ) { ?>
            <tbody>
                <?php for ( $i = 0; $i < count($deposits); $i++ ) { ?>
                    <tr>
                        <td><?php echo  $i+1 ?></td>
                        <td><?php echo $deposits[$i]->name ?></td>
                        <td><?php echo $deposits[$i]->amount ?></td>
                        <td><?php echo date('d M, Y h:i a', strtotime($deposits[$i]->created_at)) ?? '' ?></td>
                        <td><button class="btn btn-primary btn-sm">Approve</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        <?php } ?>
    </table>					
</div>

<?php include_once "./lib/auth_footer.php";
