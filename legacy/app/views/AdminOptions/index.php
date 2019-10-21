<?php
error_reporting(0);

if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminOptions']['heading_general']; ?></h3>
	
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminOptions&amp;action=update" method="post" id="frmUpdateOptions" class="form" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" name="options_update" value="1" />
			<input type="hidden" name="refferer" value="index" />

			<p>
				<label class="title-wide"><?php echo $GTM_LANG['AdminOptions']['system_email']; ?></label>
				<input type="text" name="system_email" value="<?php echo $tpl['options']['system_email']; ?>" class="w414" />
			</p>

			<p>
				<label class="title-wide"><?php echo $GTM_LANG['AdminOptions']['required_front_login']; ?></label>
				<select name="required_front_login" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['required_front_login'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-wide"><?php echo $GTM_LANG['AdminOptions']['new_round_admin_notify']; ?></label>
				<select name="new_round_admin_notify" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['new_round_admin_notify'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-wide"><?php echo $GTM_LANG['AdminOptions']['new_round_player_notify']; ?></label>
				<select name="new_round_player_notify" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['new_round_player_notify'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-wide">&nbsp;</label>
				<input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
			</p>
		</form>
	</div>
	<?php
}