<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$currentRate = $_GET['rate'];
if(empty($currentRate)) {
	$currentRate = 'KRW';
}

$url = "http://api.manana.kr/exchange/rate/".$currentRate."/JPY,KRW,USD.json";
$curl_handle = curl_init();
curl_setopt($curl_handle, CURLOPT_URL, $url);
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_USERAGENT, '`http://scberries.cafe24.com`');

$json = curl_exec($curl_handle);
curl_close($curl_handle);

$data = json_decode($json,true);

$test = 12345.235;
//$test = 0.235;
printf('%2.2f',$test);
echo "<br /><br /><br />";
for($i = 0; $i < count($data); $i++) {
	if($data[$i]['name'] == 'USDKRW=X') { // KRW - 1달러당 원화
		echo "dollor by won<br />";
		echo sprintf("%2.2f",$data[$i]['rate']);
	}
	if($data[$i]['name'] == 'KRWUSD=X') { // USD - 1원당 달러화
		echo "won by dollor<br />";
		echo($data[$i]['rate']);
	}
}
//print_r($data[18]);
?>