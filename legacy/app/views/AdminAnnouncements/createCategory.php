<?php
require_once HELPERS_PATH . 'time.widget.php';

if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminAnnouncements']['heading_category_add']; ?></h3>
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminAnnouncements&amp;action=createCategory" method="post" id="frmCreateAnnouncementCategory" class="form" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" name="announcement_create_category" value="1" />

			<p><label class="title"><?php echo $GTM_LANG['AdminAnnouncements']['c_title']; ?></label><input type="text" name="ann_category_title" id="ann_category_title" class="w800 required" value="<?php echo @$_REQUEST['ann_category_title']; ?>" /></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminAnnouncements']['c_description']; ?></label><textarea rows="10" cols="10" name="ann_category_description" class="w800 mceEditor"><?php echo @$_REQUEST['ann_category_description']; ?></textarea></p>
						
			<p>
				<label class="title">&nbsp;</label>
				<input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
			</p>
		</form>
	
	</div>
	<?php
}