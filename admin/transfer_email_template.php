<?php $booking_template = $Db->row("SELECT * FROM booking_template"); ?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $booking_template['page_title']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<style>
a,body,table,td{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0;mso-table-rspace:0}img{-ms-interpolation-mode:bicubic}img{border:0;height:auto;line-height:100%;outline:0;text-decoration:none}table{border-collapse:collapse!important}body{height:100%!important;margin:0!important;padding:0!important;width:100%!important}a[x-apple-data-detectors]{color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}@media screen and (max-width:480px){.mobile-hide{display:none!important}.mobile-center{text-align:center!important}}div[style*="margin: 16px 0;"]{margin:0!important}
</style>

<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">

<!--[if (gte mso 9)|(IE)]>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
<tr>
<td align="center" valign="top" width="600">
<![endif]-->

<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
<tr>
<td align="center" valign="top" style="font-size:0; padding: 35px;" bgcolor="#044767">
<!--[if (gte mso 9)|(IE)]>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
<tr>
<td align="left" valign="top" width="300">
<![endif]-->
<div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
<tr>
<td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
<img src="<?php echo IMAGE_FOLDER."email_booking/".$booking_template['logo']; ?>" alt="<?php echo $booking_template['image_alts']; ?>">
</td>
</tr>
</table>
</div>
<!--[if (gte mso 9)|(IE)]>
</td>
<td align="right" width="300">
<![endif]-->
<div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">
<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
<tr>
<td align="right" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
<table cellspacing="0" cellpadding="0" border="0" align="right">
<tr>
<td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400;">
<p style="font-size: 18px; font-weight: 400; margin: 0; color: #ffffff;"><a href="http://litmus.com" target="_blank" style="color: #ffffff; text-decoration: none;"><?php echo $booking_template['phone_number']; ?></a></p>
</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
<!--[if (gte mso 9)|(IE)]>
</td>
</tr>
</table>
<![endif]-->
</td>
</tr>
<tr>
<td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
<!--[if (gte mso 9)|(IE)]>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
<tr>
<td align="center" valign="top" width="600">
<![endif]-->
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
<tr>
<td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
<img src="<?php echo IMAGE_FOLDER."email_booking/".$booking_template['header_photo']; ?>" style="display: block; border: 0px;" alt="<?php echo $booking_template['image_alts']; ?>"/><br>
<h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
<?php echo $booking_template['info_title']; ?>
</h2>
</td>
</tr>
<tr>
<td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
<p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
<?php echo $booking_template['info_text']; ?>
</p>
</td>
</tr>
<tr>
<td align="left" style="padding-top: 20px;">
<table cellspacing="0" cellpadding="0" border="0" width="100%">
</table>
</td>
</tr>
</table>
<!--[if (gte mso 9)|(IE)]>
</td>
</tr>
</table>
<![endif]-->
</td>
</tr>
<tr>
<td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
<!--[if (gte mso 9)|(IE)]>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
<tr>
<td align="center" valign="top" width="600">
<![endif]-->
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
<tr>
<td align="center" valign="top" style="font-size:0;">
<!--[if (gte mso 9)|(IE)]>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
<tr>
<![endif]-->
<!--[if (gte mso 9)|(IE)]>
</tr>
</table>
<![endif]-->
</td>
</tr>
</table>
<!--[if (gte mso 9)|(IE)]>
</td>
</tr>
</table>
<![endif]-->
</td>
</tr>
<tr>
<td align="center" style=" padding: 35px; background-color: #1b9ba3;" bgcolor="#1b9ba3">
<!--[if (gte mso 9)|(IE)]>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
<tr>
<td align="center" valign="top" width="600">
<![endif]-->
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
<tr>
<td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
<h2 style="font-size: 24px; font-weight: 800; line-height: 30px; color: #ffffff; margin: 0;">
<?php echo $booking_template['middle_text']; ?>
</h2>
</td>
</tr>
<tr>
<td align="center" style="padding: 25px 0 15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="border-radius: 5px;" bgcolor="#66b3b7">
<a href="<?php echo $booking_template['middle_url']; ?>" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #66b3b7; padding: 15px 30px; border: 1px solid #66b3b7; display: block;"><?php echo $booking_template['middle_button']; ?></a>
</td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if (gte mso 9)|(IE)]>
</td>
</tr>
</table>
<![endif]-->
</td>
</tr>
<tr>
<td align="center" style="padding: 35px; background-color: #ffffff;" bgcolor="#ffffff">
<!--[if (gte mso 9)|(IE)]>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
<tr>
<td align="center" valign="top" width="600">
<![endif]-->
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
<tr>
<td align="center" style="padding-bottom: 25px;">
<img src="<?php echo IMAGE_FOLDER."email_booking/".$booking_template['logo']; ?>" style="display: block; border: 0px;" alt="<?php echo $booking_template['logo']; ?>"/>
</td>
</tr>
<tr>
<td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;">
<p style="font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;"><?php echo $booking_template['address_1']; ?><br><?php echo $booking_template['address_2']; ?><br><?php echo $booking_template['phone']; ?><br><?php echo $booking_template['email']; ?></p>
</td>
</tr>
<tr>
<td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
<p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;text-align: center;"><?php echo $booking_template['contact_text']; ?></p>
</td>
</tr>
</table>
<!--[if (gte mso 9)|(IE)]>
</td>
</tr>
</table>
<![endif]-->
</td>
</tr>
</table>

<!--[if (gte mso 9)|(IE)]>
</td>
</tr>
</table>
<![endif]-->

</td>
</tr>
</table>

</body>
</html>