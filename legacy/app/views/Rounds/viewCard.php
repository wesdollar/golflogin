<div class="contAddB">
	<div class="contAddC">
		<h3><img src="<?= WEB_URL; ?>img/h3_score_card.gif" alt="Score Card" /></h3>
		
		<div class="insideWrapper">
			<p>
				<label for="player_name"><?php echo $GTM_LANG['Rounds']['create']['player']; ?>:</label>
				<span id="player_name"><?php echo anchor('Players/view/' . $tpl['player']['id'], $tpl['player']['name']); ?></span>
			</p>
			
			<p>
				<label for="round_type"><?php echo $GTM_LANG['Rounds']['create']['round_type_title']; ?>:</label>
				<span id="round_type"><?php echo $GTM_LANG['Rounds']['create']['round_types'][$tpl['round']['type']]; ?></span>
			</p>
			
			<p>
				<label for="course_title"><?php echo $GTM_LANG['Rounds']['create']['course']; ?>:</label>
				<span id="course_title"><?php echo $tpl['course']['course_title'] . ' - ' . $tpl['course']['tee_box']; ?></span>
			</p>
			
			<p>
				<label for="is_tournament"><?php echo $GTM_LANG['Rounds']['create']['is_tournament']; ?>:</label>
				<span id="is_tournament"><?php echo $tpl['round']['is_tournament'] == 'T' ? $GTM_LANG['Rounds']['create']['options']['YES'] : $GTM_LANG['Rounds']['create']['options']['NO']; ?></span>
			</p>
			
			<p>
				<label><?php echo $GTM_LANG['Rounds']['create']['date_played']; ?>:</label>
				<span><?php echo date('m/d/Y', strtotime($tpl['round']['date_played'])); ?></span>
			</p>
			
			<?php
			if ($tpl['owner_flag'] === true) {
				?>
				<p>
					<label>&nbsp;</label>
					<span>
						<a href="Rounds/update/<?php echo $tpl['round']['id']; ?>" title="Edit Score Card"><?php echo $GTM_LANG['Rounds']['view_card']['edit_round']; ?></a>
					</span>
				</p>
				<?php
			}
			?>
			
			<?php

            // set birdie, par, bogey count to 0 so we can add each
            $outBirds = 0;
            $outPars = 0;
            $outBogs = 0;

			if (!empty($tpl['course'])) {
				if (empty($tpl['round']['nine_start']) || $tpl['round']['nine_start'] == 'front') {
					?>
					<table cellpadding="0" cellspacing="0" class="courseCardPreview">
						<tr>
							<th colspan="11"><?php echo $GTM_LANG['Rounds']['create']['front_9']; ?></th>
						</tr>
						<tr>
							<td class="alignLeft" width="100"><?php echo $GTM_LANG['Rounds']['create']['hole']; ?></td>
							<?php
							foreach ($tpl['holes']['front'] as $hole) {
								?>
								<td width="50"><?php echo $hole['hole_number']; ?></td>
								<?php
							}
							?>
							<td width="50"><?php echo $GTM_LANG['Rounds']['create']['out']; ?></td>
						</tr>

                        <tr>
                            <td class="alignLeft" width="100"><?php echo $GTM_LANG['Rounds']['create']['yards']; ?></td>
                            <?php
                            $outYardage = 0;
                            foreach ($tpl['holes']['front'] as $hole) {
                                $outYardage += $hole['yardage'];
                                ?>
                                <td width="50"><?php echo $hole['yardage']; ?></td>
                                <?php
                            }
                            ?>
                            <td width="50"><?php echo $outYardage; ?></td>
                        </tr>
						
						<tr>
							<td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['par']; ?></td>
							<?php
							$outHolePar = 0;
							foreach ($tpl['holes']['front'] as $hole) {
								$outHolePar += $hole['par'];
								?>
								<td><?php echo $hole['par']; ?></td>
								<?php
							}
							?>
							<td><?php echo $outHolePar; ?></td>
						</tr>
						
						<tr>
							<td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['strokes']; ?></td>
							<?php
							$outPutts = 0;
							foreach ($tpl['holes']['front'] as $hole) {
								$class = '';
								
								if (!empty($tpl['rholes'][$hole['id']]['strokes'])) {
									if (intval($tpl['rholes'][$hole['id']]['strokes']) > $hole['par']) {
										$class = ' class="greaterThenPar"';
                                        $outBogs++;
									} elseif (intval($tpl['rholes'][$hole['id']]['strokes']) < $hole['par']) {
										$class = ' class="lessThenPar"';
                                        $outBirds++;
									} elseif (intval($tpl['rholes'][$hole['id']]['strokes']) == $hole['par']) {
										$class = ' class="atPar"';
                                        $outPars++;
									}
								}
								
								?>
								<td<?php echo $class; ?>><?php echo @$tpl['rholes'][$hole['id']]['strokes']; ?></td>
								<?php
								$outPutts += intval(@$tpl['rholes'][$hole['id']]['strokes']);
							}
							?>
							<td id="outStrokes"><?php echo $outPutts; ?></td>
						</tr>
						
						<?php
						if ($tpl['round']['type'] == '18_STATS' || $tpl['round']['type'] == '9_STATS') {
							?>
							<tr>
								<td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['putts']; ?></td>
								<?php
								$outPutts = 0;
								foreach ($tpl['holes']['front'] as $hole) {
                                    $outPutts += intval(@$tpl['rholes'][$hole['id']]['putts']);
									?>
									<td><?php echo @$tpl['rholes'][$hole['id']]['putts']; ?></td>
									<?php
								}
								?>
								<td><?php echo $outPutts; ?></td>
							</tr>
						<?php
						}
				
						if ($tpl['round']['type'] == '18_STATS' || $tpl['round']['type'] == '9_STATS') {
							?>
                            <tr>
                                <td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['gir']; ?></td>
                                <?php
                                $outGIR = 0;
                                foreach ($tpl['holes']['front'] as $hole) {
                                    ?>
                                    <td>
                                        <?php
                                        if (!empty($tpl['rholes'][$hole['id']]['gir']) && $tpl['rholes'][$hole['id']]['gir'] != 'NA') {
                                            echo $GTM_LANG['Rounds']['create']['options'][$tpl['rholes'][$hole['id']]['gir']];
                                            if ($tpl['rholes'][$hole['id']]['gir'] == 'YES') {
                                                $outGIR ++;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <?php
                                }
                                ?>
                                <td><?php echo $outGIR; ?></td>
                            </tr>

                            <tr>
                                <td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['fir']; ?></td>
                                <?php
                                $outFIR = 0;
                                foreach ($tpl['holes']['front'] as $hole) {
                                    ?>
                                    <td>
                                        <?php
                                        if (!empty($tpl['rholes'][$hole['id']]['fir']) && $tpl['rholes'][$hole['id']]['fir'] != 'NA') {
                                            echo $GTM_LANG['Rounds']['create']['options'][$tpl['rholes'][$hole['id']]['fir']];
                                            if ($tpl['rholes'][$hole['id']]['fir'] == 'YES') {
                                                $outFIR ++;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <?php
                                }
                                ?>
                                <td><?php echo $outFIR; ?></td>
                            </tr>

                            <tr>
                                <td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['up_and_down']; ?></td>
                                <?php
                                $outPS = 0; // par save is YES
                                $outTPS = 0; // total par saves
                                foreach ($tpl['holes']['front'] as $hole) {
                                    ?>
                                    <td>
                                        <?php
                                        if (!empty($tpl['rholes'][$hole['id']]['up_and_down']) && $tpl['rholes'][$hole['id']]['up_and_down'] != 'NA') {
                                            echo $GTM_LANG['Rounds']['create']['options'][$tpl['rholes'][$hole['id']]['up_and_down']];
                                            if ($tpl['rholes'][$hole['id']]['up_and_down'] == 'YES') {
                                                $outPS ++;
                                            }
                                            if (($tpl['rholes'][$hole['id']]['up_and_down'] == 'YES') || ($tpl['rholes'][$hole['id']]['up_and_down'] == 'NO')) {
                                                $outTPS ++;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <?php
                                }
                                if ($outTPS > 0) {
                                    $outPSPct = round(($outPS * 100 / $outTPS)) . "%";
                                }
                                else {
                                    $outPSPct = "&nbsp;";
                                }
                                ?>
                                <td><?php echo $outPSPct; ?></td>
                            </tr>

                            <tr>
                                <td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['sand_save']; ?></td>
                                <?php
                                $outSS = 0; // save save is YES
                                $outTS = 0; // total sand saves
                                foreach ($tpl['holes']['front'] as $hole) {
                                    ?>
                                    <td>
                                        <?php
                                        if (!empty($tpl['rholes'][$hole['id']]['sand_save']) && $tpl['rholes'][$hole['id']]['sand_save'] != 'NA') {
                                            echo $GTM_LANG['Rounds']['create']['options'][$tpl['rholes'][$hole['id']]['sand_save']];
                                            if ($tpl['rholes'][$hole['id']]['sand_save'] == 'YES') {
                                                $outSS ++;
                                            }
                                            if (($tpl['rholes'][$hole['id']]['sand_save'] == 'YES') || ($tpl['rholes'][$hole['id']]['sand_save'] == 'NO')) {
                                                $outTS ++;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <?php
                                }
                                if ($outTS > 0) {
                                    $outSandPct = round(($outSS * 100 / $outTS)) . "%";
                                }
                                else {
                                    $outSandPct = "&nbsp;";
                                }
                                ?>
                                <td><?php echo $outSandPct; ?></td>
                            </tr>

                            <tr>
                                <td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['penalty_shots']; ?></td>
                                <?php
                                $totalPenalties = 0;
                                foreach ($tpl['holes']['front'] as $hole) {
                                    $totalPenalties += $tpl['rholes'][$hole['id']]['penalty_shots'];
                                    ?>
                                    <td><?php
                                        if ($tpl['rholes'][$hole['id']]['penalty_shots'] > 0) {
                                            echo @$tpl['rholes'][$hole['id']]['penalty_shots'];
                                        } ?></td>
                                    <?php
                                }
                                ?>
                                <td><?php echo $totalPenalties; ?></td>
                            </tr>
							<?php
						}
						?>
						
					</table>
					<?php
				}
				
				if ($tpl['round']['type'] == '18_STATS' || $tpl['round']['type'] == '18_NO_STATS' || (!empty($tpl['round']['nine_start']) && $tpl['round']['nine_start'] == 'back') ) {
					?>
					<br/>
					<table cellpadding="0" cellspacing="0" class="courseCardPreview">
						<tr>
							<th colspan="11"><?php echo $GTM_LANG['Rounds']['create']['back_9']; ?></th>
						</tr>
						<tr>
							<td class="alignLeft" width="100"><?php echo $GTM_LANG['Rounds']['create']['hole']; ?></td>
							<?php
							foreach ($tpl['holes']['back'] as $hole) {
								?>
								<td width="50"><?php echo $hole['hole_number']; ?></td>
								<?php
							}
							?>
							<td width="50"><?php echo $GTM_LANG['Rounds']['create']['in']; ?></td>
						</tr>

                        <tr>
                            <td class="alignLeft" width="100"><?php echo $GTM_LANG['Rounds']['create']['yards']; ?></td>
                            <?php
                            $inYardage = 0;
                            foreach ($tpl['holes']['back'] as $hole) {
                                $inYardage += $hole['yardage'];
                                ?>
                                <td width="50"><?php echo $hole['yardage']; ?></td>
                                <?php
                            }
                            ?>
                            <td width="50"><?php echo $inYardage; ?></td>
                        </tr>
						
						<tr>
							<td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['par']; ?></td>
							<?php
							$inHolePar = 0;
							foreach ($tpl['holes']['back'] as $hole) {
								$inHolePar += $hole['par'];
								?>
								<td><?php echo $hole['par']; ?></td>
								<?php
							}
							?>
							<td><?php echo $inHolePar; ?></td>
						</tr>

						<tr>
							<td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['strokes']; ?></td>
							<?php
							$outPutts = 0;
							foreach ($tpl['holes']['back'] as $hole) {
								$class = '';

								if (!empty($tpl['rholes'][$hole['id']]['strokes'])) {
									if (intval($tpl['rholes'][$hole['id']]['strokes']) > $hole['par']) {
										$class = ' class="greaterThenPar"';
                                        $outBogs++;
									} elseif (intval($tpl['rholes'][$hole['id']]['strokes']) < $hole['par']) {
										$class = ' class="lessThenPar"';
                                        $outBirds++;
									} elseif (intval($tpl['rholes'][$hole['id']]['strokes']) == $hole['par']) {
										$class = ' class="atPar"';
                                        $outPars++;
									}
								}
								
								?>
								<td<?php echo $class; ?>><?php echo @$tpl['rholes'][$hole['id']]['strokes']; ?></td>
								<?php
								$outPutts += intval(@$tpl['rholes'][$hole['id']]['strokes']);
							}
							?>
							<td id="inStrokes"><?php echo $outPutts; ?></td>
						</tr>
						
						<?php
						if ($tpl['round']['type'] == '18_STATS' || $tpl['round']['type'] == '9_STATS') {
							?>
							<tr>
								<td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['putts']; ?></td>
								<?php
                                $inPutts = 0;
								foreach ($tpl['holes']['back'] as $hole) {
                                    $inPutts += intval(@$tpl['rholes'][$hole['id']]['putts']);
									?>
									<td><?php echo @$tpl['rholes'][$hole['id']]['putts']; ?></td>
									<?php
								}
								?>
								<td><?php echo $inPutts; ?></td>
							</tr>
							<?php
						}
						
						if ($tpl['round']['type'] == '18_STATS' || $tpl['round']['type'] == '9_STATS') {
							?>
							<tr>
								<td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['gir']; ?></td>
								<?php
                                $inGIR = 0;
								foreach ($tpl['holes']['back'] as $hole) {
									?>
									<td>
										<?php
										if (!empty($tpl['rholes'][$hole['id']]['gir']) && $tpl['rholes'][$hole['id']]['gir'] != 'NA') {
											echo $GTM_LANG['Rounds']['create']['options'][$tpl['rholes'][$hole['id']]['gir']];
                                            if ($tpl['rholes'][$hole['id']]['gir'] == 'YES') {
                                                $inGIR ++;
                                            }
										}
										?>
									</td>
									<?php
								}
								?>
								<td><?php echo $inGIR; ?></td>
							</tr>
							
							<tr>
								<td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['fir']; ?></td>
								<?php
                                $inFIR = 0;
								foreach ($tpl['holes']['back'] as $hole) {
									?>
									<td>
										<?php
										if (!empty($tpl['rholes'][$hole['id']]['fir']) && $tpl['rholes'][$hole['id']]['fir'] != 'NA') {
											echo $GTM_LANG['Rounds']['create']['options'][$tpl['rholes'][$hole['id']]['fir']];
                                            if ($tpl['rholes'][$hole['id']]['fir'] == 'YES') {
                                                $inFIR ++;
                                            }
										}
										?>
									</td>
									<?php
								}
								?>
								<td><?php echo $inFIR; ?></td>
							</tr>
							
							<tr>
								<td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['up_and_down']; ?></td>
								<?php
                                $inPS = 0; // par save is YES
                                $inTPS = 0; // total par saves
								foreach ($tpl['holes']['back'] as $hole) {
									?>
									<td>
										<?php
										if (!empty($tpl['rholes'][$hole['id']]['up_and_down']) && $tpl['rholes'][$hole['id']]['up_and_down'] != 'NA') {
											echo $GTM_LANG['Rounds']['create']['options'][$tpl['rholes'][$hole['id']]['up_and_down']];
                                            if ($tpl['rholes'][$hole['id']]['up_and_down'] == 'YES') {
                                                $inPS ++;
                                            }
                                            if (($tpl['rholes'][$hole['id']]['up_and_down'] == 'YES') || ($tpl['rholes'][$hole['id']]['up_and_down'] == 'NO')) {
                                                $inTPS ++;
                                            }
										}
										?>
									</td>
									<?php
								}
                                if ($inTPS > 0) {
                                    $inPSPct = round(($inPS * 100 / $inTPS)) . "%";
                                }
                                else {
                                    $inPSPct = "&nbsp;";
                                }
								?>
								<td><?php echo $inPSPct; ?></td>
							</tr>
							
							<tr>
								<td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['sand_save']; ?></td>
								<?php
                                $inSS = 0; // save save is YES
                                $inTS = 0; // total sand saves
								foreach ($tpl['holes']['back'] as $hole) {
									?>
									<td>
										<?php
										if (!empty($tpl['rholes'][$hole['id']]['sand_save']) && $tpl['rholes'][$hole['id']]['sand_save'] != 'NA') {
											echo $GTM_LANG['Rounds']['create']['options'][$tpl['rholes'][$hole['id']]['sand_save']];
                                            if ($tpl['rholes'][$hole['id']]['sand_save'] == 'YES') {
                                                $inSS ++;
                                            }
                                            if (($tpl['rholes'][$hole['id']]['sand_save'] == 'YES') || ($tpl['rholes'][$hole['id']]['sand_save'] == 'NO')) {
                                                $inTS ++;
                                            }
										}
										?>
									</td>
									<?php
								}
                                if ($inTS > 0) {
                                    $inSandPct = round(($inSS * 100 / $inTS)) . "%";
                                }
                                else {
                                    $inSandPct = "&nbsp;";
                                }
								?>
								<td><?php echo $inSandPct; ?></td>
							</tr>
							
							<tr>
								<td class="alignLeft"><?php echo $GTM_LANG['Rounds']['create']['penalty_shots']; ?></td>
								<?php
                                $totalPenalties = 0;
								foreach ($tpl['holes']['back'] as $hole) {
                                    $totalPenalties += $tpl['rholes'][$hole['id']]['penalty_shots'];
									?>
									<td><?php
                                        if ($tpl['rholes'][$hole['id']]['penalty_shots'] > 0) {
                                            echo @$tpl['rholes'][$hole['id']]['penalty_shots'];
                                        } ?></td>
									<?php
								}
								?>
								<td><?php echo $totalPenalties; ?></td>
							</tr>
							<?php
						}
						?>
						
					</table>
					<?php
				}
			} else {
				
			}
			?>
            <div id="roundCount">
                <div class="birdies"><span>Birdies or Better</span><br /><?php echo $outBirds; ?></div>
                <div class="pars"><span>Pars</span><br /><?php echo $outPars; ?></div>
                <div class="bogies"><span>Bogies or Worse</span><br /><?php echo $outBogs; ?></div>
            </div>
		</div>
	</div>
</div>