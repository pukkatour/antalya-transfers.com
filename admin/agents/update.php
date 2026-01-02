<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$agent_id                        = $_POST['agent_id'];
$agent_person_company            = $_POST['agent_person_company'] ? $_POST['agent_person_company'] : null;
$agent_status                    = $_POST['agent_status'] ? $_POST['agent_status'] : null;

$agent_agent_name                = $_POST['agent_agent_name'] ? $_POST['agent_agent_name'] : null;
$agent_agent_surname             = $_POST['agent_agent_surname'] ? $_POST['agent_agent_surname'] : null;
$agent_agent_email               = $_POST['agent_agent_email'] ? $_POST['agent_agent_email'] : null;
$agent_agent_country             = $_POST['agent_agent_country'] ? $_POST['agent_agent_country'] : null;
$agent_agent_city                = $_POST['agent_agent_city'] ? $_POST['agent_agent_city'] : null;
$agent_agent_county              = $_POST['agent_agent_county'] ? $_POST['agent_agent_county'] : null;
$agent_agent_address_post_code   = $_POST['agent_agent_address_post_code'] ? $_POST['agent_agent_address_post_code'] : null;
$agent_agent_phone               = telefon($_POST['agent_agent_phone']) ? $_POST['agent_agent_phone'] : null;
$agent_agent_address             = $_POST['agent_agent_address'] ? $_POST['agent_agent_address'] : null;

$agent_company_name              = $_POST['agent_company_name'] ? $_POST['agent_company_name'] : null;
$agent_company_address_country   = $_POST['agent_company_address_country'] ? $_POST['agent_company_address_country'] : null;
$agent_company_address_city      = $_POST['agent_company_address_city'] ? $_POST['agent_company_address_city'] : null;
$agent_company_address_county    = $_POST['agent_company_address_county'] ? $_POST['agent_company_address_county'] : null;
$agent_company_address           = $_POST['agent_company_address'] ? $_POST['agent_company_address'] : null;
$agent_company_address_post_code = $_POST['agent_company_address_post_code'] ? $_POST['agent_company_address_post_code'] : null;
$agent_company_phone             = telefon($_POST['agent_company_phone']) ? $_POST['agent_company_phone'] : null;
$agent_company_tax_office        = $_POST['agent_company_tax_office'] ? $_POST['agent_company_tax_office'] : null;
$agent_company_tax_number        = $_POST['agent_company_tax_number'] ? $_POST['agent_company_tax_number'] : null;
$agent_company_email             = $_POST['agent_company_email'] ? $_POST['agent_company_email'] : null;
$agent_company_web_url           = $_POST['agent_company_web_url'] ? $_POST['agent_company_web_url'] : null;

$agent_person1_name              = $_POST['agent_person1_name'] ? $_POST['agent_person1_name'] : null;
$agent_person1_surname           = $_POST['agent_person1_surname'] ? $_POST['agent_person1_surname'] : null;
$agent_person1_email             = $_POST['agent_person1_email'] ? $_POST['agent_person1_email'] : null;
$agent_person1_country           = $_POST['agent_person1_country'] ? $_POST['agent_person1_country'] : null;
$agent_person1_phone             = telefon($_POST['agent_person1_phone']) ? $_POST['agent_person1_phone'] : null;

$agent_person2_name              = $_POST['agent_person2_name'] ? $_POST['agent_person2_name'] : null;
$agent_person2_surname           = $_POST['agent_person2_surname'] ? $_POST['agent_person2_surname'] : null;
$agent_person2_email             = $_POST['agent_person2_email'] ? $_POST['agent_person2_email'] : null;
$agent_person2_country           = $_POST['agent_person2_country'] ? $_POST['agent_person2_country'] : null;
$agent_person2_phone             = telefon($_POST['agent_person2_phone']) ? $_POST['agent_person2_phone'] : null;

