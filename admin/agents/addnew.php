<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$agent_person_company          = $_POST['agent_person_company'] ? $_POST['agent_person_company'] : null;
$agent_status                  = $_POST['agent_status'] ? $_POST['agent_status'] : null;
$agent_agent_name              = $_POST['agent_agent_name'] ? $_POST['agent_agent_name'] : null;
$agent_agent_surname           = $_POST['agent_agent_surname'] ? $_POST['agent_agent_surname'] : null;
$agent_agent_email             = $_POST['agent_agent_email'] ? $_POST['agent_agent_email'] : null;
$agent_agent_country           = $_POST['agent_agent_country'] ? $_POST['agent_agent_country'] : null;
$agent_agent_city              = $_POST['agent_agent_city'] ? $_POST['agent_agent_city'] : null;
$agent_agent_county            = $_POST['agent_agent_county'] ? $_POST['agent_agent_county'] : null;
$agent_agent_phone             = telefon($_POST['agent_agent_phone']) ? $_POST['agent_agent_phone'] : null;
$agent_company_name            = $_POST['agent_company_name'] ? $_POST['agent_company_name'] : null;
$agent_company_address_country = $_POST['agent_company_address_country'] ? $_POST['agent_company_address_country'] : null;
$agent_company_address_city    = $_POST['agent_company_address_city'] ? $_POST['agent_company_address_city'] : null;
$agent_company_address_county  = $_POST['agent_company_address_county'] ? $_POST['agent_company_address_county'] : null;
$agent_company_phone           = telefon($_POST['agent_company_phone']) ? $_POST['agent_company_phone'] : null;

$Db->query("INSERT INTO agents (agent_person_company,agent_status,agent_agent_name,agent_agent_surname,agent_agent_email,agent_agent_country,agent_agent_city,agent_agent_county,agent_agent_phone,agent_company_name,agent_company_address_country,agent_company_address_city,agent_company_address_county,agent_company_phone) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array($agent_person_company,$agent_status,$agent_agent_name,$agent_agent_surname,$agent_agent_email,$agent_agent_country,$agent_agent_city,$agent_agent_county,$agent_agent_phone,$agent_company_name,$agent_company_address_country,$agent_company_address_city,$agent_company_address_county,$agent_company_phone));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/agents/index.php");

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>