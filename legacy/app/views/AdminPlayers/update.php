<?php
if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	require_once HELPERS_PATH . 'time.widget.php';
	
	?>
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminPlayers']['heading_edit']; ?></h3>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminPlayers&amp;action=update&amp;id=<?php echo $tpl['arr']['id']; ?>" method="post" id="frmUpdateUser" class="form"  enctype="multipart/form-data">
			<input type="hidden" name="user_update" value="1" />
			<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
			
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['username']; ?></label><?php echo readFromDb($tpl['arr']['username']); ?></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['password']; ?></label><input type="password" name="password" id="password" value="password" class="w200 required" /></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['name']; ?></label><input type="text" name="name" id="name" class="w200" value="<?php echo readFromDb($tpl['arr']['name']); ?>" /></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['email']; ?></label><input type="text" name="email" id="email" class="w200 email" value="<?php echo readFromDb($tpl['arr']['email']); ?>" /></p>
			
			<p>
				<label class="title"><?php echo $GTM_LANG['AdminPlayers']['birth']; ?></label>
				<?php
				monthWidget(intval(@$tpl['arr']['dob_month']), 'M.', 'dob_month', 'dob_month', 'w50', array('value' => '', 'title' => $GTM_LANG['_choose_1']));
				dayWidget(intval(@$tpl['arr']['dob_day']), 'dob_day', 'dob_day', 'sw50', array('value' => '', 'title' => $GTM_LANG['_choose_1']));
				yearWidget(intval(@$tpl['arr']['dob_year']), 100, 0, 'dob_year', 'dob_year', 'w100', array('value' => '', 'title' => $GTM_LANG['_choose_1']), true);
				?>
			</p>
			<p>
				<label class="title"><?php echo $GTM_LANG['AdminPlayers']['classification']; ?></label>
				<select name="classification" class="sw200">
					<option value=""><?php echo $GTM_LANG['_choose_1']; ?></option>
					<?php
					foreach ($GTM_LANG['classification'] as $key => $val) {
						?>
						<option value="<?php echo $key;?>" <?php echo $tpl['arr']['classification'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
					?>
				</select>
			</p>
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['town']; ?></label><input type="text" name="town" id="town" class="w200" value="<?php echo readFromDb($tpl['arr']['town']); ?>" /></p>
			<p>
				<label class="title"><?php echo $GTM_LANG['AdminPlayers']['dexterity']; ?></label>
				<select name="dexterity" class="sw50">
					<option value=""><?php echo $GTM_LANG['_choose_1']; ?></option>
					<?php
					foreach ($GTM_LANG['dexterity'] as $key => $val) {
						?>
						<option value="<?php echo $key;?>" <?php echo $tpl['arr']['dexterity'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
					?>
				</select>
			</p>
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['phone']; ?></label><input type="text" name="phone" id="phone" class="w200" value="<?php echo readFromDb($tpl['arr']['phone']); ?>"/></p>
			<p>
				<label class="title"><?php echo $GTM_LANG['AdminPlayers']['shirt_size']; ?></label>
				<select name="shirt_size" class="sw50">
					<option value=""><?php echo $GTM_LANG['_choose_1']; ?></option>
					<?php
					foreach($GTM_LANG['shirt_size'] as $key => $val) {
						?>
						<option value="<?php echo $key;?>" <?php echo $tpl['arr']['shirt_size'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
					?>
				</select>
			</p>
			<p>
				<label class="title"><?php echo $GTM_LANG['AdminPlayers']['pant_size']; ?></label>
				<input type="text" name="pant_size_waist" id="pant_size_waist" class="w50" value="<?php echo readFromDb($tpl['arr']['pant_size_waist']); ?>"/>&nbsp;<?php echo $GTM_LANG['AdminPlayers']['pant_size_waist']; ?>&nbsp;
				<input type="text" name="pant_size_length" id="pant_size_length" class="w50" value="<?php echo readFromDb($tpl['arr']['pant_size_length']); ?>"/>&nbsp;<?php echo $GTM_LANG['AdminPlayers']['pant_size_length']; ?>
			</p>
			<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['shoe_size']; ?></label><input type="text" name="shoe_size" id="shoe_size" class="w50" value="<?php echo readFromDb($tpl['arr']['shoe_size']); ?>"/></p>
			<p>
				<label class="title"><?php echo $GTM_LANG['AdminPlayers']['glove_size']; ?></label>
				<select name="glove_size" class="sw50">
					<option value=""><?php echo $GTM_LANG['_choose_1']; ?></option>
					<?php
					foreach($GTM_LANG['glove_size'] as $key => $val) {
						?>
						<option value="<?php echo $key;?>" <?php echo $tpl['arr']['glove_size'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
					?>
				</select>
			</p>
			
			<?php
			if (!empty($tpl['arr']['image']) && is_file(PROFILE_IMAGES_PATH . $tpl['arr']['image'])) {
				?>
				<p>
					<label class="title"><?php echo $GTM_LANG['AdminPlayers']['profile_picture']; ?></label>
					<span class="profile-image-wrapper">
						<img alt="<?php echo $tpl['arr']['name']; ?>" src="<?= WEB_URL; ?>uploads/profile/<?php echo $tpl['arr']['image']; ?>" />
						<a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminPlayers&amp;action=deleteImage&amp;id=<?php echo intval($tpl['arr']['id']); ?>" onclick="return confirm('Are you chure that you want to delete the profile image?');">&nbsp;</a>
						<div class="clear"></div>
					</span>
				</p>
				<?php
			} else {
				?>
				<p><label class="title"><?php echo $GTM_LANG['AdminPlayers']['profile_picture']; ?></label><input type="file" name="profile_picture" id="profile_picture" class="w200" size="30" /></p>
				<?php	
			}
			?>
			
			<p>
				<label class="title">&nbsp;</label>
				<input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
			</p>
		</form>

	</div>
	<?php
}
?>