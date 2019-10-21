<?php
if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	require_once HELPERS_PATH . 'time.widget.php';
	?>
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminPlayers']['heading_add']; ?></h3>
	
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminPlayers&amp;action=create" method="post" id="frmCreatePlayers" class="form" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" name="user_create" value="1" />

			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['username']; ?></label><input type="text" name="username" id="username" class="w200 required" /></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['password']; ?></label><input type="text" name="password" id="password" class="w200" />&nbsp;<span><?php echo $GTM_LANG['AdminPlayers']['password_hint']; ?></span></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['email']; ?></label><input type="text" name="email" id="email" class="w200 required email" value="<?php echo @$_REQUEST['email']; ?>" /></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['name']; ?></label><input type="text" name="name" id="name" class="w200" value="<?php echo @$_REQUEST['name']; ?>" /></p>
			<p>
				<label class="title"><?php echo $GTM_LANG['AdminPlayers']['birth']; ?></label>
				<?php
				monthWidget(intval(@$_REQUEST['dob_month']), 'M.', 'dob_month', 'dob_month', 'w50', array('value' => '', 'title' => $GTM_LANG['_choose_1']));
				dayWidget(intval(@$_REQUEST['dob_day']), 'dob_day', 'dob_day', 'sw50', array('value' => '', 'title' => $GTM_LANG['_choose_1']));
				yearWidget(intval(@$_REQUEST['dob_year']), 100, 0, 'dob_year', 'dob_year', 'w100', array('value' => '', 'title' => $GTM_LANG['_choose_1']), true);
				?>
			</p>
			<p>
				<label class="title"><?php echo $GTM_LANG['AdminPlayers']['classification']; ?></label>
				<select name="classification" class="sw200">
					<option value=""><?php echo $GTM_LANG['_choose_1']; ?></option>
					<?php
					foreach ($GTM_LANG['classification'] as $key => $val) {
						?>
						<option value="<?php echo $key;?>" <?php echo @$_REQUEST['classification'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
					?>
				</select>
			</p>
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['town']; ?></label><input type="text" name="town" id="town" class="w200" value="<?php echo @$_REQUEST['town']; ?>" /></p>
			<p>
				<label class="title"><?php echo $GTM_LANG['AdminPlayers']['dexterity']; ?></label>
				<select name="dexterity" class="sw50">
					<option value=""><?php echo $GTM_LANG['_choose_1']; ?></option>
					<?php
					foreach ($GTM_LANG['dexterity'] as $key => $val) {
						?>
						<option value="<?php echo $key;?>" <?php echo @$_REQUEST['dexterity'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
					?>
				</select>
			</p>
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['phone']; ?></label><input type="text" name="phone" id="phone" class="w200" value="<?php echo @$_REQUEST['phone']; ?>"/></p>
			<p>
				<label class="title"><?php echo $GTM_LANG['AdminPlayers']['shirt_size']; ?></label>
				<select name="shirt_size" class="sw50">
					<option value=""><?php echo $GTM_LANG['_choose_1']; ?></option>
					<?php
					foreach($GTM_LANG['shirt_size'] as $key => $val) {
						?>
						<option value="<?php echo $key;?>" <?php echo @$_REQUEST['shirt_size'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
					?>
				</select>
			</p>
			<p>
				<label class="title"><?php echo $GTM_LANG['AdminPlayers']['pant_size']; ?></label>
				<input type="text" name="pant_size_waist" id="pant_size_waist" class="w50" value="<?php echo @$_REQUEST['pant_size_waist']; ?>"/>&nbsp;<?php echo $GTM_LANG['AdminPlayers']['pant_size_waist']; ?>&nbsp;
				<input type="text" name="pant_size_length" id="pant_size_length" class="w50" value="<?php echo @$_REQUEST['pant_size_length']; ?>"/>&nbsp;<?php echo $GTM_LANG['AdminPlayers']['pant_size_length']; ?>
			</p>
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['shoe_size']; ?></label><input type="text" name="shoe_size" id="shoe_size" class="w50" value="<?php echo @$_REQUEST['shoe_size']; ?>"/></p>
			<p>
				<label class="title"><?php echo $GTM_LANG['AdminPlayers']['glove_size']; ?></label>
				<select name="glove_size" class="sw50">
					<option value=""><?php echo $GTM_LANG['_choose_1']; ?></option>
					<?php
					foreach($GTM_LANG['glove_size'] as $key => $val) {
						?>
						<option value="<?php echo $key;?>" <?php echo @$_REQUEST['glove_size'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
					?>
				</select>
			</p>
			
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['profile_picture']; ?></label><input type="file" name="profile_picture" id="profile_picture" class="w200" size="30" /></p>
			
			<p>
				<label class="title">&nbsp;</label>
				<input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
			</p>
		</form>
	
	</div>
	<?php
}