<?php
if (isset($temp_lang) && !empty($temp_lang)) {
$email_template   = $Db->row("SELECT * FROM email_template WHERE temp_lang_id = ?", array($temp_lang));
} else {
$email_template   = $Db->row("SELECT * FROM email_template WHERE temp_lang_id = ?", array($site_lang));
}

$page_title       = $sitesettings['site_name'];
$logo             = IMAGE_FOLDER.$sitesettings['site_logo'];
$image_alts       = $sitesettings['site_name'];
$phone_number     = $sitesettings['site_phone_1'];
$header_photo     = IMAGE_FOLDER."email/".$email_template['header_photo'];
$box1_photo       = IMAGE_FOLDER."email/".$email_template['box1_photo'];
$box1_title       = $email_template['box1_title'];
$box1_text        = $email_template['box1_text'];
$box1_link        = $email_template['box1_link'];
$box1_link_text   = $email_template['box1_link_text'];
$box2_photo       = IMAGE_FOLDER."email/".$email_template['box2_photo'];
$box2_title       = $email_template['box2_title'];
$box2_text        = $email_template['box2_text'];
$box2_link        = $email_template['box2_link'];
$box2_link_text   = $email_template['box2_link_text'];
$box3_photo       = IMAGE_FOLDER."email/".$email_template['box3_photo'];
$box3_title       = $email_template['box3_title'];
$box3_text        = $email_template['box3_text'];
$box3_link        = $email_template['box3_link'];
$box3_link_text   = $email_template['box3_link_text'];
$bottom_box       = $email_template['bottom_box'];
$bottom_title     = $email_template['bottom_title'];
$bottom_text      = $email_template['bottom_text'];
$bottom_link      = $email_template['bottom_link'];
$bottom_link_text = $email_template['bottom_link_text'];
$social_link1     = $email_template['social_link1'];
$social_logo1     = IMAGE_FOLDER."email/".$email_template['social_logo1'];
$social_link2     = $email_template['social_link2'];
$social_logo2     = IMAGE_FOLDER."email/".$email_template['social_logo2'];
$social_link3     = $email_template['social_link3'];
$social_logo3     = IMAGE_FOLDER."email/".$email_template['social_logo3'];
$contact_text     = $email_template['contact_text'];
$address_1        = $sitesettings['site_address_1'];
$address_2        = $sitesettings['site_address_2'];
$phone            = $sitesettings['site_phone_1'];
$email            = $sitesettings['site_email'];

