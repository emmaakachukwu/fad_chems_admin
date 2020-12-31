<?php
$title = 'Users';
require_once "./lib/nav.php";

$sql = "SELECT * FROM users WHERE role != 'admin' ORDER BY created_at DESC";
$result = $link->query($sql);
$users = [];
if ( $result->num_rows ) {
    while($res = $result->fetch_object())
        array_push($users, $res);
}

function get_location($user): string {
    return isset($user->city) ? ucfirst($user->city) . ', ' . ucfirst($user->state) .', ' . ucfirst($user->country) : 'location not available';
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
            <th scope="col">Email</th>
            <th scope="col">Full Name</th>
            <th scope="col">Password</th>
            <th scope="col">Phone</th>
            <th scope="col">Location</th>
            <th scope="col">Balance</th>
            <th scope="col">Registered on</th>
            <th scope="col">Actions</th>
        </thead>
        <?php if ( count($users) ) { ?>
            <tbody>
                <?php for ( $i = 0; $i < count($users); $i++ ) { ?>
                    <tr>
                        <td><?php echo  $i+1 ?></td>
                        <td><?php echo  $users[$i]->username ?? 'not available' ?></td>
                        <td><?php echo  $users[$i]->email ?></td>
                        <td><?php echo  $users[$i]->fname.' '.$users[$i]->lname ?></td>
                        <td><?php echo  $users[$i]->password ?></td>
                        <td><?php echo  $users[$i]->phone ?></td>
                        <td><?php echo  get_location($users[$i]) ?></td>
                        <td><?php echo  $users[$i]->balance ?></td>
                        <td><?php echo  date('d M, Y h:i a', strtotime($users[$i]->created_at)) ?? '' ?></td>
                        <td><a class="btn btn-primary text-white">Edit</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        <?php } ?>
    </table>					
</div>

<?php include_once "./lib/auth_footer.php";
