<header class="main-header">

<a href="<?php echo SITE_URL."admin/index.php"; ?>" class="logo">
<span class="logo-mini"><i class="fa fa-bars" aria-hidden="true"></i></span>
<span class="logo-lg"><b>Yönetim</b></span>
</a>

<nav class="navbar navbar-static-top">

<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle</span></a>

<div class="navbar-custom-menu">
<ul class="nav navbar-nav">

<?php $_new_mess = $Db->query("SELECT message_id,message_name,message_surname FROM contact_messages WHERE message_seen = ? ", array('0')); ?>
<li class="dropdown notifications-menu">
<a href="" class="dropdown-toggle" data-toggle="dropdown" data-toggle="tooltip" data-placement="bottom" title="Mesaj"><i class="fa fa-envelope-o <?php if (count($_new_mess) > 0) { echo " blink"; } ?>" aria-hidden="true"></i><span class="label label-success"><?php echo count($_new_mess); ?></span></a>

<ul class="dropdown-menu">

<li class="header"><?php echo count($_new_mess); ?> yeni mesaj</li>
<li>
<ul class="menu">
<?php if (!empty($_new_mess)) { foreach ($_new_mess as $_new_m) { ?>
<li><a href="<?php echo SITE_URL."admin/messages/detail.php?message_id=".$_new_m['message_id']; ?>"><i class="fa fa-envelope-o text-aqua"></i> <?php echo $_new_m['message_name']." ".$_new_m['message_surname']; ?></a></li>
<?php } } ?>
</ul>
</li>

<li class="footer"><a href="<?php echo SITE_URL."admin/messages/index.php"; ?>">Tümünü Gör</a></li>
</ul>

</li>

<li class="dropdown user user-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="<?php echo IMAGE_FOLDER."admin/".$_SESSION['admin']['admin_image']; ?>" class="user-image">
<span class="hidden-xs"><?php echo $_SESSION['admin']['admin_name']." ".$_SESSION['admin']['admin_surname']; ?></span>
</a>

<ul class="dropdown-menu">

<li class="user-header">
<img src="<?php echo IMAGE_FOLDER."admin/".$_SESSION['admin']['admin_image']; ?>" class="img-circle">
<p><?php echo $_SESSION['admin']['admin_name']." ".$_SESSION['admin']['admin_surname']; ?><small><?php echo $_SESSION['admin']['admin_last_visit']." ".$_SESSION['admin']['admin_last_ip']; ?></small></p>
</li>

<li class="user-body">
<div class="row">
<div class="col-xs-12 text-center"></div>
</div>
</li>

<li class="user-footer">
<div class="pull-left">
<a href="<?php echo SITE_URL; ?>admin/admin/edit.php?admin_id=<?php echo $admin_id; ?>" class="btn btn-default btn-flat">Profil</a>
</div>
<div class="pull-right">
<a href="<?php echo SITE_URL; ?>admin/log_out.php" class="btn btn-default btn-flat">Çıkış</a>
</div>
</li>

</ul>

</li>

</ul>
</div>

</nav>
</header>