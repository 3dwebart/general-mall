<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$addGet = '';
$a = $_GET['a'];
$b = $_GET['b'];
$c = $_GET['c'];
$getCnt = count($_GET);
echo $getCnt;

if($getCnt == 0) {
	$addGet .= '?d=d';
} else {
	$addGet .= 'a='.$a.'&b='.$b.'&c='.$c.'&d=d';
}
?>
<a href="./test.php?<?php echo $addGet; ?>">
	TEST
</a>
