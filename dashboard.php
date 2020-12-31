<?php
$title = 'Dashbaord';
require_once "./lib/nav.php";

$sql = " SELECT COUNT(*) AS users_count FROM users WHERE role != 'admin' ";
$result = $link->query($sql);
$users_count = $result->fetch_object()->users_count;

$sql = " SELECT COUNT(*) AS products_count FROM products WHERE deleted_at IS NULL ";
$result = $link->query($sql);
$products_count = $result->fetch_object()->products_count;

$sql = " SELECT COUNT(*) AS orders_count FROM orders WHERE delivered_at IS NULL ";
$result = $link->query($sql);
$orders_count = $result->fetch_object()->orders_count;

$sql = " SELECT SUM(balance) AS balance FROM users WHERE role != 'admin' ";
$result = $link->query($sql);
$balance = $result->fetch_object()->balance ?? 0;

?>

<style>
	h1.max-width-600 {
		font-size: 65px;
	}
</style>

<div class="pd-20 height-100-p mb-30">
	<div class="row align-items-center">
		<div class="col-md-3 bg-info p-4">
			<h2 class="font-20 weight-500 text-capitalize text-white mb-30">
				Users
			</h2>
			<h1 class="max-width-600 mb-10 text-white"><?php echo $users_count ?></h1>
		</div>
		<div class="col-md-3 bg-secondary p-4">
			<h2 class="font-20 weight-500 text-capitalize text-white mb-30">
				Products
			</h2>
			<h1 class="max-width-600 mb-10 text-white"><?php echo $products_count ?></h1>
		</div>
		<div class="col-md-3 bg-warning p-4">
			<h2 class="font-20 weight-500 text-capitalize text-white mb-30">
				Orders
			</h2>
			<h1 class="max-width-600 mb-10 text-white"><?php echo $orders_count ?></h1>
		</div>
		<div class="col-md-3 bg-danger p-4">
			<h2 class="font-20 weight-500 text-capitalize text-white mb-30">
				Balance
			</h2>
			<h1 class="max-width-600 mb-10 text-white"><span class="font-24 weight-500">$ </span><?php echo $balance ?></h1>
		</div>
	</div>
</div>

<?php include_once "./lib/auth_footer.php";