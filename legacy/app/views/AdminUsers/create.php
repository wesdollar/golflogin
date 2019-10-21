<?php
if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
    <p style="margin: 12px 0;">Add an admin or observer below. Admin users have rights to enter the team management dashboard. If your system is set to private, you can provide access privileges to someone to view your team's rankings and scorecards by adding them as an observer.</p>
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminPlayers']['heading_add']; ?></h3>
	
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&amp;action=create" method="post" id="frmCreateUser" class="form" autocomplete="off">
			<input type="hidden" name="user_create" value="1" />
			<p><label class="title"><?php echo $GTM_LANG['AdminUsers']['role']; ?></label>
				<select name="role_id" id="role_id" class="sw100 required">
					<?php
					foreach ($tpl['role_arr'] as $v)
					{
						?><option value="<?php echo $v['id']; ?>" <?php echo !empty($_REQUEST['role_id']) && $_REQUEST['role_id'] == $v['id'] ? 'selected="selected"' : null;?>><?php echo readFromDb($v['role']); ?></option><?php
					}
					?>
				</select>
			</p>
			<p><label class="title"><?php echo $GTM_LANG['AdminUsers']['username']; ?></label><input type="text" name="username" id="username" class="w200 required" value="<?php echo @$_REQUEST['username']; ?>" /></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminUsers']['password']; ?></label><input type="password" name="password" id="password" class="w200 required" value=""/></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminUsers']['name']; ?></label><input type="text" name="name" id="name" class="w200" value="<?php echo @$_REQUEST['name']; ?>"/></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminUsers']['email']; ?></label><input type="text" name="email" id="email" class="w200" value="<?php echo @$_REQUEST['email']; ?>" /></p>
			<p>
				<label class="title">&nbsp;</label>
				<input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
			</p>
		</form>
	
	</div>
	<?php
}