<?php
if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
	<div class="box">
		<h3><?php echo $GTM_LANG['u_update']; ?></h3>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminNews&amp;action=update&amp;id=<?php echo $tpl['news']['id']; ?>" method="post" id="frmUpdateNews" class="form" enctype="multipart/form-data">
			<input type="hidden" name="news_update" value="1" />
			<input type="hidden" name="id" value="<?php echo $tpl['news']['id']; ?>" />
			
			<p><label class="title"><?php echo $GTM_LANG['AdminNews']['title']; ?></label><input type="text" name="news_title" id="news_title" class="w800 required" value="<?php echo $tpl['news']['news_title']; ?>" /></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminNews']['body']; ?></label><textarea rows="10" cols="10" name="news_body" class="mceEditor"><?php echo $tpl['news']['news_body']; ?></textarea></p>
						
			<?php
			if (!empty($tpl['news']['news_image']) && is_file(NEWS_IMAGE_PATH . $tpl['news']['news_image'])) {
				?>
				<p>
					<label class="title"><?php echo $GTM_LANG['AdminNews']['image']; ?></label>
					<span class="profile-image-wrapper">
						<img alt="<?php echo $tpl['news']['news_image']; ?>" src="<?= WEB_URL; ?>uploads/news/_thumbs/<?php echo $tpl['news']['news_image']; ?>" />
						<a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminNews&amp;action=deleteImage&amp;id=<?php echo intval($tpl['news']['id']); ?>" onclick="return confirm('Are you chure that you want to delete the image?');">&nbsp;</a>
						<div class="clear"></div>
					</span>
				</p>
				<?php
			} else {
				?>
				<p><label class="title"><?php echo $GTM_LANG['AdminNews']['image']; ?></label><input type="file" name="image" id="image" class="w200" size="30" /></p>
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