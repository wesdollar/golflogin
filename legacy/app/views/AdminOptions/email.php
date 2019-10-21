<?php
error_reporting(0);

if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminOptions']['heading_emails']; ?></h3>
	
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminOptions&amp;action=update" method="post" id="frmUpdateOptions" class="form" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" name="options_update" value="1" />
			<input type="hidden" name="refferer" value="email" />

			<p>
				<label class="title-wide"><?php echo $GTM_LANG['AdminOptions']['email_user_added_subject']; ?></label>
				<input type="text" name="email_user_added_subject" value="<?php echo $tpl['options']['email_user_added_subject']; ?>" class="w414" />
			</p>
			
			<p>
				<label class="title-wide"><?php echo $GTM_LANG['AdminOptions']['email_user_added_body']; ?></label>
				<textarea rows="10" cols="10" name="email_user_added_body" class="w800"><?php echo $tpl['options']['email_user_added_body']; ?></textarea>
			</p>
			
			<p>
				<span style="margin: 0 0 0 260px; float: left; clear: both;"><?php echo $GTM_LANG['AdminOptions']['email_user_added_tokens']; ?></span>
			</p>
			
			<p>
				<label class="title-wide"><?php echo $GTM_LANG['AdminOptions']['email_new_round_added_subject']; ?></label>
				<input type="text" name="email_new_round_added_subject" value="<?php echo $tpl['options']['email_new_round_added_subject']; ?>" class="w414" />
			</p>
			
			<p>
				<label class="title-wide"><?php echo $GTM_LANG['AdminOptions']['email_new_round_added_body']; ?></label>
				<textarea rows="10" cols="10" name="email_new_round_added_body" class="w800"><?php echo $tpl['options']['email_new_round_added_body']; ?></textarea>
			</p>
			
			<p>
				<span style="margin: 0 0 0 260px; float: left; clear: both;"><?php echo $GTM_LANG['AdminOptions']['email_new_round_added_tokens']; ?></span>
			</p>
			
			<p>
				<label class="title-wide"><?php echo $GTM_LANG['AdminOptions']['email_new_announcement_subject']; ?></label>
				<input type="text" name="email_new_annoucement_subject" value="<?php echo $tpl['options']['email_new_annoucement_subject']; ?>" class="w414" />
			</p>
			
			<p>
				<label class="title-wide"><?php echo $GTM_LANG['AdminOptions']['email_new_announcement_body']; ?></label>
				<textarea rows="10" cols="10" name="email_new_annoucement_body" class="w800"><?php echo $tpl['options']['email_new_annoucement_body']; ?></textarea>
			</p>
			
			<p>
				<span style="margin: 0 0 0 260px; float: left; clear: both;"><?php echo $GTM_LANG['AdminOptions']['email_new_announcement_tokens']; ?></span>
			</p>
			
			<p>
				<label class="title-wide">&nbsp;</label>
				<input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
			</p>
		</form>
	</div>
	<?php
}