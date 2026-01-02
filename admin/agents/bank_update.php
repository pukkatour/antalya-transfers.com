<?php
include_once('../include/site_id.php');
include_once('../include/initialize.inc.php');
if (empty($admin_id)) { redirect(SITE_URL."admin/index.php"); exit; }


if (!empty($_POST)) {

$agent_id           = $_POST['agent_id'];
$agent_bank_curr    = $_POST['agent_bank_curr'] ? $_POST['agent_bank_curr'] : null;
$agent_bank_account = $_POST['agent_bank_account'] ? $_POST['agent_bank_account'] : null;
$agent_bank_name    = $_POST['agent_bank_name'] ? $_POST['agent_bank_name'] : null;
$agent_bank_branch  = $_POST['agent_bank_branch'] ? $_POST['agent_bank_branch'] : null;
$agent_bank_swift   = $_POST['agent_bank_swift'] ? $_POST['agent_bank_swift'] : null;
$agent_bank_iban    = $_POST['agent_bank_iban'] ? $_POST['agent_bank_iban'] : null;

$Db->query("UPDATE agents SET agent_bank_name = ?, agent_bank_branch = ?, agent_bank_account = ?, agent_bank_iban = ?, agent_bank_swift = ?, agent_bank_curr = ? WHERE agent_id = ?", array($agent_bank_name,$agent_bank_branch,$agent_bank_account,$agent_bank_iban,$agent_bank_swift,$agent_bank_curr,$agent_id));

$_SESSION["alert"] = "ok";
redirect(SITE_URL."admin/agents/edit.php?agent_id=$agent_id");

} else {

$_SESSION["alert"] = "nok";
redirect(SITE_URL."admin/index.php"); exit;

}

?>