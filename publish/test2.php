<?php
include_once('./_common.php');
$fp = fopen(G5_PATH.'/test.sql', 'r') or die('파일을 열 수 없습니다.');
$sql = fgets($fp);
$res = sql_query($sql);
$cnt = sql_num_rows($res);
$row = sql_fetch($sql);
echo "<div style='width: 100%; height: 3px; border-top: 2px dotted #000;border-bottom: 2px dotted #000;'></div>";
echo G5_PATH.'/install';
echo "<div style='width: 100%; height: 3px; border-top: 2px dotted #000;border-bottom: 2px dotted #000;'></div>";
echo $sql;
echo "<div style='width: 100%; height: 3px; border-top: 2px dotted #000;border-bottom: 2px dotted #000;'></div>";
echo $cnt;
echo "<div style='width: 100%; height: 3px; border-top: 2px dotted #000;border-bottom: 2px dotted #000;'></div>";
print_r($res);
echo "<div style='width: 100%; height: 3px; border-top: 2px dotted #000;border-bottom: 2px dotted #000;'></div>";
echo 'de_admin_company_name : ' . $row['de_admin_company_name'];
echo "<div style='width: 100%; height: 3px; border-top: 2px dotted #000;border-bottom: 2px dotted #000;'></div>";
fclose($sql);
?>