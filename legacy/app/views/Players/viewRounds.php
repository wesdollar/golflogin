<div id="content">
	<?php
    // echo readFromDb($tpl['player']['name']);
	if (!empty($tpl['player'])) {
		?>
        <h3 class="roundsHeader"><span>Scorecard Archive</span><?= anchor('Players/view/'.$tpl['player']['id'], readFromDb($tpl['player']['name'])); ?></h3>
		<?php
	}
	
	?>
	<br/>
	<div class="contPlayB">
		<div class="contPlayC viewRounds">
			<h3><img src="<?= WEB_URL; ?>img/h3_round_filter.gif" alt="Round Filters" /></h3>
			
			
			<form id="frmCreateCourse" name="frmCreateCourse" class="frm frmSave contMessage" method="get" action="Players/viewRounds/<?php echo $tpl['player']['id']; ?>/<?php echo $_GET['page']; ?>/" enctype="multipart/form-data">

                <div class="span4">
                    <label for="date_from" class="dateLabel"><?php echo $GTM_LANG['Players']['view']['date_from']; ?></label>
                    <input type="text" readonly="readonly" name="date_from" id="date_from" value="<?php echo @$_REQUEST['date_from']; ?>" class="iw75 datepicker" size="10" />
                </div>
                <div class="span4">
                    <label for="date_to" class="dateLabel"><?php echo $GTM_LANG['Players']['view']['date_to']; ?></label>
                    <input type="text" readonly="readonly" name="date_to" id="date_to" value="<?php echo @$_REQUEST['date_to']; ?>" class="iw75 datepicker" size="10" />
                </div>
                <div class="span2">
                    <p class="btnSearch"><input type="submit" value="" />&nbsp;<input type="button" value="" onclick="window.location.href='Players/viewRounds/<?php echo $tpl['player']['id']; ?>'"/></p>
                </div>


				<!--<p>
					<label for="date_from" style="width: 75px"><?php /*echo $GTM_LANG['Players']['view']['date_from']; */?></label>
					<input type="text" readonly="readonly" name="date_from" id="date_from" value="<?php /*echo @$_REQUEST['date_from']; */?>" class="iw75 datepicker" size="10" />
				</p>

				<p>
					<label for="date_to" style="width: 75px"><?php /*echo $GTM_LANG['Players']['view']['date_to']; */?></label>
					<input type="text" readonly="readonly" name="date_to" id="date_to" value="<?php /*echo @$_REQUEST['date_to']; */?>" class="iw75 datepicker" size="10" />
				</p>

				<p class="btnSearch"><input type="submit" value="" />&nbsp;<input type="button" value="" onclick="window.location.href='Players/viewRounds/<?php /*echo $tpl['player']['id']; */?>'"/></p>-->
			</form>



            <div class="clear"></div>
		</div>
	</div>
	<?php
	
	if (!empty($tpl['player_latest']) && count($tpl['player_latest']) > 0) {
		?>
		<br/>
		
		<div class="contPlayB">
			<div class="contPlayC">
				<h3><img src="<?= WEB_URL; ?>img/h3_rounds.gif" alt="Player Rounds Played" /></h3>
				
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
									<a href="Rounds/update/<?php echo $round['id']; ?>" title="Edit Score Card" class="scorecard-controls"><?php echo $GTM_LANG['Players']['view']['_edit']; ?></a>
									<a href="Rounds/delete/<?php echo $round['id']; ?>" title="Delete Score Card" class="scorecard-controls">[Delete]</a>
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
		if (isset($tpl['paginator']) && $tpl['paginator']['pages'] > 1)
		{
			?>
			<div class="paginator">
				<?php
				for ($i = 1; $i <= $tpl['paginator']['pages']; $i++)
				{
					if (isset($_GET['page']) && $_GET['page'] == $i)
					{
						?><strong><?php echo $i; ?></strong><?php
					} else {
						?><a href="Players/viewRounds/<?php echo $tpl['player']['id']; ?>/<?php echo $i; ?>"><?php echo $i; ?></a><?php
					}
				}
				?>
			</div>
			<?php
		}
	} else {
		?>
		<br/>
		<div class="contPlayB">
			<div class="contPlayC">
				<h3><img src="<?= WEB_URL; ?>img/h3_rounds.gif" alt="Player Rounds Played" /></h3>
				<p style="padding: 10px;"><?php echo $GTM_LANG['Players']['view']['no_rounds_found']; ?></p>
			</div>
		</div>
		<?php
	}
	?>
	
	<script type="text/javascript">
	$(function(){
		$( ".datepicker" ).datepicker({ dateFormat: 'mm/dd/yy' });
	});
	</script>
</div> <!-- CONTENT END -->
<div id="context">
	<?php require VIEWS_PATH . 'Layouts/elements/front_latest_news.php'; ?>
</div> <!-- CONTEXT END -->
