<?php
include_once('site_id.php');
include_once('initialize.inc.php');

$context = stream_context_create(array('ssl'=>array('verify_peer' => false,"verify_peer_name"=>false)));

libxml_set_streams_context($context);

$xml = simplexml_load_file('https://www.tcmb.gov.tr/kurlar/today.xml');

foreach ($xml->Currency as $Currency) {

if ($Currency['Kod'] == "USD") {$usd_ES = $Currency->ForexSelling; $usd_EA = $Currency->ForexBuying; }
if ($Currency['Kod'] == "EUR") {$eur_ES = $Currency->ForexSelling; $eur_EA = $Currency->ForexBuying; }
if ($Currency['Kod'] == "GBP") {$gbp_ES = $Currency->ForexSelling; $gbp_EA = $Currency->ForexBuying; }

}

$Db->query("INSERT INTO currency_rates (rate_date,rate_buy_usd,rate_buy_eur,rate_buy_gbp,rate_sell_usd,rate_sell_eur,rate_sell_gbp) VALUES  ('".$date."','".$usd_ES."','".$eur_ES."','".$gbp_ES."','".$usd_EA."','".$eur_EA."','".$gbp_EA."') ");

$Db->query("DELETE FROM currency_rates WHERE rate_date < '".$date."' ");

?>