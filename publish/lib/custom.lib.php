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

    $exchange_sql = "UPDATE `g5_shop_default` SET `de_paypal_krw` = '{$priceRateKRW}'";
    sql_query($exchange_sql);
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
?>