$e_body = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>$page_title</title>
<style>
body {
padding-top: 0 !important;
padding-bottom: 0 !important;
padding-top: 0 !important;
padding-bottom: 0 !important;
margin:0 !important;
width: 100% !important;
-webkit-text-size-adjust: 100% !important;
-ms-text-size-adjust: 100% !important;
-webkit-font-smoothing: antialiased !important;
}
.tableContent img {border: 0 !important;display: inline-block !important;outline: none !important;}
p, h1,h2,h3,ul,ol,li,div{margin:0;padding:0;}
h1,h2{font-weight: normal;background:transparent !important;border:none !important;}
td,table{vertical-align: top;}
td.middle{vertical-align: middle;}
a{text-decoration: none;}
a.link1{font-size: 16px;color: #a5a5a5;}
a.link2{font-size: 18px;font-weight: bold;color: #000000;text-decoration: underline;}
a.link3{
font-size: 15px;
font-weight: bold;
color: #ffffff;
background-color: #e28e42;
padding: 11px 15px;
text-decoration: none;
border-radius:5px;
-moz-border-radius:5px;
-webkit-border-radius:5px;
text-align: center;
display:inline-block;
}
.contentEditable li{ }
h1{font-size: 24px;font-weight: bold;color: #000000;line-height: 150%;}
h2{font-size: 18px;font-weight: bold;color: #000000;line-height: 150%;height:60px;}
p{font-size: 16px;color: #000000;line-height: 150%;text-align: left;}
.bgItem{background: #f3f3f3;}
.bgBody{background: #ffffff;}
</style>

</head>
<body paddingwidth="0" paddingheight="0" class='bgBody' style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent bgBody" align="center" style='font-family:Helvetica, sans-serif;'>

<tr>
<td align='center' class='movableContentContainer'>

<div class='movableContent'>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td height='20'></td></tr>
<tr>
<td width='400' align="left">
<div class="contentEditableContainer contentImageEditable">
<div class="contentEditable">
<img src="$logo" alt="$image_alts" width="100">
</div>
</div>
</td>
<td width='20'></td>
<td width='180' align="right" valign="bottom" style='vertical-align: bottom;'>
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
$phone_number
</div>
</div>
</td>
</tr>
</table>
</div>

<div class='movableContent'>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td height='20'></td></tr>
<tr>
<td>
<div class="contentEditableContainer contentImageEditable">
<div class="contentEditable">
<img src="$header_photo" alt="$image_alts" width='600' height='226' data-default="placeholder" data-max-width="600">
</div>
</div>
</td>
</tr>
<tr><td height='10' bgcolor="e28e42"></td></tr>
</table>
</div>

<div class='movableContent'>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td height='20'></td></tr>
<tr>
<td>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class='bgItem' style='border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;'>
<tr><td colspan="5" height='30'></td></tr>
<tr>
<td width='20'></td>
<td width='560'>
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<h2 style='font-size: 17px;'>$emailbodytitle</h2>
<br/>
$emailbodytext
<br/><br/>
</div>
</div>
</td>
<td width='20'></td>
</tr>
<tr><td colspan="5" height='30'></td></tr>
</table>
</td>
</tr>
</table>
</div>

<div class='movableContent'>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td height='20'></td></tr>
<tr>
<td>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td width='190' class='bgItem' style='border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;'>
<table width="190" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td colspan="3" height='20'></td></tr>
<tr>
<td width='20'></td>
<td width='150' align="center">
<div class="contentEditableContainer contentImageEditable">
<div class="contentEditable">
<img src="$box1_photo" alt="$image_alts" width='100' height='100' data-default="placeholder" data-max-width="150">
</div>
</div>
</td>
<td width='20'></td>
</tr>
<tr><td colspan="3" height='20'></td></tr>
<tr>
<td width='20'></td>
<td width='150' height='50'>
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<h2 style='text-align: left;'>$box1_title</h2>
</div>
</div>
</td>
<td width='10'></td>
</tr>
<tr><td colspan="3" height='20'></td></tr>
<tr>
<td width='20'></td>
<td width='150' height='120'>
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<p style='text-align: left;'>$box1_text</p>
</div>
</div>
</td>
<td width='20'></td>
</tr>
<tr><td colspan="3" height='20'></td></tr>
<tr>
<td width='20'></td>
<td width='150' >
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<p style='text-align: center;'><a target='_blank' href="$box1_link" class='link3' style='color:#ffffff;'>$box1_link_text</a></p>
</div>
</div>
</td>
<td width='20'></td>
</tr>
<tr><td colspan="3" height='20'></td></tr>
</table>
</td>
<td width='15'></td>
<td wisth='190' class='bgItem' style='border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;'>
<table width="190" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td colspan="3" height='20'></td></tr>
<tr>
<td width='20'></td>
<td width='150' align="center">
<div class="contentEditableContainer contentImageEditable">
<div class="contentEditable">
<img src="$box2_photo" alt="$image_alts" width='100' height='100' data-default="placeholder" data-max-width="150">
</div>
</div>
</td>
<td width='20'></td>
</tr>
<tr><td colspan="3" height='20'></td></tr>
<tr>
<td width='20'></td>
<td width='150' height='50'>
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<h2 style='text-align: left;'>$box2_title</h2>
</div>
</div>
</td>
<td width='20'></td>
</tr>
<tr><td colspan="3" height='20'></td></tr>
<tr>
<td width='20'></td>
<td width='150' height='120'>
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<p style='text-align: left;'>$box2_text</p>
</div>
</div>
</td>
<td width='20'></td>
</tr>
<tr><td colspan="3" height='20'></td></tr>
<tr>
<td width='20'></td>
<td width='150' >
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<p style='text-align: center;'><a target='_blank' href="$box2_link" class='link3' style='color:#ffffff;'>$box2_link_text</a></p>
</div>
</div>
</td>
<td width='20'></td>
</tr>
<tr><td colspan="3" height='20'></td></tr>
</table>
</td>
<td width='15'></td>
<td width='190' class='bgItem' style='border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;'>
<table width="190" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td colspan="3" height='20'></td></tr>
<tr>
<td width='20'></td>
<td width='150' align="center">
<div class="contentEditableContainer contentImageEditable">
<div class="contentEditable">
<img src="$box3_photo" alt="$image_alts" width='100' height='100' data-default="placeholder" data-max-width="150">
</div>
</div>
</td>
<td width='20'></td>
</tr>
<tr><td colspan="3" height='20'></td></tr>
<tr>
<td width='20'></td>
<td width='150' height='50'>
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<h2 style='text-align: left;'>$box3_title</h2>
</div>
</div>
</td>
<td width='20'></td>
</tr>
<tr><td colspan="3" height='20'></td></tr>
<tr>
<td width='20'></td>
<td width='150' height='120'>
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<p style='text-align: left;'>$box3_text</p>
</div>
</div>
</td>
<td width='20'></td>
</tr>
<tr><td colspan="3" height='20'></td></tr>
<tr>
<td width='20'></td>
<td width='150' >
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<p style='text-align: center;'><a target='_blank' href="$box3_link" class='link3' style='color:#ffffff;'>$box3_link_text</a></p>
</div>
</div>
</td>
<td width='20'></td>
</tr>
<tr><td colspan="3" height='20'></td></tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</div>

<div class='movableContent'>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td height='20'></td></tr>
<tr>
<td>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class='bgItem' style='border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;'>
<tr><td colspan="5" height='30'></td></tr>
<tr>
<td width='20'></td>
<td valign='middle' width='150' height='150' style="vertical-align:middle;background-color: #e28e42;">
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<p style="font-family: Georgia, serif; font-style: italic; font-size: 34px; color: #ffffff; line-height: 150%; margin: 15px; text-align: center;">
$bottom_box
</p>
</div>
</div>
</td>
<td width='15'></td>
<td width='395'>
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<h2>$bottom_title</h2>
<p>$bottom_text</p>
<br/>
<p style='text-align: right;'><a target='_blank' href="$bottom_link" class='link2' >$bottom_link_text</a></p>
</div>
</div>
</td>
<td width='20'></td>
</tr>
<tr><td colspan="5" height='30'></td></tr>
</table>
</td>
</tr>
</table>
</div>
<div class='movableContent'>
<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height='20'></td></tr></table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class='bgItem'>
<tr><td height='10' bgcolor="e28e42"></td></tr>
<tr>
<td>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td height='30'></td></tr>
<tr>
<td align='center'>
<table width="204" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td width='68' align="center">
<div class="contentEditableContainer contentFacebookEditable">
<div class="contentEditable">
<a href="$social_link1">
<img src="$social_logo1" alt="$image_alts" data-default="placeholder" width='50' height='50' data-max-width="50" data-customIcon="true">
</a>
</div>
</div>
</td>
<td width='68' align="center">
<div class="contentEditableContainer contentTwitterEditable">
<div class="contentEditable">
<a href="$social_link2">
<img src="$social_logo2" alt="$image_alts" data-default="placeholder" width='50' height='50' data-max-width="50" data-customIcon="true">
</a>
</div>
</div>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
<div class='movableContent'>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class='bgItem'>
<tr>
<td>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td height='20'></td></tr>
<tr>
<td align='center'>
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<p style='color:#a5a5a5;text-align:center;font-size:11px;line-height:19px;'>
<a target='_blank' href="#" style='color:#a5a5a5'>$contact_text</a>
<br><br>
$address_1<br>
$address_2<br>
$phone<br>
$email<br>
</p>
</div>
</div>
</td>
</tr>
<tr><td height='20'></td></tr>
</table>
</td>
</tr>
</table>
</div>
</td>
</tr>
</table>
</body>
</html>
EOF;

?>