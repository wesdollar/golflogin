<?php
if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminNews']['heading_add']; ?></h3>
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminNews&amp;action=create" method="post" id="frmCreateNews" class="form" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" name="news_create" value="1" />

			<p><label class="title"><?php echo $GTM_LANG['AdminNews']['title']; ?></label><input type="text" name="news_title" id="news_title" class="w800 required" value="<?php echo @$_REQUEST['news_title']; ?>" /></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminNews']['body']; ?></label><textarea rows="10" cols="10" name="news_body" class="mceEditor"><?php echo @$_REQUEST['news_body']; ?></textarea></p>
						
			<p><label class="title"><?php echo $GTM_LANG['AdminNews']['image']; ?></label><input type="file" name="image" id="image" class="w200" size="30" /></p>
			
			<p>
				<label class="title">&nbsp;</label>
				<input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
			</p>
		</form>
	
	</div>
	<?php
}