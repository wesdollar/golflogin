<?php
if (!empty($tpl['ranking']['ppg']) && $tpl['ranking']['ppg'] && is_array($tpl['ranking']['ppg'])) {
	?>
	<div class="box2B<?php echo $is_rankings ? ' marR8' : null; ?>">
		<div class="box2C">
			<table width="234" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<th><img src="<?= WEB_URL; ?>img/h3_box2_06.gif" alt="" width="128" height="13" /></th>
				</tr>
			</table>
			<table width="222" border="0" cellpadding="0" cellspacing="0" class="marRL5">
				<tr class="bgdBox201">
					<td valign="top" width="30"><strong><?php echo $GTM_LANG['ranking']['rank']; ?></strong></td>
					<td valign="top" width="99"><strong><?php echo $GTM_LANG['ranking']['player']; ?></strong></td>
					<td valign="top" width="45" class="last"><strong><?php echo $GTM_LANG['ranking']['avg_pts']; ?></strong></td>
				</tr>
				
				<?php
				$i = 1;
				$total_rows = count($tpl['ranking']['ppg']);
				
				foreach ($tpl['ranking']['ppg'] as $key => $val) {
					?>
					<tr class="<?php echo $i%2 == 0 ? 'bgdBox203' : 'bgdBox202'; ?>">
						<td valign="top" class="<?php echo $i == $total_rows ? 'borNone' : null; ?>"><?php echo $i; ?></td>
						<td valign="top" class="<?php echo $i == $total_rows ? 'borNone' : null; ?>"><a href="Players/stats/<?php echo $key;?>"><?php echo $val['name']; ?></a></td>
						<td valign="top" class="<?php echo $i == $total_rows ? 'borNone ' : null; ?>last"><?php echo $val['ppg']; ?></td>
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