$agent_person3_name              = $_POST['agent_person3_name'] ? $_POST['agent_person3_name'] : null;
$agent_person3_surname           = $_POST['agent_person3_surname'] ? $_POST['agent_person3_surname'] : null;
$agent_person3_email             = $_POST['agent_person3_email'] ? $_POST['agent_person3_email'] : null;
$agent_person3_country           = $_POST['agent_person3_country'] ? $_POST['agent_person3_country'] : null;
$agent_person3_phone             = telefon($_POST['agent_person3_phone']) ? $_POST['agent_person3_phone'] : null;

$agent_text                      = $_POST['agent_text'] ? $_POST['agent_text'] : null;

if (empty($agent_id)) { redirect(SITE_URL."admin/agents/index.php"); exit; } else {

if (!empty($agent_agent_email)) {
if (!filter_var($agent_agent_email, FILTER_VALIDATE_EMAIL)) { redirect(SITE_URL."admin/agents/edit.php?agent_id=$agent_id&error=email1"); }
}

if (!empty($agent_company_email)) {
if (!filter_var($agent_company_email, FILTER_VALIDATE_EMAIL)) { redirect(SITE_URL."admin/agents/edit.php?agent_id=$agent_id&error=email2"); }
}

if (!empty($agent_person1_email)) {
if (!filter_var($agent_person1_email, FILTER_VALIDATE_EMAIL)) { redirect(SITE_URL."admin/agents/edit.php?agent_id=$agent_id&error=email3"); }
}

if (!empty($agent_person2_email)) {
if (!filter_var($agent_person2_email, FILTER_VALIDATE_EMAIL)) { redirect(SITE_URL."admin/agents/edit.php?agent_id=$agent_id&error=email4"); }
}

if (!empty($agent_person3_email)) {
if (!filter_var($agent_person3_email, FILTER_VALIDATE_EMAIL)) { redirect(SITE_URL."admin/agents/edit.php?agent_id=$agent_id&error=email5"); }
}

$Db->query("UPDATE agents SET agent_person_company = ?, agent_agent_name = ?, agent_agent_surname = ?, agent_agent_email = ?, agent_agent_country = ?, agent_agent_city = ?, agent_agent_county = ?, agent_agent_address = ?, agent_agent_address_post_code = ?, agent_agent_phone = ?, agent_company_name = ?, agent_company_address_country = ?, agent_company_address_city = ?, agent_company_address_county = ?, agent_company_address = ?, agent_company_address_post_code = ?, agent_company_phone = ?, agent_company_tax_office = ?, agent_company_tax_number = ?, agent_company_web_url = ?, agent_company_email = ?, agent_person1_name = ?, agent_person1_surname = ?, agent_person1_email = ?, agent_person1_country = ?, agent_person1_phone = ?, agent_person2_name = ?, agent_person2_surname = ?, agent_person2_email = ?, agent_person2_country = ?, agent_person2_phone = ?, agent_person3_name = ?, agent_person3_surname = ?, agent_person3_email = ?, agent_person3_country = ?, agent_person3_phone = ?,  agent_text = ?, agent_status = ? WHERE agent_id = ?", array($agent_person_company,$agent_agent_name,$agent_agent_surname,$agent_agent_email,$agent_agent_country,$agent_agent_city,$agent_agent_county,$agent_agent_address,$agent_agent_address_post_code,$agent_agent_phone,$agent_company_name,$agent_company_address_country,$agent_company_address_city,$agent_company_address_county,$agent_company_address,$agent_company_address_post_code,$agent_company_phone,$agent_company_tax_office,$agent_company_tax_number,$agent_company_web_url,$agent_company_email,$agent_person1_name,$agent_person1_surname,$agent_person1_email,$agent_person1_country,$agent_person1_phone,$agent_person2_name,$agent_person2_surname,$agent_person2_email,$agent_person2_country,$agent_person2_phone,$agent_person3_name,$agent_person3_surname,$agent_person3_email,$agent_person3_country,$agent_person3_phone,$agent_text,$agent_status,$agent_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/agents/edit.php?agent_id=$agent_id");

}

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>