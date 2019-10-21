<?php
if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminAnnouncements']['heading_edit']; ?></h3>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminAnnouncements&amp;action=update&amp;id=<?php echo $tpl['announcement']['id']; ?>" method="post" id="frmUpdateAnnouncement" class="form" enctype="multipart/form-data">
			<input type="hidden" name="announcement_update" value="1" />
			<input type="hidden" name="id" value="<?php echo $tpl['announcement']['id']; ?>" />
			
			<?php
			if ($tpl['ann_categories']) { 
				?>
				<p>
					<label class="title"><?php echo $GTM_LANG['AdminAnnouncements']['category']; ?></label>
					<select name="ann_category_id" class="sw300 required">
						<option value=""><?php echo $GTM_LANG['_choose_1']; ?></option>
						<?php
						foreach ($tpl['ann_categories'] as $key => $val) {
							?>
							<option value="<?php echo $val['id'];?>" <?php echo $tpl['announcement']['ann_category_id'] == $val['id'] ? 'selected="selected"' : null; ?>><?php echo $val['ann_category_title']; ?></option>
							<?php
						}
						?>
					</select>
				</p>
				<?php
			}
			?>

			<p><label class="title"><?php echo $GTM_LANG['AdminAnnouncements']['title']; ?></label><input type="text" name="ann_title" id="ann_title" class="w800 required" value="<?php echo $tpl['announcement']['ann_title']; ?>" /></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminAnnouncements']['body']; ?></label><textarea rows="10" cols="10" name="ann_body" class="mceEditor"><?php echo $tpl['announcement']['ann_body']; ?></textarea></p>
						
			<?php
			if (!empty($tpl['announcement']['ann_image']) && is_file(ANNOUNCEMENTS_IMAGE_PATH . $tpl['announcement']['ann_image'])) {
				?>
				<p>
					<label class="title"><?php echo $GTM_LANG['AdminAnnouncements']['image']; ?></label>
					<span class="profile-image-wrapper">
						<img alt="<?php echo $tpl['announcement']['ann_image']; ?>" src="<?= WEB_URL; ?>uploads/announcements/_thumbs/<?php echo $tpl['announcement']['ann_image']; ?>" />
						<a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminAnnouncements&amp;action=deleteImage&amp;id=<?php echo intval($tpl['announcement']['id']); ?>" onclick="return confirm('Are you chure that you want to delete the image?');">&nbsp;</a>
						<div class="clear"></div>
					</span>
				</p>
				<?php
			} else {
				?>
				<p><label class="title"><?php echo $GTM_LANG['AdminAnnouncements']['image']; ?></label><input type="file" name="image" id="image" class="w200" size="30" /></p>
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