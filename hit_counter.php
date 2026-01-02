<?php

$hitCheck = $Db->row("SELECT hit_id FROM hit_counter WHERE hit_page = ? AND hit_date = ? AND hit_site_id = ? ", array($pagename,$date,$site_lang));

if(empty($hitCheck)){

$Db->query("INSERT INTO hit_counter (hit_site_id,hit_page,hit_date,hit_count) VALUES (?,?,?,?)", array($site_lang,$pagename,$date,'1'));

} else {

$Db->query("UPDATE hit_counter SET hit_count = hit_count + 1 WHERE hit_id = ? AND hit_site_id = ? ", array($hitCheck['hit_id'],$site_lang));

}

?>