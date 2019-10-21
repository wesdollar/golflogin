<div class="contAddB">
	<div class="contAddC">
		<h3><img src="<?= WEB_URL; ?>img/h3_add_course.gif" alt="Add Course" /></h3>
		
		<form id="frmCreateCourse" name="frmCreateCourse" class="frm frmSave contMessage" method="post" action="Courses/create/" enctype="multipart/form-data">
			<input type="hidden" name="course_create" value="1" />
		
			<p>
				<label for="course_title"><?php echo $GTM_LANG['Courses']['create']['course_title']; ?>:</label>
				<input type="text" name="course_title" id="course_title" value="<?php echo @$_REQUEST['course_title']; ?>" class="iw300 required" />
			</p>
			
			<p>
				<label for="tee_box"><?php echo $GTM_LANG['Courses']['create']['tee_box']; ?>:</label>
				<input type="text" name="tee_box" id="tee_box" value="<?php echo @$_REQUEST['tee_box']; ?>" class="iw300 required" />
			</p>
			
			<p>
				<label for="usga_rating"><?php echo $GTM_LANG['Courses']['create']['usga_rating']; ?>:</label>
				<input type="text" name="usga_rating" id="usga_rating" value="<?php echo @$_REQUEST['usga_rating']; ?>" class="iw64 required" />
			</p>
			
			<p>
				<label for="slop_rating"><?php echo $GTM_LANG['Courses']['create']['slop']; ?>:</label>
				<input type="text" name="slop_rating" id="slop_rating" value="<?php echo @$_REQUEST['slop_rating']; ?>" class="iw64 required" />
			</p>
			
			<table cellpadding="0" cellspacing="0" class="courseCard">
				<tr>
					<th colspan="10" class="alignCenter"><?php echo $GTM_LANG['Courses']['create']['front_9']; ?></th>
				</tr>
				<tr>
					<th class="alignLeft"><?php echo $GTM_LANG['Courses']['create']['hole']; ?></th>
					<?php
					foreach (range(1, 9) as $i) {
						?>
						<th class="alignCenter"><?php echo $i; ?></th>
						<?php
					}
					?>
				</tr>
				<tr>
					<th class="alignLeft"><?php echo $GTM_LANG['Courses']['create']['par']; ?></th>
					<?php
					foreach (range(1, 9) as $i) {
						?>
						<td><input type="text" name="par[<?php echo $i; ?>]" value="<?php echo @$_REQUEST['par'][$i]; ?>" class="iw64 alignCenter" /></td>
						<?php
					}
					?>
				</tr>
				<tr>
					<th class="alignLeft"><?php echo $GTM_LANG['Courses']['create']['yardage']; ?></th>
					<?php
					foreach (range(1, 9) as $i) {
						?>
						<td><input type="text" name="yardage[<?php echo $i; ?>]" value="<?php echo @$_REQUEST['yardage'][$i]; ?>" class="iw64 alignCenter" /></td>
						<?php
					}
					?>
				</tr>
			</table>
			
			<table cellpadding="0" cellspacing="0" class="courseCard">
				<tr>
					<th colspan="10" class="alignCenter"><?php echo $GTM_LANG['Courses']['create']['back_9']; ?></th>
				</tr>
				<tr>
					<th class="alignLeft"><?php echo $GTM_LANG['Courses']['create']['hole']; ?></th>
					<?php
					foreach (range(10, 18) as $i) {
						?>
						<th class="alignCenter"><?php echo $i; ?></th>
						<?php
					}
					?>
				</tr>
				<tr>
					<th class="alignLeft"><?php echo $GTM_LANG['Courses']['create']['par']; ?></th>
					<?php
					foreach (range(10, 18) as $i) {
						?>
						<td><input type="text" name="par[<?php echo $i; ?>]" value="<?php echo @$_REQUEST['par'][$i]; ?>" class="iw64 alignCenter" /></td>
						<?php
					}
					?>
				</tr>
				<tr>
					<th class="alignLeft"><?php echo $GTM_LANG['Courses']['create']['yardage']; ?></th>
					<?php
					foreach (range(10, 18) as $i) {
						?>
						<td><input type="text" name="yardage[<?php echo $i; ?>]" value="<?php echo @$_REQUEST['yardage'][$i]; ?>" class="iw64 alignCenter" /></td>
						<?php
					}
					?>
				</tr>
			</table>
			
			<p class="btnSave"><input name="txtPost" id="txtPost" type="submit" value="" /></p>
		</form>
	</div>
</div>