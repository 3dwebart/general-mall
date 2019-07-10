<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>PHP to JS Array</h1>
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
