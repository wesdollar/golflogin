<?php
require_once HELPERS_PATH . 'time.widget.php';

if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminAnnouncements']['heading_add']; ?></h3>
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminAnnouncements&amp;action=create" method="post" id="frmCreateAnnouncements" class="form" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" name="announcement_create" value="1" />

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
							<option value="<?php echo $val['id'];?>" <?php echo @$_REQUEST['ann_category_id'] == $val['id'] ? 'selected="selected"' : null; ?>><?php echo $val['ann_category_title']; ?></option>
							<?php
						}
						?>
					</select>
				</p>
				<?php
			}
			?>

			<p><label class="title"><?php echo $GTM_LANG['AdminAnnouncements']['title']; ?></label><input type="text" name="ann_title" id="ann_title" class="w800 required" value="<?php echo @$_REQUEST['ann_title']; ?>" /></p>
			<p><label class="title"><?php echo $GTM_LANG['AdminAnnouncements']['body']; ?></label><textarea rows="10" cols="10" name="ann_body" class="mceEditor"><?php echo @$_REQUEST['ann_body']; ?></textarea></p>
						
			<p><label class="title"><?php echo $GTM_LANG['AdminAnnouncements']['image']; ?></label><input type="file" name="image" id="image" class="w200" size="30" /></p>
			
			<p><label class="title"><?php echo $GTM_LANG['AdminAnnouncements']['send_to_players_label']; ?></label><label style="float: left; padding: 4px 10px 0 0;"><input type="checkbox" name=send_to_players id="send_to_players" value="1" /> <?php echo $GTM_LANG['AdminAnnouncements']['send_to_players']; ?></label></p>
			
			<p>
				<label class="title">&nbsp;</label>
				<input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
			</p>
		</form>
	
	</div>
	<?php
}