<?php
$host        = $_POST['host'];
$userName    = $_POST['userName'];
$password    = $_POST['password'];
$dbName      = $_POST['dbName'];

$con=mysqli_connect($host,$userName,$password,$dbName);
// Check connection
if (mysqli_connect_errno()) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}
/*
// DROP TABLE
$sql = "DROP TABLE IF EXISTS `g5_auth`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_autosave`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_board_new`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_board_file`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_board_good`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_board`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_cert_history`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_config`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_content`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_faq_master`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_faq`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_group_member`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_group`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_login`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_mail`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_member_social_profiles`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_member`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_memo`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_menu`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_new_win`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_point`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_poll_etc`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_poll`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_popular`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_qa_content`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_qa_config`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_scrap`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_banner`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_category`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_cart`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_coupon_zone`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_coupon_log`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_coupon`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_default`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_event_item`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_event`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_inicis_log`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_item_option`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_item_relation`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_item_stocksms`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_item_use`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_item_qa`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}
$sql = "DROP TABLE IF EXISTS `g5_shop_item`";
$result = mysqli_query($con,$sql)
if (!$result) {
	die("Error creating database: " . mysqli_error($con));
}




g5_shop_order
g5_shop_order_address
g5_shop_order_data
g5_shop_order_delete
g5_shop_personalpay
g5_shop_sendcost
g5_shop_wish
g5_uniqid
g5_visit
g5_visit_sum
g5_write_free
g5_write_gallery
g5_write_notice
g5_write_qa
*/
$mysqli = new sql($host,$userName,$password,$dbName);
print_r($mysqli);
mysqli_close($con);
?>