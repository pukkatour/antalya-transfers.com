<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$start  = str_replace(' ', '', $_POST['st']);
$end    = str_replace(' ', '', $_POST['en']);
$key    = 'AIzaSyA2H6tQFao2IeuQq0YReIFO6k92LU-9Sc0';

$result = eseginzikinigetir($start,$end,$key);

$dist   = ceil($result["distance"]);
$time   = ceil($result["time"]);

$arr    = array ('response'=>'ok','dist'=>$dist,'time'=>$time);
echo json_encode($arr); exit;

} else {

$arr = array ('response'=>'nok');
echo json_encode($arr); exit;

}


function eseginzikinigetir($start, $end, $key)
{
    $url      = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$start."&destinations=".$end."&units=metric&mode=driving&key=".$key;
    $ch       = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $result   = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($result, true);
    $distance = $response['rows'][0]['elements'][0]['distance']['value'];
    $time     = $response['rows'][0]['elements'][0]['duration']['value'];

    return array('distance' => $distance/1609.344, 'time' => $time/60);
}

?>