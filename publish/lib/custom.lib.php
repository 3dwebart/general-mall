<?php
if (!defined('_GNUBOARD_')) exit;

/*************************************************************************
**
**  사용자 정의 함수 모음
**
*************************************************************************/
/********** 2019-06-07 실시간 환율적용(원화를 달러화로 변경하여 보여줌) **********/
/***** BIGIN :: 실시간 환율 변동 : 1달러당 원화 *****/
function ratePrice() {
	//$rate = $_GET['rate'];
	if(empty($rate)) {
		$rate = 'KRW';
	}

	$url = "http://api.manana.kr/exchange/rate/".$rate."/KRW,USD.json";
	$curl_handle = curl_init();
	curl_setopt($curl_handle, CURLOPT_URL, $url);
	curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_handle, CURLOPT_USERAGENT, '`http://scberries.cafe24.com`');

	$json = curl_exec($curl_handle);
	curl_close($curl_handle);

	$data = json_decode($json,true);
	for($i = 0; $i < count($data); $i++) {
		if($data[$i]['name'] == 'USDKRW=X') { // $rate = KRW - 1달러당 원화
			$priceRateKRW = sprintf("%2.4f",$data[$i]['rate']);
		}
		/*
		if($data[$i]['name'] == 'KRWUSD=X') { // $rate = USD - 1원당 달러화
			$priceRate = $data[$i]['rate'];
		}
		*/
	}

	$auto_chk_sql = "SELECT `de_auto_payment_krw` FROM `g5_shop_default`";
	$auto_chk_row = sql_fetch($auto_chk_sql);
	$auto_chk = $auto_chk_row['de_auto_payment_krw'];

	if($auto_chk == 'on') {
		$exchange_sql = "UPDATE `g5_shop_default` SET `de_paypal_krw` = '{$priceRateKRW}'";
		sql_query($exchange_sql);
	}
	/***** END :: 실시간 환율 변동 : 1달러당 원화 *****/
	/*
		위의 실시간 환율 변동 무시하고 쇼핑몰 환경설정에 있는 페이팔 기본환율 적용함
		사용하지 않을시 삭제
	*/
	$p_sql = "SELECT `de_paypal_krw` FROM `g5_shop_default`";
	$p_row = sql_fetch($p_sql);
	$p_rate = $p_row['de_paypal_krw'];
	$priceRate = (1/$p_rate);

	return $priceRate;
}

function eventBanner($ev_id,$type,$listMod,$limit,$rowClass = 'row') {
	/*
		$ev_id : 값이 false 가 아니면 멀티 있으면 싱글 작동
		$type : 이벤트 종류(클릭시 변경) 
		        0 : 리스트형
		        1 : 페이지형
		$listMod : 라인당 이벤트 배너 개수
		$limit : 전체 이벤트 배너 수
		$rowClass : 이벤트 배너간 좌우 간격
		- 기본 row : 좌+우 15px = 30px
		- row-5 를 넣으면 좌+우 5px = 10px
	*/
	switch ($listMod) {
		case 1:
			$col_class = 'col-lg-12';
		break;

		case 2:
			$col_class = 'col-lg-6';
		break;

		case 3:
			$col_class = 'col-lg-4';
		break;

		case 4:
			$col_class = 'col-lg-3';
		break;

		case 5:
			$col_class = 'col-lg-20';
		break;

		case 6:
			$col_class = 'col-lg-2';
		break;

		case 12:
			$col_class = 'col-lg-1';
		break;
		
		default:
			$col_class = 'col';
		break;
	}

	$html = '';
	if($ev_id == false) {
		$whereAdd = '';
	} else {
		$whereAdd = " AND ev_id = '$ev_id'";
	}
	$sql = "SELECT * FROM g5_shop_event WHERE ev_kind = '$type'$whereAdd LIMIT 0,$limit";
	$result = sql_query($sql);
	$cnt = sql_num_rows($result);

	if($cnt == 0) {
		$html = '<div style-"height: 120px;" class="d-flex .align-items-center justify-content-space-between"><span>There are currently no events registered.</span></div>';
	}

	for ($i = 0; $row = sql_fetch_array($result); $i++) {
		if($i == 0) {
			$html .= '<div class="'.$rowClass.'">';
		}
		if($type == 0) {
			$link = G5_SHOP_URL.'/event.php?ev_id='.$row['ev_id'];
		}
		if($type == 1) {
			$link = G5_BBS_URL.'/content.php?co_id='.$row['co_id'];
		}
		
		$html .= '<div class="'.$col_class.'">';
		$html .= '<a href="'.$link.'">';
		$html .= '<img src="'.G5_DATA_URL.'/event/'.$row['ev_id'].'_m" alt="'.$row['ev_id'].'" class="img-fluid" />';
		$html .= '</a>';
		$html .= '</div>';
	}
	if($i > 0) {
		$html .= '</div>';
	}

	echo $html;
}
?>