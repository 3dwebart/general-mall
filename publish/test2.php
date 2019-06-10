<?php
function get($url) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		throw new Exception(curl_error($ch));
	}
	curl_close($ch);
	return $result;
}

//// API Url
$url = 'https://quotation-api-cdn.dunamu.com/v1/forex/recent?codes=FRX.KRWUSD';
$result = get($url);
$data = json_decode($result, true);
print_r($data);

$data = $data[0];
// echo $result;
$_provider = $data['provider'];

$_buying = $data['cashBuyingPrice'];
$_selling = $data['cashSellingPrice'];
$_ttselling = $data['ttSellingPrice'];
$_ttbuyling = $data['ttBuyingPrice'];
$_usd = $data['basePrice'];
$_openusd = $data['openingPrice'];
$_chusd = $data['changePrice'];
$_openusd_o = $_usd - $_openusd;
$_openusd_op = ($_chusd/$_usd)*100;
$_openusd = round($_openusd,2);

if ($_openusd_o > 0) {
    $_openusd_p = '<font color="#ff0000">+'.sprintf('%0.2f',$_usd).' 원 <small>▲ +'
       .sprintf('%0.2f',$_chusd).'원 ('.sprintf('%0.2f',$_openusd_op).'%) </small></font>';
} else if ($_openusd_o < 0) {
    $_openusd_p = '<font color="#0051c7">'.sprintf('%0.2f',$_usd).' 원 <small>▼ '
       .sprintf('%0.2f',$_chusd).'원 ('.sprintf('%0.2f',$_openusd_op).'%) </small></font>';
} else {
    $_openusd_p = $_usd.' 원 '
        .sprintf('%0.2f',$_chusd).'원 ('.sprintf('%0.2f',$_openusd_op).'%)';
}
$_datenew = $data['date'].' '.$data['time'];
?>

<ul data-role="listview" data-count-theme="b" data-inset="true">
    <li><h2><?php echo $_provider; ?></h2></li>
    <li style="font-size: 14pt">환율 기준 (1 미국 달러)<br><?php echo $_openusd_p; ?></font></li>
    <li style="font-size: 12pt">살때 : <?=sprintf('%0.2f',$_buying)?><br>
팔때 : <?=sprintf('%0.2f',$_selling)?><br>
보낼때 : <font color="#ff0000"><b><?=sprintf('%0.2f',$_selling)?></b></font><br>
받을때 : <?=sprintf('%0.2f',$_ttbuyling)?></li>
    <li style="color:gray">Date: <?=$_datenew?></li>
</ul>
