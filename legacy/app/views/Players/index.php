<div id="content">
	<div class="box1C contPlayB01">
		<div class="contPlayC">
			<table width="713" border="0" cellpadding="0" cellspacing="0">
				<tr><th><img src="<?= WEB_URL; ?>img/h3_player.gif" alt="" width="65" height="15" /></th></tr>
			</table>
			
			<table width="702" border="0" cellpadding="0" cellspacing="0" class="marRL5">
				<tr class="bgdGray01">
					<td valign="top" width="35" class="alignCenter"><strong><?php echo $GTM_LANG['ranking']['number']; ?></strong></td>
					<td valign="top" class="last"><strong><?php echo $GTM_LANG['ranking']['player']; ?></strong></td>
				</tr>
				
				<?php
				if (!empty($tpl['players']) && count($tpl['players']) > 0) {
					$counter = 1;
					foreach ($tpl['players'] as $player) {
						?>
						<tr class="<?php echo $counter%2 == 0 ? 'bgdGray' : 'bgdBlack'; ?>">
							<td valign="top" class="<?php echo $counter == count($tpl['players']) ? 'borNone' : null; ?> alignCenter"><?php echo $counter; ?></td>
							<td valign="top" class="<?php echo $counter == count($tpl['players']) ? 'borNone ' : null; ?> last">
								<?php
								echo anchor('Players/view/'.$player['id'], readFromDb($player['name']));
								?>
							</td>
						</tr>
						<?php
						$counter ++;
					}
				} else {
					?>
					<tr class="<?php echo $i%2 == 0 ? 'bgdBlack' : 'bgdGray'; ?>">
						<td valign="top" class="borNone last" colspan="2"><?php echo $GTM_LANG['Players']['index']['empty_result']; ?></td>
					</tr>
					<?php
				}
				?>
				
			</table>
		</div>
	</div>
</div> <!-- CONTENT END -->
<div id="context">
	<?php require VIEWS_PATH . 'Layouts/elements/front_latest_news.php'; ?>
</div> <!-- CONTEXT END -->