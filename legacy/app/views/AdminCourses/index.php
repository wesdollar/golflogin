<?php
if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminCourses']['heading']; ?></h3>
	
		<?php
		if (isset($tpl['arr']))
		{
			if (is_array($tpl['arr']))
			{
				$count = count($tpl['arr']);
				if ($count > 0)
				{
					?>
					<table class="middle_table">
						<thead>
							<tr>
								<th><?php echo $GTM_LANG['AdminCourses']['course_title']; ?></th>
								<th><?php echo $GTM_LANG['AdminCourses']['tee_box']; ?></th>
								<th style="width: 100px;"><?php echo $GTM_LANG['AdminCourses']['usga_rating']; ?></th>
								<th style="width: 100px;"><?php echo $GTM_LANG['AdminCourses']['slop_rating']; ?></th>
								<th style="width: 65px"></th>
                                <th style="width: 65px"></th>
							</tr>
						</thead>
						<tbody>
					<?php
					for ($i = 0; $i < $count; $i++)
					{
						?>
						<tr>
							<td><?php echo readFromDb($tpl['arr'][$i]['course_title']); ?></td>
							<td><?php echo readFromDb($tpl['arr'][$i]['tee_box']); ?></td>
							<td><?php echo readFromDb($tpl['arr'][$i]['usga_rating']); ?></td>
							<td><?php echo readFromDb($tpl['arr'][$i]['slop_rating']); ?></td>
							<td><a class="icon icon_edit" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminCourses&amp;action=update&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo $GTM_LANG['_edit']; ?></a></td>
                            <td><a class="icon icon_delete" href="#" onclick="var q = confirm('<?php echo htmlspecialchars($GTM_LANG['_sure']); ?>'); if (q) { window.location = '<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminCourses&amp;action=delete&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>';}"><?php echo $GTM_LANG['_delete']; ?></a></td>
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
		<ul class="paginator">
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
		</ul>
		<?php
	}
}