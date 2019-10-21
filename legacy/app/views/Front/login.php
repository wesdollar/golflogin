<div class="boxLoginB">
	<div class="boxLoginC">
		<h3><img src="<?= WEB_URL; ?>img/h3_login.gif" alt="" width="39" height="17" /></h3>
		<form id="frmLogin" name="frmLogin" method="post" action="Front/login/">
			<input type="hidden" name="login_user" value="1" />
		
			<p><label for="txtUsername"><?php echo $GTM_LANG['Front']['login']['username']; ?>:</label> <input name="login_username" id="login_username" type="text" /></p>
			<p><label for="txtPassword"><?php echo $GTM_LANG['Front']['login']['password']; ?>:</label> <input name="login_password" id="login_password" type="password" /></p>
			<p class="btnLogin"><input name="btnLogin" id="btnLogin" type="submit" value="" /></p>
		</form>
	</div>
</div>