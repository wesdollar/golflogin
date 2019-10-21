<?php
require_once HELPERS_PATH . 'time.widget.php';
?>
<div class="contAddB">
	<div class="contAddC">
		<h3><img src="<?= WEB_URL; ?>img/h3_profile.gif" alt="Profile" /></h3>
		
		<form id="frmUpdateProfile" name="frmUpdateProfile" class="frm frmSave contMessage" method="post" action="Front/profile/" enctype="multipart/form-data">
			<input type="hidden" name="profile_update" value="1" />
		
			<p>
				<label for="username"><?php echo $GTM_LANG['Front']['profile']['username']; ?>:</label>
				<span id="username" style="line-height: 32px;"><?php echo readFromDb($tpl['user']['username']); ?></span>
			</p>

			<p>
				<label for="password"><?php echo $GTM_LANG['Front']['profile']['password']; ?>:</label>
				<input type="password" name="password" id="password" value="password" class="iw300 required" />
			</p>
		
			<p>
				<label for="name"><?php echo $GTM_LANG['Front']['profile']['name']; ?>:</label>
				<input type="text" name="name" id="name" value="<?php echo readFromDb($tpl['user']['name']); ?>" class="iw300 required" />
			</p>
			
			<p>
				<label for="email"><?php echo $GTM_LANG['Front']['profile']['email']; ?>:</label>
				<input type="text" name="email" id="email" value="<?php echo readFromDb($tpl['user']['email']); ?>" class="iw300 email" />
			</p>
			
			<p>
				<label for="name"><?php echo $GTM_LANG['Front']['profile']['birth']; ?>:</label>
				<?php
				monthWidget(intval($tpl['user']['dob_month']), 'M.', 'dob_month', 'dob_month', 'sw64 marR6', array('value' => '', 'title' => $GTM_LANG['_choose_1']));
				dayWidget(intval($tpl['user']['dob_day']), 'dob_day', 'dob_day', 'sw64 marR6', array('value' => '', 'title' => $GTM_LANG['_choose_1']));
				yearWidget(intval($tpl['user']['dob_year']), 100, 0, 'dob_year', 'dob_year', 'sw100 marR6', array('value' => '', 'title' => $GTM_LANG['_choose_1']), true);
				?>
			</p>
			
			<p>
				<label for="classification"><?php echo $GTM_LANG['Front']['profile']['classification']; ?>:</label>
				<select name="classification" id="classification" class="sw300">
					<option value=""><?php echo $GTM_LANG['_choose_1']; ?></option>
					<?php
					foreach ($GTM_LANG['classification'] as $key => $val) {
						?>
						<option value="<?php echo $key;?>" <?php echo $tpl['user']['classification'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
					?>
				</select>
			</p>
			
			<p>
				<label for="town"><?php echo $GTM_LANG['Front']['profile']['town']; ?>:</label>
				<input type="text" name="town" id="town" class="iw300" value="<?php echo $tpl['user']['town']; ?>" />
			</p>
			
			<p>
				<label for="dexterity"><?php echo $GTM_LANG['Front']['profile']['dexterity']; ?>:</label>
				<select name="dexterity" id="dexterity" class="sw64">
					<option value=""><?php echo $GTM_LANG['_choose_1']; ?></option>
					<?php
					foreach ($GTM_LANG['dexterity'] as $key => $val) {
						?>
						<option value="<?php echo $key;?>" <?php echo $tpl['user']['dexterity'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
					?>
				</select>
			</p>
			
			<p>
				<label for="phone"><?php echo $GTM_LANG['Front']['profile']['phone']; ?>:</label>
				<input type="text" name="phone" id="phone" class="iw300" value="<?php echo $tpl['user']['phone']; ?>"/>
			</p>
			
			<p>
				<label for="shirt_size"><?php echo $GTM_LANG['Front']['profile']['shirt_size']; ?>:</label>
				<select name="shirt_size" id="shirt_size" class="sw64">
					<option value=""><?php echo $GTM_LANG['_choose_1']; ?></option>
					<?php
					foreach($GTM_LANG['shirt_size'] as $key => $val) {
						?>
						<option value="<?php echo $key;?>" <?php echo $tpl['user']['shirt_size'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
					?>
				</select>
			</p>
			
			<p>
				<label><?php echo $GTM_LANG['Front']['profile']['pant_size']; ?>:</label>
				<span><input type="text" name="pant_size_waist" id="pant_size_waist" class="iw64" value="<?php echo $tpl['user']['pant_size_waist']; ?>"/>&nbsp;<span style="margin: 0 6px 0 6px;"><?php echo $GTM_LANG['Front']['profile']['pant_size_waist']; ?></span></span>&nbsp;
				<span><input type="text" name="pant_size_length" id="pant_size_length" class="iw64" value="<?php echo $tpl['user']['pant_size_length']; ?>"/>&nbsp;<span style="margin: 0 6px 0 6px;"><?php echo $GTM_LANG['Front']['profile']['pant_size_length']; ?></span></span>
			</p>
			
			<p>
				<label for="shoe_size"><?php echo $GTM_LANG['Front']['profile']['shoe_size']; ?>:</label>
				<input type="text" name="shoe_size" id="shoe_size" class="iw64" value="<?php echo $tpl['user']['shoe_size']; ?>"/>
			</p>
			
			<p>
				<label for="glove_size"><?php echo $GTM_LANG['Front']['profile']['glove_size']; ?>:</label>
				<select name="glove_size" id="glove_size" class="sw64">
					<option value=""><?php echo $GTM_LANG['_choose_1']; ?></option>
					<?php
					foreach($GTM_LANG['glove_size'] as $key => $val) {
						?>
						<option value="<?php echo $key;?>" <?php echo $tpl['user']['glove_size'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
					?>
				</select>
			</p>
			
			<?php
			if (!empty($tpl['user']['image']) && is_file(PROFILE_IMAGES_PATH . $tpl['user']['image'])) {
				?>
				<p>
					<label class="title"><?php echo $GTM_LANG['Front']['profile']['profile_picture']; ?></label>
					<span class="profile-image-wrapper">
						<img alt="<?php echo htmlspecialchars($tpl['user']['name']); ?>" src="<?= SCHOOL_URL; ?>uploads/profile/<?php echo $tpl['user']['image']; ?>" />
						<a href="Front/deleteProfileImage/<?php echo intval($tpl['user']['id']); ?>" onclick="return confirm('Are you chure that you want to delete the profile image?');">&nbsp;</a>
					</span>
				</p>
				<?php
			} else {
				?>
				<p><label class="title"><?php echo $GTM_LANG['Front']['profile']['profile_picture']; ?></label><input type="file" name="profile_picture" id="profile_picture" class="iw300" size="30" /></p>
				<?php	
			}
			?>
			
			<p class="btnSave"><input name="txtPost" id="txtPost" type="submit" value="" /></p>
		</form>
	</div>
</div>
