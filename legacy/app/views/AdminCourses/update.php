<?php
if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	if (!empty($tpl['course']) && !empty($tpl['course_holes'])) {
		?>
		<div class="box">
			<h3><?php echo $GTM_LANG['AdminCourses']['heading_edit_general']; ?></h3>
	
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminCourses&amp;action=update&amp;id=<?php echo $tpl['news']['id']; ?>" method="post" id="frmUpdateNews" class="form" enctype="multipart/form-data">
				<input type="hidden" name="general_update" value="1" />
				<input type="hidden" name="id" value="<?php echo $tpl['course']['id']; ?>" />
				
				<p>
					<label class="title"><?php echo $GTM_LANG['AdminCourses']['course_title']; ?></label>
					<input type="text" name="course_title" id="course_title" class="w400 required" value="<?php echo $tpl['course']['course_title']; ?>" />
				</p>
				
				<p>
					<label class="title"><?php echo $GTM_LANG['AdminCourses']['tee_box']; ?></label>
					<input type="text" name="tee_box" id="tee_box" class="w400 required" value="<?php echo $tpl['course']['tee_box']; ?>" />
				</p>
				
				<p>
					<label class="title"><?php echo $GTM_LANG['AdminCourses']['usga_rating']; ?></label>
					<input type="text" name="usga_rating" id="usga_rating" class="w100 required" value="<?php echo $tpl['course']['usga_rating']; ?>" />
				</p>
				
				<p>
					<label class="title"><?php echo $GTM_LANG['AdminCourses']['slop_rating']; ?></label>
					<input type="text" name="slop_rating" id="slop_rating" class="w100 required" value="<?php echo $tpl['course']['slop_rating']; ?>" />
				</p>
							
				<p>
					<label class="title">&nbsp;</label>
					<input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
				</p>
			</form>
		</div>
		
		<br/>
		
		<div class="box">
			<h3><?php echo $GTM_LANG['AdminCourses']['heading_edit_holes']; ?></h3>
	
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminCourses&amp;action=update&amp;id=<?php echo $tpl['course']['id']; ?>" method="post" id="frmUpdateNews" class="form" enctype="multipart/form-data">
				<input type="hidden" name="holes_update" value="1" />
				<input type="hidden" name="id" value="<?php echo $tpl['course']['id']; ?>" />
				
				<table cellpadding="0" cellspacing="0" class="corse-hole-table">
					<tr>
						<th>&nbsp;</th>
						<th colspan="<?php echo count($tpl['course_holes']['front']); ?>"><?php echo $GTM_LANG['AdminCourses']['front']; ?></th>
					</tr>
					<tr class="hole-numbers">
						<td class="label"><?php echo $GTM_LANG['AdminCourses']['update']['hole']; ?></td>
						<?php
						foreach ($tpl['course_holes']['front'] as $h) {
							?>
							<td><?php echo $h['hole_number']; ?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td class="label"><?php echo $GTM_LANG['AdminCourses']['update']['par']; ?></td>
						<?php
						foreach ($tpl['course_holes']['front'] as $h) {
							?>
							<td>
								<input type="text" name="par[<?php echo $h['id']; ?>]" value="<?php echo $h['par']; ?>" class="w60" />
							</td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td class="label"><?php echo $GTM_LANG['AdminCourses']['update']['yardage']; ?></td>
						<?php
						foreach ($tpl['course_holes']['front'] as $h) {
							?>
							<td>
								<input type="text" name="yardage[<?php echo $h['id']; ?>]" value="<?php echo $h['yardage']; ?>" class="w60" />
							</td>
							<?php
						}
						?>
					</tr>
				</table>
				
				<table cellpadding="0" cellspacing="0" class="corse-hole-table">
					<tr>
						<th>&nbsp;</th>
						<th colspan="<?php echo count($tpl['course_holes']['back']); ?>"><?php echo $GTM_LANG['AdminCourses']['back']; ?></th>
					</tr>
					<tr class="hole-numbers">
						<td class="label"><?php echo $GTM_LANG['AdminCourses']['update']['hole']; ?></td>
						<?php
						foreach ($tpl['course_holes']['back'] as $h) {
							?>
							<td><?php echo $h['hole_number']; ?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td class="label"><?php echo $GTM_LANG['AdminCourses']['update']['par']; ?></td>
						<?php
						foreach ($tpl['course_holes']['back'] as $h) {
							?>
							<td>
								<input type="text" name="par[<?php echo $h['id']; ?>]" value="<?php echo $h['par']; ?>" class="w60" />
							</td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td class="label"><?php echo $GTM_LANG['AdminCourses']['update']['yardage']; ?></td>
						<?php
						foreach ($tpl['course_holes']['back'] as $h) {
							?>
							<td>
								<input type="text" name="yardage[<?php echo $h['id']; ?>]" value="<?php echo $h['yardage']; ?>" class="w60" />
							</td>
							<?php
						}
						?>
					</tr>
				</table>
				
				<p>
					<label class="title">&nbsp;</label>
					<input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
				</p>
				
				<p>
					<label class="title">&nbsp;</label>
					<?php echo $GTM_LANG['AdminCourses']['hole_update_hint']; ?>
				</p>
			</form>
	
		</div>
		<?php
	} else {
		?>
		<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['AdminCourses']['not_found']; ?></p>
		<?php
	}
}
?>