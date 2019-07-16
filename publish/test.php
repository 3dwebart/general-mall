<?php

include_once('./_common.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
$sql = "SHOW VARIABLES LIKE 'version'";
//$sql = "SELECT count(id) AS cnt FROM bo_table_poetry1 ";
//$res = sql_query($sql);
$row = sql_fetch($sql);
$v = $row['Value'];
if(PHP_VERSION >= 5.1) {
	$vChk = 'l v';
} else {
	$vChk = 's v';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>PHP to JS Array</h1>
<h1>php version chk : <?php echo $vChk; ?></h1>
<h1>php version : <?php echo PHP_VERSION; ?></h1>
<h1>mysql version : <?php echo $v; ?></h1>
<h4>SESSION : <?php print_r($_SESSION); ?></h4>
<h5>Shop default test : <?php echo $default['de_settle_max_point']; ?></h5>
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