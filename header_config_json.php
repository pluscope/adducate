<?php
session_start();
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/action/action_post.php");


if( !isset($_SESSION["IS_PUT"]) )  { //접속 이력
 $_SESSION["IS_PUT"] = true;
//############################################################
//# START : 접속기록을 남긴다
/////////////////////////////
function getBrowser() {
    $broswerList = array('MSIE', 'Chrome', 'Firefox', 'iPhone', 'iPad', 'Android', 'PPC', 'Safari', 'Trident', 'none');
    $browserName = 'none';
    
    foreach ($broswerList as $userBrowser){
        if($userBrowser === 'none') break;
        if(strpos($_SERVER['HTTP_USER_AGENT'], $userBrowser)) {
            $browserName = $userBrowser;
            break;
        }
    }
    return $browserName;
}

function isBlockBrowser() {
    $BrowserName = getBrowser();
    if($BrowserName === 'MSIE'||$BrowserName === 'Trident'){
        $BrowserName = "IE";
    }
    return $BrowserName;
}


function getOsInfo()
{
    $userAgent = $_SERVER["HTTP_USER_AGENT"];
    
    if (preg_match('/linux/i', $userAgent)){
        $os = 'linux';}
        elseif(preg_match('/macintosh|mac os x/i', $userAgent)){
            $os = 'mac';}
            elseif (preg_match('/windows|win32/i', $userAgent)){
                $os = 'windows';}
                else {
                    $os = 'Other';}
                    
                    return $os;
}

// https 접속일 경우 1을 반환한다
function isSecure() {
    return
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443;
}

$pre_url       = "index";
if( isset($_SERVER["HTTP_REFERER"]) ){
    $pre_url       = $_SERVER["HTTP_REFERER"];
}

$user_agent   = $_SERVER["HTTP_USER_AGENT"];
$browser = isBlockBrowser();
$os      = getOsInfo();

$arrDay= array('일요일','월요일','화요일','수요일','목요일','금요일','토요일');
$date = date('w'); //0 ~ 6 숫자 반환

$static_page_url    = $_SERVER["PHP_SELF"];
$static_dayofweek   = $arrDay[$date];
$static_access_time = date("H");
$static_user_ip     = getenv('REMOTE_ADDR');
$static_enroll_date = date("Y") . date("m") . date("d");
$static_signdate    = time();
$static_year        = date("Y");
$static_month       = date("m");
$static_day         = date("d");

// https 접속일 경우만 기록한다. http 접속은 webalizer 에 기록된다
// if (isSecure())
    // {
$STATISTICS_QUERY = "INSERT INTO LOG ( user_agent, browser, os, year, month, day, page_url,pre_url, dayofweek, access_time, user_ip, access_date, signdate ) VALUES ( '$user_agent', '$browser', '$os', '$static_year', '$static_month', '$static_day', '$static_page_url','$pre_url', '$static_dayofweek', '$static_access_time', '$static_user_ip', '$static_enroll_date', '$static_signdate' ) ";

$result = mysqli_query($conn,$STATISTICS_QUERY);
}
// }
//############################################################
//# END : 접속기록을 남긴다
//############################################################

?>
