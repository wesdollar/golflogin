<div class="box">

	<h3><?php echo $GTM_LANG['Admin']['login']['heading_login']; ?></h3>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=Admin&amp;action=login" method="post" id="frmLoginAdmin" class="form">
		<input type="hidden" name="login_user" value="1" />
		<p><label class="title"><?php echo $GTM_LANG['Admin']['login']['login_username']; ?>:</label><input name="login_username" type="text" class="text_large" id="login_username" /></p>
		<p><label class="title"><?php echo $GTM_LANG['Admin']['login']['login_password']; ?>:</label><input name="login_password" type="password" class="text_large" id="login_password" /></p>
		<p><input type="submit" value="Login" /></p>
	</form>
	
</div>

<?php
if (isset($_GET['err']))
{
	switch ($_GET['err'])
	{
		case 1:
			?><p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['login_err'][1]; ?></p><?php
			break;
		case 2:
			?><p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['login_err'][2]; ?></p><?php
			break;
		case 3:
			?><p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['login_err'][3]; ?></p><?php
			break;
	}
}
?>