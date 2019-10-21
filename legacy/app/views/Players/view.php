<div id="content">
	<div class="contPlayB">
		<div class="contPlayC">
			<h3><img src="<?= WEB_URL; ?>img/h3_play_name_full_bio.gif" alt="Player Full Bio" /></h3>
			<div class="innerPlay">
				<?php
				if (!empty($tpl['player']['image']) && is_file(PROFILE_IMAGES_PATH . $tpl['player']['image'])) {
					?>
					<img src="<?= SCHOOL_URL; ?>uploads/profile/<?php echo $tpl['player']['image']; ?>" alt="<?php echo readFromDb($tpl['player']['name']); ?>" width="200" class="floatR" />
					<?php	
				}
				?>
				
				<div class="infoProfile">
					<dl>
						<dd><?php echo readFromDb($tpl['player']['name']); ?></dd>
						<dt>Name</dt>
					</dl>
					<dl>
						<dd><?php echo date('F d, Y', strtotime($tpl['player']['birth'])); ?></dd>
						<dt>Date of Birth</dt>
					</dl>
					<dl>
						<dd><?php echo readFromDb($tpl['player']['town']); ?></dd>
						<dt>Hometown</dt>
					</dl>
					<dl>
						<dd><?php echo $GTM_LANG['classification'][$tpl['player']['classification']]; ?></dd>
						<dt>Classification</dt>
					</dl>
					<dl>
						<dd><?php echo readFromDb($tpl['player']['handicap_index']); ?></dd>
						<dt>Estimated USGA Handicap</dt>
					</dl>
				</div>
				
				<div class="clear"></div>
				
				<div style="width: 250px;margin: 50px auto 0;">
					<div class="controlIcon"><?php echo imga('Players/stats/' . $tpl['player']['id'], 'stats.png', $GTM_LANG['Players']['view']['view_stats']); ?><br /><?php echo anchor('Players/stats/' . $tpl['player']['id'], $GTM_LANG['Players']['view']['view_stats']); ?></div>
					<div class="controlIcon"><?php echo imga('Players/viewRounds/' . $tpl['player']['id'], 'archive.png', $GTM_LANG['Players']['view']['view_rounds']); ?><br /><?php echo anchor('Players/viewRounds/' . $tpl['player']['id'], $GTM_LANG['Players']['view']['view_rounds']); ?></div>
				</div>
			</div>
		</div>
	</div>
	
	<?php
	if (!empty($tpl['player_latest']) && count($tpl['player_latest']) > 0) {
		?>
		<br/>
		<div class="contPlayB">
			<div class="contPlayC">
				<h3><img src="<?= WEB_URL; ?>img/h3_latest_rounds.gif" alt="Player Latest Rounds Played" /></h3>
				
				<table cellpadding="0" cellspacing="0" class="dataTable">
					<tr>
						<th width="70"><?php echo $GTM_LANG['Players']['view']['date_played']; ?></th>
						<th><?php echo $GTM_LANG['Players']['view']['course_played']; ?></th>
						<th class="noRBorder alignCenter" width="75"><?php echo $GTM_LANG['Players']['view']['score']; ?></th>
					</tr>
					<?php
					$counter = 1;
					foreach ($tpl['player_latest'] as $round) {
						?>
						<tr class="<?php echo $counter%2 ? 'even' : 'odd'; ?><?php echo $counter == count($tpl['player_latest']) ? ' noBBorder': null; ?>">
							<td><?php echo date('m-d-Y', strtotime($round['date_played'])); ?></td>
							<td>
								<a href="Rounds/viewCard/<?php echo $round['id']; ?>" title="View Score Card"><?php echo $round['course_title']; ?> - <?php echo $round['tee_box']; ?></a>
								<?php
								if ($tpl['owner_flag'] === true) {
									?>
									<a href="Rounds/update/<?php echo $round['id']; ?>" title="Edit Score Card" class="scorecard-controls"><?php echo $GTM_LANG['Players']['view']['_edit']; ?></a> <a href="Rounds/delete/<?php echo $round['id']; ?>" title="Delete Score Card" class="scorecard-controls">[Delete]</a>
									<?php
								}
								?>
							</td>
							<td class="noRBorder alignCenter"><?php echo $round['score']; ?></td>
						</tr>
						<?php
						$counter ++;
					}
					?>
				</table>
			</div>
		</div>
		<?php
	}
	?>
</div> <!-- CONTENT END -->
<div id="context">
	<?php require VIEWS_PATH . 'Layouts/elements/front_latest_news.php'; ?>
</div> <!-- CONTEXT END -->
