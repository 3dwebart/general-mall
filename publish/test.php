<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "3dwebart";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
$sql = "SHOW VARIABLES LIKE 'version'";
//$sql = "SELECT count(id) AS cnt FROM bo_table_poetry1 ";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
$v = $row['Value'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>PHP to JS Array</h1>
<h1>php version : <?php echo PHP_VERSION; ?></h1>
<h1>mysql version : <?php echo $v; ?></h1>
<?php
$arr = array();
$arr = [
	'T1' => '첫번째 배열 입니다.', 
	'T2' => '두번째 배열 입니다.', 
	'T3' => '세번째 배열 입니다.'
];
?>
<h5>===== PHP =====</h5>
<?php
	foreach ($arr as $key => $value) {
		echo "<div><span style='color: orange'>".$key."</span> : <span style='color: purple'>".$value."</span></div>";
	}
?>
<h5>===== js =====</h5>
<div class="ja"></div>
<script src="https://code.jquery.com/jquery.js"></script>
<script>
(function($) {
	var jArr = <?php echo json_encode($arr); ?>;
	$.each(jArr, function(k,v) {
		jQuery('.ja').append('<div><span style="color: red;">' + k + '</span> : <span style="color: blue;">' + v + '</span></div>');
	});
	console.log(jArr);
})(jQuery);
</script>
</body>
</html>
<?php
mysql_close($conn);
?>