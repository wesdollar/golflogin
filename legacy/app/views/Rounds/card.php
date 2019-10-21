<?php
if (!empty($tpl['course'])) {
	
	if ($tpl['number_holes'] == 9) {
		?>
		<p>
			<label for="nine_start"><?php echo $GTM_LANG['Rounds']['create']['nine_start_label']; ?>:</label>
			<select name="nine_start" id="nine_start" class="sw100">
				<?php
				foreach ($GTM_LANG['Rounds']['create']['nine_start'] as $key => $val) {
					?>
					<option value="<?php echo $key; ?>" <?php echo !empty($_REQUEST['nine_start']) && $key == $_REQUEST['nine_start'] ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
					<?php
				}
				?>
			</select>
		</p>
		<?php
	}
	
	if (empty($_REQUEST['nine_start']) || $_REQUEST['nine_start'] == 'front') {
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
					<th class="alignCenter"><input id="smStrokes<?php echo $hole['id']; ?>" type="text" name="strokes[<?php echo $hole['id']; ?>]" value="" class="iw64 alignCenter calcOutStrokes" /></th>
					<?php
				}
				?>
				<th id="outStrokes" class="alignCenter">0</th>
			</tr>
			
			<?php
			if ($tpl['show_stats'] === true) {
				?>
				<tr>
					<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['putts']; ?></th>
					<?php
					$outPutts = 0;
					foreach ($tpl['holes']['front'] as $hole) {
						?>
						<th class="alignCenter"><input id="smPutts<?php echo $hole['id']; ?>" type="text" name="putts[<?php echo $hole['id']; ?>]" value="" class="iw64 alignCenter" /></th>
						<?php
					}
					?>
					<td>&nbsp;</td>
				</tr>
			<?php
			}
	
			if ($tpl['show_stats'] === true) {
				?>
				<tr>
					<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['gir']; ?></th>
					<?php
					$outPutts = 0;
					foreach ($tpl['holes']['front'] as $hole) {
						?>
						<th class="alignCenter">
						
						<?php
                            // Front 9 Par 3
								if($hole['par'] == "3") { ?>
									<script type="text/javascript">	
									$('#smPutts<?php echo $hole['id']; ?>').bind('blur', function(){
										var field1 = parseInt($('#smStrokes<?php echo $hole['id']; ?>').val());
										var field2 = parseInt($('#smPutts<?php echo $hole['id']; ?>').val());
										
										if((field1 == 3 && field2 == 2) || (field1 == 4 && field2 == 3) || (field1 == 5 && field2 == 4) || (field1 == 2 && field2 == 1) || field1 <= 1){
										   $('#smGIR<?php echo $hole['id']; ?>').val('YES')
										} else {
										   $('#smGIR<?php echo $hole['id']; ?>').val('NO')
										}
									});
									</script>
									<input type="text" name="gir[<?php echo $hole['id']; ?>]" id="smGIR<?php echo $hole['id']; ?>" value="NO" style="width:35px" readonly="readonly"  /><br />
							<?php
								}
                            // Front 9 Par 4
								elseif($hole['par'] == "4")  { ?>
									<script type="text/javascript">	
									$('#smPutts<?php echo $hole['id']; ?>').bind('blur', function(){
										var field1 = parseInt($('#smStrokes<?php echo $hole['id']; ?>').val());
										var field2 = parseInt($('#smPutts<?php echo $hole['id']; ?>').val());
										
										if((field1 == 4 && field2 == 2) || (field1 == 3 && field2 == 2) || (field1 == 3 && field2 == 1) || (field1 == 4 && field2 == 3) || (field1 == 5 && field2 == 3) || (field1 == 6 && field2 == 4) || (field1 == 6 && field2 == 5) || (field1 == 7 && field2 == 5) || (field1 == 5 && field2 == 4) || (field1 == 6 && field2 == 4) || (field1 == 8 && field2 == 6) || field1 <= 2){
										   $('#smGIR<?php echo $hole['id']; ?>').val('YES')
										}
										 else {
										   $('#smGIR<?php echo $hole['id']; ?>').val('NO')
										}
									});
									</script>
									<input type="text" name="gir[<?php echo $hole['id']; ?>]" id="smGIR<?php echo $hole['id']; ?>" value="NO" style="width:35px" readonly="readonly" /><br />
							<?php
								}
                            // Front 9 Par 5
								elseif($hole['par'] == "5") { ?>
										<script type="text/javascript">	
									$('#smPutts<?php echo $hole['id']; ?>').bind('blur', function(){
										var field1 = parseInt($('#smStrokes<?php echo $hole['id']; ?>').val());
										var field2 = parseInt($('#smPutts<?php echo $hole['id']; ?>').val());
										
										if((field1 == 5 && field2 == 2) || (field1 == 4 && field2 == 2) || (field1 == 5 && field2 == 3) || (field1 == 6 && field2 == 3) || (field1 == 7 && field2 == 4) || (field1 == 8 && field2 == 5) || (field1 == 9 && field2 == 7) || (field1 == 10 && field2 == 8) || (field1 == 8 && field2 == 6) || (field1 == 9 && field2 == 6) || (field1 == 4 && field2 == 3) || (field1 == 10 && field2 == 7) || (field1 == 4 && field2 == 1) || (field1 == 6 && field2 == 4) || (field1 == 5 && field2 == 4) || field1 <= 3){
										   $('#smGIR<?php echo $hole['id']; ?>').val('YES')
										} else {
										   $('#smGIR<?php echo $hole['id']; ?>').val('NO')
										}
									});
									</script>
									<input type="text" name="gir[<?php echo $hole['id']; ?>]" id="smGIR<?php echo $hole['id']; ?>" value="NO" style="width:35px" readonly="readonly" /><br />
							<?php
								}
							?>	
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
                            <?php if($hole['par'] != "3") : ?>
                                <select name="fir[<?php echo $hole['id']; ?>]" class="sw64">
                                    <?php
                                    foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
                                        ?>
                                        <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            <?php else : ?>
                                &nbsp;
                            <?php endif; ?>
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
							<select name="up_and_down[<?php echo $hole['id']; ?>]" class="sw64">
								<?php
								foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
									?>
									<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
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
							<select name="sand_save[<?php echo $hole['id']; ?>]" class="sw64">
								<?php
								foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
									?>
									<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
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
							<select name="penalty_shots[<?php echo $hole['id']; ?>]" class="sw64">
								<?php
								foreach (range(0, 10) as $i) {
									?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
	
	if ($tpl['number_holes'] == 18 || (!empty($_REQUEST['nine_start']) && $_REQUEST['nine_start'] == 'back') ) {
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
					<th class="alignCenter"><input type="text" id="smStrokes<?php echo $hole['id']; ?>" name="strokes[<?php echo $hole['id']; ?>]" value="" class="iw64 alignCenter calcInStrokes" /></th>
					<?php
				}
				?>
				<th id="inStrokes" class="alignCenter">0</th>
			</tr>
			
			<?php
			if ($tpl['show_stats'] === true) {
				?>
				<tr>
					<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['putts']; ?></th>
					<?php
					foreach ($tpl['holes']['back'] as $hole) {
						?>
						<th class="alignCenter"><input type="text" id="smPutts<?php echo $hole['id']; ?>" name="putts[<?php echo $hole['id']; ?>]" value="" class="iw64 alignCenter" /></th>
						<?php
					}
					?>
					<td>&nbsp;</td>
				</tr>
				<?php
			}
			
			if ($tpl['show_stats'] === true) {
				?>
				<tr>
					<th class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['gir']; ?></th>
					<?php
					foreach ($tpl['holes']['back'] as $hole) {
						?>
						<th class="alignCenter">
							<?php
                            // Back 9 Par 3
								if($hole['par'] == "3") { ?>
                                    <script type="text/javascript">
                                        $('#smPutts<?php echo $hole['id']; ?>').bind('blur', function(){
                                            var field1 = parseInt($('#smStrokes<?php echo $hole['id']; ?>').val());
                                            var field2 = parseInt($('#smPutts<?php echo $hole['id']; ?>').val());

                                            if((field1 == 3 && field2 == 2) || (field1 == 4 && field2 == 3) || (field1 == 5 && field2 == 4) || (field1 == 2 && field2 == 1) || field1 <= 1){
                                                $('#smGIR<?php echo $hole['id']; ?>').val('YES')
                                            } else {
                                                $('#smGIR<?php echo $hole['id']; ?>').val('NO')
                                            }
                                        });
                                    </script>
                                    <input type="text" name="gir[<?php echo $hole['id']; ?>]" id="smGIR<?php echo $hole['id']; ?>" value="NO" style="width:35px" readonly="readonly"  /><br />
							<?php
								}
                            // Back 9 Par 4
								elseif($hole['par'] == "4")  { ?>
									<script type="text/javascript">	
									$('#smPutts<?php echo $hole['id']; ?>').bind('blur', function(){
										var field1 = parseInt($('#smStrokes<?php echo $hole['id']; ?>').val());
										var field2 = parseInt($('#smPutts<?php echo $hole['id']; ?>').val());
										
										if((field1 == 4 && field2 == 2) || (field1 == 3 && field2 == 2) || (field1 == 3 && field2 == 1) || (field1 == 4 && field2 == 3) || (field1 == 5 && field2 == 3) || (field1 == 6 && field2 == 4) || (field1 == 6 && field2 == 5) || (field1 == 7 && field2 == 5) || (field1 == 5 && field2 == 4) || (field1 == 6 && field2 == 4) || (field1 == 8 && field2 == 6) || field1 <= 2){
										   $('#smGIR<?php echo $hole['id']; ?>').val('YES')
										}
										 else {
										   $('#smGIR<?php echo $hole['id']; ?>').val('NO')
										}
									});
									</script>
									<input type="text" name="gir[<?php echo $hole['id']; ?>]" id="smGIR<?php echo $hole['id']; ?>" value="NO" style="width:35px" readonly="readonly" /><br />
							<?php
								}
                            // Back 9 Par 5
								elseif($hole['par'] == "5") { ?>
										<script type="text/javascript">	
									$('#smPutts<?php echo $hole['id']; ?>').bind('blur', function(){
										var field1 = parseInt($('#smStrokes<?php echo $hole['id']; ?>').val());
										var field2 = parseInt($('#smPutts<?php echo $hole['id']; ?>').val());
										
										if((field1 == 5 && field2 == 2) || (field1 == 4 && field2 == 2) || (field1 == 5 && field2 == 3) || (field1 == 6 && field2 == 3) || (field1 == 7 && field2 == 4) || (field1 == 8 && field2 == 5) || (field1 == 9 && field2 == 7) || (field1 == 10 && field2 == 8) || (field1 == 8 && field2 == 6) || (field1 == 9 && field2 == 6) || (field1 == 4 && field2 == 3) || (field1 == 10 && field2 == 7) || (field1 == 4 && field2 == 1) || (field1 == 6 && field2 == 4) || (field1 == 5 && field2 == 4) || field1 <= 3){
										   $('#smGIR<?php echo $hole['id']; ?>').val('YES')
										} else {
										   $('#smGIR<?php echo $hole['id']; ?>').val('NO')
										}
									});
									</script>
									<input type="text" name="gir[<?php echo $hole['id']; ?>]" id="smGIR<?php echo $hole['id']; ?>" value="NO" style="width:35px" readonly="readonly" /><br />
							<?php
								}
							?>	
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
                            <?php if($hole['par'] != "3") : ?>
                            <select name="fir[<?php echo $hole['id']; ?>]" class="sw64">
                                <?php
                                foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php else : ?>
                            &nbsp;
                            <?php endif; ?>
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
							<select name="up_and_down[<?php echo $hole['id']; ?>]" class="sw64">
								<?php
								foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
									?>
									<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
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
							<select name="sand_save[<?php echo $hole['id']; ?>]" class="sw64">
								<?php
								foreach ($GTM_LANG['Rounds']['create']['options'] as $key => $val) {
									?>
									<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
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
							<select name="penalty_shots[<?php echo $hole['id']; ?>]" class="sw64">
								<?php
								foreach (range(0, 10) as $i) {
									?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
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