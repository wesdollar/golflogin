<?php
require_once HELPERS_PATH . 'time.widget.php';

function getId($data, $sep = '-') {
	if (!empty($data)) {
		return $data['id'].$sep.$data['round_id'].$sep.$data['hole_id'];
	}
	
	return false;
}
?>
<div class="contAddB">
	<div class="contAddC">
		<h3><img src="<?= WEB_URL; ?>img/h3_edit_round.gif" alt="Edit Round" /></h3>
		
		<?php
		if ($tpl['owner_flag'] === true)
        {
			?>
			<form id="frmCreateRound" name="frmCreateRound" class="frm frmSave contMessage" method="post" action="Rounds/update/" enctype="multipart/form-data">
				<input type="hidden" name="round_update" value="1" />
				<input type="hidden" name="round_id" value="<?php echo intval($_REQUEST['id']); ?>" />
				<input type="hidden" name="player_id" value="<?php echo $tpl['player']['id']; ?>" />

				<p>
					<label><?php echo $GTM_LANG['Rounds']['create']['player']; ?>:</label>
					<?php echo anchor('Players/view/' . $tpl['player']['id'], $tpl['player']['name']); ?>
				</p>
				
				<p>
					<label><?php echo $GTM_LANG['Rounds']['create']['round_type_title']; ?>:</label>
					<?php echo $GTM_LANG['Rounds']['create']['round_types'][$tpl['round']['type']]; ?>
				</p>
				
				
				<p>
					<label><?php echo $GTM_LANG['Rounds']['create']['course']; ?>:</label>
					<?php echo $tpl['course']['course_title'] . ' - ' . $tpl['course']['tee_box']; ?>
				</p>
				
				<p>
					<label><?php echo $GTM_LANG['Rounds']['create']['is_tournament']; ?>:</label>
					<?php echo $tpl['round']['is_tournament'] == 'T' ? $GTM_LANG['Rounds']['create']['options']['YES'] : $GTM_LANG['Rounds']['create']['options']['NO']; ?>
				</p>
				
				<p>
					<label><?php echo $GTM_LANG['Rounds']['create']['date_played']; ?>:</label>
					<?php echo date('m/d/Y', strtotime($tpl['round']['date_played'])); ?>
				</p>
				
				<?php
				if (!empty($tpl['course'])) {
					if (empty($tpl['round']['nine_start']) || $tpl['round']['nine_start'] == 'front') {
						?>
						<table cellpadding="0" cellspacing="0" class="courseCard">
							<tr>
								<th colspan="10" class="alignCenter"><?php echo $GTM_LANG['Rounds']['create']['front_9']; ?></th>
							</tr>
							<tr>
								<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['hole']; ?></th>
								<?php
								foreach ($tpl['holes']['front'] as $hole) {
									?>
									<th class="alignCenter"><?php echo $hole['hole_number']; ?></th>
									<?php
								}
								?>
								<th class="alignCenter"><?php echo $GTM_LANG['Rounds']['create']['out']; ?></th>
							</tr>
							
							<tr>
								<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['par']; ?></th>
								<?php
								$outHolePar = 0;
								foreach ($tpl['holes']['front'] as $hole) {
									$outHolePar += $hole['par'];
									?>
									<th class="alignCenter"><?php echo $hole['par']; ?></th>
									<?php
								}
								?>
								<th class="alignCenter"><?php echo $outHolePar; ?></th>
							</tr>
							
							<tr>
								<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['strokes']; ?></th>
								<?php
								$outPutts = 0;
								foreach ($tpl['holes']['front'] as $hole) {
									?>
									<th class="alignCenter"><input type="text" name="strokes[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" value="<?php echo @$tpl['rholes'][$hole['id']]['strokes']; ?>" class="iw64 alignCenter calcOutStrokes" /></th>
									<?php
									$outPutts += intval(@$tpl['rholes'][$hole['id']]['strokes']);
								}
								?>
								<th id="outStrokes" class="alignCenter"><?php echo $outPutts; ?></th>
							</tr>
							
							<?php
							if ($tpl['round']['type'] == '18_STATS' || $tpl['round']['type'] == '9_STATS') {
								?>
								<tr>
									<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['putts']; ?></th>
									<?php
									$outPutts = 0;
									foreach ($tpl['holes']['front'] as $hole) {
										?>
										<th class="alignCenter"><input type="text" name="putts[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" value="<?php echo @$tpl['rholes'][$hole['id']]['putts']; ?>" class="iw64 alignCenter" /></th>
										<?php
									}
									?>
									<td>&nbsp;</td>
								</tr>
							<?php
							}
					
							if ($tpl['round']['type'] == '18_STATS' || $tpl['round']['type'] == '9_STATS') {
								?>
								<tr>
									<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['gir']; ?></th>
									<?php
									$outPutts = 0;
									foreach ($tpl['holes']['front'] as $hole) {
										?>
										<th class="alignCenter">
											<select name="gir[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" class="sw64">
												<?php
												foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
													?>
													<option value="<?php echo $key; ?>" <?php echo $key == @$tpl['rholes'][$hole['id']]['gir'] ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
													<?php
												}
												?>
											</select>
										</th>
										<?php
									}
									?>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['fir']; ?></th>
									<?php
									$outPutts = 0;
									foreach ($tpl['holes']['front'] as $hole) {
										?>
										<th class="alignCenter">
											<select name="fir[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" class="sw64">
												<?php
												foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
													?>
													<option value="<?php echo $key; ?>" <?php echo $key == @$tpl['rholes'][$hole['id']]['fir'] ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
													<?php
												}
												?>
											</select>
										</th>
										<?php
									}
									?>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['up_and_down']; ?></th>
									<?php
									$outPutts = 0;
									foreach ($tpl['holes']['front'] as $hole) {
										?>
										<th class="alignCenter">
											<select name="up_and_down[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" class="sw64">
												<?php
												foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
													?>
													<option value="<?php echo $key; ?>" <?php echo $key == @$tpl['rholes'][$hole['id']]['up_and_down'] ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
													<?php
												}
												?>
											</select>
										</th>
										<?php
									}
									?>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['sand_save']; ?></th>
									<?php
									$outPutts = 0;
									foreach ($tpl['holes']['front'] as $hole) {
										?>
										<th class="alignCenter">
											<select name="sand_save[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" class="sw64">
												<?php
												foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
													?>
													<option value="<?php echo $key; ?>" <?php echo $key == @$tpl['rholes'][$hole['id']]['sand_save'] ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
													<?php
												}
												?>
											</select>
										</th>
										<?php
									}
									?>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['penalty_shots']; ?></th>
									<?php
									$outPutts = 0;
									foreach ($tpl['holes']['front'] as $hole) {
										?>
										<th class="alignCenter">
											<select name="penalty_shots[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" class="sw64">
												<?php
												foreach (range(0, 10) as $i) {
													?>
													<option value="<?php echo $i; ?>" <?php echo $i == intval(@$tpl['rholes'][$hole['id']]['penalty_shots']) ? 'selected="selected"' : null; ?>><?php echo $i; ?></option>
													<?php
												}
												?>
											</select>
										</th>
										<?php
									}
									?>
									<td>&nbsp;</td>
								</tr>
								<?php
							}
							?>
							
						</table>
						<?php
					}
					
					if ($tpl['round']['type'] == '18_STATS' || $tpl['round']['type'] == '18_NO_STATS' || (!empty($tpl['round']['nine_start']) && $tpl['round']['nine_start'] == 'back') ) {
						?>
						<table cellpadding="0" cellspacing="0" class="courseCard">
							<tr>
								<th colspan="10" class="alignCenter"><?php echo $GTM_LANG['Rounds']['create']['back_9']; ?></th>
							</tr>
							<tr>
								<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['hole']; ?></th>
								<?php
								foreach ($tpl['holes']['back'] as $hole) {
									?>
									<th class="alignCenter"><?php echo $hole['hole_number']; ?></th>
									<?php
								}
								?>
								<th class="alignCenter"><?php echo $GTM_LANG['Rounds']['create']['in']; ?></th>
							</tr>
							
							<tr>
								<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['par']; ?></th>
								<?php
								$inHolePar = 0;
								foreach ($tpl['holes']['back'] as $hole) {
									$inHolePar += $hole['par'];
									?>
									<th class="alignCenter"><?php echo $hole['par']; ?></th>
									<?php
								}
								?>
								<th class="alignCenter"><?php echo $inHolePar; ?></th>
							</tr>
							
							<tr>
								<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['strokes']; ?></th>
								<?php
								$outPutts = 0;
								foreach ($tpl['holes']['back'] as $hole) {
									?>
									<th class="alignCenter"><input type="text" name="strokes[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" value="<?php echo @$tpl['rholes'][$hole['id']]['strokes']; ?>" class="iw64 alignCenter calcInStrokes" /></th>
									<?php
									$outPutts += intval(@$tpl['rholes'][$hole['id']]['strokes']);
								}
								?>
								<th id="inStrokes" class="alignCenter"><?php echo $outPutts; ?></th>
							</tr>
							
							<?php
							if ($tpl['round']['type'] == '18_STATS' || $tpl['round']['type'] == '9_STATS') {
								?>
								<tr>
									<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['putts']; ?></th>
									<?php
									foreach ($tpl['holes']['back'] as $hole) {
										?>
										<th class="alignCenter"><input type="text" name="putts[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" value="<?php echo @$tpl['rholes'][$hole['id']]['putts']; ?>" class="iw64 alignCenter" /></th>
										<?php
									}
									?>
									<td>&nbsp;</td>
								</tr>
								<?php
							}
							
							if ($tpl['round']['type'] == '18_STATS' || $tpl['round']['type'] == '9_STATS') {
								?>
								<tr>
									<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['gir']; ?></th>
									<?php
									foreach ($tpl['holes']['back'] as $hole) {
										?>
										<th class="alignCenter">
											<select name="gir[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" class="sw64">
												<?php
												foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
													?>
													<option value="<?php echo $key; ?>" <?php echo $key == @$tpl['rholes'][$hole['id']]['gir'] ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
													<?php
												}
												?>
											</select>
										</th>
										<?php
									}
									?>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['fir']; ?></th>
									<?php
									foreach ($tpl['holes']['back'] as $hole) {
										?>
										<th class="alignCenter">
											<select name="fir[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" class="sw64">
												<?php
												foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
													?>
													<option value="<?php echo $key; ?>" <?php echo $key == @$tpl['rholes'][$hole['id']]['fir'] ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
													<?php
												}
												?>
											</select>
										</th>
										<?php
									}
									?>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['up_and_down']; ?></th>
									<?php
									foreach ($tpl['holes']['back'] as $hole) {
										?>
										<th class="alignCenter">
											<select name="up_and_down[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" class="sw64">
												<?php
												foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
													?>
													<option value="<?php echo $key; ?>" <?php echo $key == @$tpl['rholes'][$hole['id']]['up_and_down'] ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
													<?php
												}
												?>
											</select>
										</th>
										<?php
									}
									?>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['sand_save']; ?></th>
									<?php
									foreach ($tpl['holes']['back'] as $hole) {
										?>
										<th class="alignCenter">
											<select name="sand_save[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" class="sw64">
												<?php
												foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
													?>
													<option value="<?php echo $key; ?>" <?php echo $key == @$tpl['rholes'][$hole['id']]['sand_save'] ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
													<?php
												}
												?>
											</select>
										</th>
										<?php
									}
									?>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['penalty_shots']; ?></th>
									<?php
									foreach ($tpl['holes']['back'] as $hole) {
										?>
										<th class="alignCenter">
											<select name="penalty_shots[<?php echo getId(@$tpl['rholes'][$hole['id']]); ?>]" class="sw64">
												<?php
												foreach (range(0, 10) as $i) {
													?>
													<option value="<?php echo $i; ?>" <?php echo $i == intval(@$tpl['rholes'][$hole['id']]['penalty_shots']) ? 'selected="selected"' : null; ?>><?php echo $i; ?></option>
													<?php
												}
												?>
											</select>
										</th>
										<?php
									}
									?>
									<td>&nbsp;</td>
								</tr>
								<?php
							}
							?>
							
						</table>
						<?php
					}
					
					?>
					<p class="btnSave"><input name="txtPost" id="txtPost" type="submit" value="" /></p>
					<?php
					
				} else {
					
				}
				?>
			</form>
			<?php
		} else {
			?>
			<p style="padding: 10px;"><?php echo $GTM_LANG['Rounds']['update']['no_permissions']; ?></p>
			<?php
		}
		?>
	</div>
</div>