<?php
if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminPlayers']['heading_edit']; ?></h3>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&amp;action=update&amp;id=<?php echo $tpl['arr']['id']; ?>" method="post" id="frmUpdateUser" class="form">
			<input type="hidden" name="user_update" value="1" />
			<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
			<p><label class="title"><?php echo $GTM_LANG['AdminUsers']['role']; ?></label>
				<select name="role_id" id="role_id" class="sw100 required">
				<?php
				foreach ($tpl['role_arr'] as $v)
				{
					if ($tpl['arr']['role_id'] == $v['id'])
					{
						?><option value="<?php echo $v['id']; ?>" selected="selected"><?php echo stripslashes($v['role']); ?></option><?php
					} else {
						?><option value="<?php echo $v['id']; ?>"><?php echo stripslashes($v['role']); ?></option><?php
					}
				}
				?>
				</select>
			</p>
			<p><label class="title"><?php echo $GTM_LANG['AdminUsers']['username']; ?></label><?php echo readFromDb($tpl['arr']['username']); ?></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminUsers']['password']; ?></label><input type="password" name="password" id="password" value="password" class="w200 required" /></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminUsers']['name']; ?></label><input type="text" name="name" id="name" class="w200" value="<?php echo readFromDb($tpl['arr']['name']); ?>" /></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminUsers']['email']; ?></label><input type="text" name="email" id="email" class="w200" value="<?php echo readFromDb($tpl['arr']['email']); ?>" /></p>
			<p>
				<label class="title">&nbsp;</label>
				<input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
			</p>
		</form>

	</div>
	<?php
}
?>