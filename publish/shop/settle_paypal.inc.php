<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ($default['de_paypal_test']) { // 테스트
    $pp_conf_action_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
}
else {
    $pp_conf_action_url = 'https://www.paypal.com/cgi-bin/webscr';
}

$pp_conf_mid        = $default['de_paypal_mid']; // PAYPAL ACCOUNT 정보.
$pp_currency_code   = 'USD'; // 화폐정보입력
$pp_country         = 'US'; // 국가별 코드 입력.
$pp_exrate          = $default['de_paypal_exrate'];

// yahoo api : Conversion from usd to krw
function wz_exrate_krw() { 
    
    global $default;
    
    return $default['de_paypal_krw']; // 처리되지 않을경우
}

if (!function_exists('wz_fwrite_log')) {
    function wz_fwrite_log($log_dir, $error) { 
        $log_file = fopen($log_dir, "a");
        fwrite($log_file, $error."\r\n");
        fclose($log_file);
    } 
}
?>