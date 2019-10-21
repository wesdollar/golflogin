<div id="content">
	<?php
	if ($tpl['player']) {
		?>
		<div class="contPlayB">
			<div class="contPlayC">
				<table width="713" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<th><img src="<?= WEB_URL; ?>img/h3_player_stats.gif" alt="" width="89" height="17" /></th>
					</tr>
				</table>
				<table width="702" border="0" cellpadding="0" cellspacing="0" class="marRL5 playerStatsTable">
					<tr class="bgdPlay01">
						<td valign="top" class="playerName">
                            <?php echo anchor('Players/view/'.$tpl['player']['id'], readFromDb($tpl['player']['name'])); ?>
                            <?= anchor('Players/viewRounds/'.$tpl['player']['id'], 'View Scorecard Archive', array('style' => 'float:right;')); ?>
                        </td>
						<td valign="top" width="60" height="20" class="last">&nbsp;</td>
					</tr>
					
					<?php
					$counter = 1;
					foreach ($GTM_LANG['Players']['stats'] as $key => $val) {
						?>
						<tr class="bgdPlay0<?php echo $counter%2 ? '2' : '3'; ?>">
							<td valign="top" class="label<?php echo $counter == count($GTM_LANG['Players']['stats']) ? ' borNone' : null; ?>"><?php echo $val; ?></td>
							<?php
							if (in_array($key, array('fir', 'gir', 'up_and_down', 'sand_saves', 'par_or_better', 'par_breakers'))) {
								?>
								<td valign="top" class="last<?php echo $counter == count($GTM_LANG['Players']['stats']) ? ' borNone' : null; ?>"><?php echo number_format($tpl['player'][$key] * 100, 2); ?> %</td>
								<?php
							} else {
								?>
								<td valign="top" class="last<?php echo $counter == count($GTM_LANG['Players']['stats']) ? ' borNone' : null; ?>"><?php echo readFromDb($tpl['player'][$key]); ?></td>
								<?php
							}
							?>
						</tr>
						<?php
						$counter++;
					}
					?>
				</table>
			</div>
		</div>
		<br/>
		<p>&nbsp;&nbsp;&nbsp;<?php echo anchor('Players/view/'.$tpl['player']['id'], $GTM_LANG['Players']['view']['view_back_profile']); ?></p>
		<?php
	}
	?>
</div> <!-- CONTENT END -->
<div id="context">
	<?php require VIEWS_PATH . 'Layouts/elements/front_latest_news.php'; ?>
</div> <!-- CONTEXT END -->
