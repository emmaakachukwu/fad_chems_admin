<?php
$title = 'Settings';
require_once "./lib/nav.php";

// $sql = "SELECT * FROM users WHERE role != 'admin' ORDER BY created_at DESC";
// $result = $link->query($sql);
// $users = [];
// if ( $result->num_rows ) {
//     while($res = $result->fetch_object())
//         array_push($users, $res);
// }

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



<?php include_once "./lib/auth_footer.php";
