<?php
if (!empty($tpl['ranking']['overall']) && $tpl['ranking']['overall'] && is_array($tpl['ranking']['overall'])) {
	?>
	<div class="box1B<?php echo $is_rankings ? ' marR11' : null; ?>">
		<div class="box1C">
			<table width="473" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<th colspan="3"><img src="<?= WEB_URL; ?>img/h3_overall.png" alt=""
						width="135" height="15" />
					</th>
				</tr>
			</table>
			<table width="465" border="0" cellpadding="0" cellspacing="0" class="marRL">
				<tr class="bgdGray01">
					<td valign="top" width="35"><strong><?php echo $GTM_LANG['ranking']['rank']; ?></strong></td>
					<td valign="top"><strong><?php echo $GTM_LANG['ranking']['player']; ?></strong></td>
					<td valign="top" width="40" class="last"><strong><?php echo $GTM_LANG['ranking']['score']; ?></strong></td>
				</tr>
				
				<?php
				$i = 1;
				$total_rows = count($tpl['ranking']['overall']);
				
				foreach ($tpl['ranking']['overall'] as $key => $val) {
					?>
					<tr class="<?php echo $i%2 == 0 ? 'bgdBlack' : 'bgdGray'; ?>">
						<td valign="top" class="<?php echo $i == $total_rows ? 'borNone' : null; ?>"><?php echo $i; ?></td>
						<td valign="top" class="<?php echo $i == $total_rows ? 'borNone' : null; ?>"><a href="Players/stats/<?php echo $key;?>"><?php echo $val['name']; ?></a></td>
						<td valign="top" class="<?php echo $i == $total_rows ? 'borNone ' : null; ?>last"><?php echo $val['overall']; ?></td>
					</tr>
					<?php
					$i ++;
				}
				?>
	
			</table>
		</div>
	</div>
	<?php
}
?>