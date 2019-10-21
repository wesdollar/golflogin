<?php
require_once HELPERS_PATH . 'array.widget.php';

if (!empty($tpl['error'])) {
    ?>
    <p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
<?php
    } else {
    ?>
	<div class="box">
		<h3>Posted Rounds <span style="float:right;">Total Rounds: <?= $tpl['totalCount']; ?></span></h3>

        <!--<pre>
            <?php /*print_r($tpl['arr']); */?>
        </pre>-->
	
		<?php
		if (isset($tpl['arr']))
		{
			if (is_array($tpl['arr']))
			{
				$count = count($tpl['arr']);
				if ($count > 0)
				{
					?>
					<table class="middle_table rounds-tbl">
						<thead>
							<tr>
								<th style="width: 75px;">Date</th>
								<th style="width: ">Player</th>
								<th style="width: 245px;">Course</th>
								<th style="width: 50px;">Score</th>
								<th style="width: 65px"><!-- edit --></th>
                                <th style="width: 65px"><!-- delete --></th>
							</tr>
						</thead>
						<tbody>
					<?php
					for ($i = 0; $i < $count; $i++)
					{
						?>
						<tr>
							<td><?php echo readFromDb($tpl['arr'][$i]['date_played']); ?></td>
							<td><?php echo readFromDb($tpl['arr'][$i]['name']); ?></td>
							<td><?php echo readFromDb($tpl['arr'][$i]['course_title']); ?></td>
							<td><?php echo readFromDb($tpl['arr'][$i]['score']); ?></td>
							<td><a class="icon icon_edit" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRounds&amp;action=update&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo $GTM_LANG['_edit']; ?></a></td>
                            <td><a class="icon icon_delete" href="#" onclick="var q = confirm('<?php echo htmlspecialchars($GTM_LANG['_sure']); ?>'); if (q) { window.location = '<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRounds&amp;action=delete&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>&amp;player_id=<?php echo $tpl['arr'][$i]['user_id'] ?>';}"><?php echo $GTM_LANG['_delete']; ?></a></td>
						</tr>
						<?php
					}
					?>
						</tbody>
					</table>
					<?php
				} else {
					echo $GTM_LANG['Admin']['messages'][30];
				}
			}
		}
		
		?>
	</div>

	<?php
	if (isset($tpl['paginator']))
	{
		?>
		<p><ul class="paginator">
		<?php
		for ($i = 1; $i <= $tpl['paginator']['pages']; $i++)
		{
			if (isset($_GET['page']) && $_GET['page'] == $i)
			{
				?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;q=<?php echo @$_REQUEST['q']; ?>&amp;page=<?php echo $i; ?>" class="focus"><?php echo $i; ?></a></li><?php
			} else {
				?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;q=<?php echo @$_REQUEST['q']; ?>&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
			}
		}
		?>
		</ul></p>
		<?php
	}
}