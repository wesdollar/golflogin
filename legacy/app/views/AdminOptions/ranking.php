<?php
error_reporting(0);

if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminOptions']['heading_general']; ?></h3>
	
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminOptions&amp;action=update" method="post" id="frmUpdateOptions" class="form" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" name="options_update" value="1" />
			<input type="hidden" name="refferer" value="ranking" />

			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_overall']; ?></label>
				<select name="show_overall" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_overall'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_18TAvg']; ?></label>
				<select name="show_18TAvg" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_18TAvg'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_18Anv']; ?></label>
				<select name="show_18Anv" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_18Anv'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_9Avg']; ?></label>
				<select name="show_9Avg" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_9Avg'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_handicap']; ?></label>
				<select name="show_handicap" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_handicap'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_fir']; ?></label>
				<select name="show_fir" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_fir'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_gir']; ?></label>
				<select name="show_gir" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_gir'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_ppg']; ?></label>
				<select name="show_ppg" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_ppg'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_ppr']; ?></label>
				<select name="show_ppr" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_ppr'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_ups']; ?></label>
				<select name="show_ups" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_ups'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_sand_save']; ?></label>
				<select name="show_sand_save" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_sand_save'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_par_or_better']; ?></label>
				<select name="show_par_or_better" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_par_or_better'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_par_breakers']; ?></label>
				<select name="show_par_breakers" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_par_breakers'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_pspr']; ?></label>
				<select name="show_pspr" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_pspr'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_par3avg']; ?></label>
				<select name="show_par3avg" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_par3avg'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_par4avg']; ?></label>
				<select name="show_par4avg" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_par4avg'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_par5avg']; ?></label>
				<select name="show_par5avg" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_par5avg'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<!-- *************************************** -->
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_total_rounds']; ?></label>
				<select name="show_total_rounds" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_total_rounds'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_eagles']; ?></label>
				<select name="show_eagles" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_eagles'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_birdies']; ?></label>
				<select name="show_birdies" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_birdies'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_pars']; ?></label>
				<select name="show_pars" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_pars'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_bogies']; ?></label>
				<select name="show_bogies" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_bogies'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_2xbogies']; ?></label>
				<select name="show_2xbogies" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_2xbogies'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			<p>
				<label class="title-xwide"><?php echo $GTM_LANG['AdminOptions']['show_3xbogies']; ?></label>
				<select name="show_3xbogies" class="sw50 required">
					<?php
					foreach ($GTM_LANG['_yesno'] as $key => $val) {
						?>
						<option value="<?php echo $key; ?>" <?php echo $tpl['options']['show_3xbogies'] == $key ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
						<?php
					}
 					?>
				</select>
			</p>
			
			
						
			<p>
				<label class="title-xwide">&nbsp;</label>
				<input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
			</p>
		</form>
	</div>
	<?php
}