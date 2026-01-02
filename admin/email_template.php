<?php $email_template = $Db->row("SELECT * FROM email_template"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $email_template['page_title']; ?></title>
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
<img src="<?php echo SITE_URL; ?>images/email/<?php echo $email_template['logo']; ?>" alt="<?php echo $email_template['image_alts']; ?>" width="100"/>
</div>
</div>
</td>
<td width='20'></td>
<td width='180' align="right" valign="bottom" style='vertical-align: bottom;'>
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<?php echo $email_template['phone_number']; ?>
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
<img src="<?php echo SITE_URL; ?>images/email/<?php echo $email_template['header_photo']; ?>" alt="<?php echo $email_template['image_alts']; ?>" width='600' height='226' data-default="placeholder" data-max-width="600" />
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
<h2 style='font-size: 17px;'>Yazı Başlığı</h2>
<br/>
<p>Mesaj içeriği</p>
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
<img src="<?php echo SITE_URL; ?>images/email/<?php echo $email_template['box1_photo']; ?>" alt="<?php echo $email_template['image_alts']; ?>" width='100' height='100' data-default="placeholder" data-max-width="150" />
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
<h2 style='text-align: left;'><?php echo $email_template['box1_title']; ?></h2>
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
<p style='text-align: left;'><?php echo $email_template['box1_text']; ?></p>
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
<p style='text-align: center;'><a target='_blank' href="<?php echo $email_template['box1_link']; ?>" class='link3' style='color:#ffffff;'><?php echo $email_template['box1_link_text']; ?></a></p>
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
<img src="<?php echo SITE_URL; ?>images/email/<?php echo $email_template['box2_photo']; ?>" alt="<?php echo $email_template['image_alts']; ?>" width='100' height='100' data-default="placeholder" data-max-width="150" />
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
<h2 style='text-align: left;'><?php echo $email_template['box2_title']; ?></h2>
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
<p style='text-align: left;'><?php echo $email_template['box2_text']; ?></p>
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
<p style='text-align: center;'><a target='_blank' href="<?php echo $email_template['box2_link']; ?>" class='link3' style='color:#ffffff;'><?php echo $email_template['box2_link_text']; ?></a></p>
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
<img src="<?php echo SITE_URL; ?>images/email/<?php echo $email_template['box3_photo']; ?>" alt="<?php echo $email_template['image_alts']; ?>" width='100' height='100' data-default="placeholder" data-max-width="150" />
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
<h2 style='text-align: left;'><?php echo $email_template['box3_title']; ?></h2>
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
<p style='text-align: left;'><?php echo $email_template['box3_text']; ?></p>
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
<p style='text-align: center;'><a target='_blank' href="<?php echo $email_template['box3_link']; ?>" class='link3' style='color:#ffffff;'><?php echo $email_template['box3_link_text']; ?></a></p>
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
<?php echo $email_template['bottom_box']; ?>
</p>
</div>
</div>
</td>
<td width='15'></td>
<td width='395'>
<div class="contentEditableContainer contentTextEditable">
<div class="contentEditable">
<h2><?php echo $email_template['bottom_title']; ?></h2>
<p><?php echo $email_template['bottom_text']; ?></p>
<br/>
<p style='text-align: right;'><a target='_blank' href="<?php echo $email_template['bottom_link']; ?>" class='link2' ><?php echo $email_template['bottom_link_text']; ?></a></p>
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
<a href="<?php echo $email_template['social_link1']; ?>">
<img src="<?php echo SITE_URL; ?>images/email/<?php echo $email_template['social_logo1']; ?>" alt="<?php echo $email_template['image_alts']; ?>" width='50' height='50' data-max-width="50" />
</a>
</div>
</div>
</td>
<td width='68' align="center">
<div class="contentEditableContainer contentTwitterEditable">
<div class="contentEditable">
<a href="<?php echo $email_template['social_link2']; ?>">
<img src="<?php echo SITE_URL; ?>images/email/<?php echo $email_template['social_logo2']; ?>" alt="<?php echo $email_template['image_alts']; ?>" width='50' height='50' data-max-width="50" />
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
<a target='_blank' href="<?php echo $email_template['bottom_link']; ?>" style='color:#a5a5a5'><?php echo $email_template['contact_text']; ?></a>
<br><br>
<?php echo $email_template['address_1']; ?> <br>
<?php echo $email_template['address_2']; ?> <br>
<?php echo $email_template['phone']; ?> <br>
<?php echo $email_template['email']; ?> <br>
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