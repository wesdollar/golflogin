<?php
if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminAnnouncements']['heading_category_edit']; ?></h3>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminAnnouncements&amp;action=updateCategory&amp;id=<?php echo $tpl['arr']['id']; ?>" method="post" id="frmUpdateAnnouncementCategory" class="form"  enctype="multipart/form-data">
			<input type="hidden" name="announcement_update_category" value="1" />
			<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
			
			<p><label class="title"><?php echo $GTM_LANG['AdminAnnouncements']['c_title']; ?></label><input type="text" name="ann_category_title" id="ann_category_title" class="w800 required" value="<?php echo $tpl['arr']['ann_category_title']; ?>" /></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminAnnouncements']['c_description']; ?></label><textarea rows="10" cols="10" name="ann_category_description" class="w800 mceEditor"><?php echo $tpl['arr']['ann_category_description']; ?></textarea></p>
				
			<p>
				<label class="title">&nbsp;</label>
				<input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
			</p>
		</form>

	</div>
	<?php
}
?>