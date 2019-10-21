<?php
if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="form" style="margin-bottom: 4px;">
		<input type="hidden" name="controller" value="AdminUsers" />
		<input type="hidden" name="action" value="index" />
		<select name="role_id" id="role_id" class="sw100">
			<option value=""><?php echo $GTM_LANG['_choose']; ?></option>
			<?php
			foreach ($tpl['role_arr'] as $v)
			{
				if (isset($_GET['role_id']) && $_GET['role_id'] == $v['id'])
				{
					?><option value="<?php echo $v['id']; ?>" selected="selected"><?php echo stripslashes($v['role']); ?></option><?php
				} else {
					?><option value="<?php echo $v['id']; ?>"><?php echo stripslashes($v['role']); ?></option><?php
				}
			}
			?>
		</select>
		<input type="hidden" name="page" value="1" />
		<input type="submit" value="<?php echo $GTM_LANG['_filter']; ?>" class="button1" />
	</form>
	
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminPlayers']['heading']; ?></h3>
	
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
							<th><?php echo $GTM_LANG['AdminUsers']['username']; ?></th>
							<th><?php echo $GTM_LANG['AdminUsers']['name']; ?></th>
							<th><?php echo $GTM_LANG['AdminUsers']['email']; ?></th>
							<th style="width: 100px"><?php echo $GTM_LANG['AdminUsers']['role']; ?></th>
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
						<td><?php echo readFromDb($tpl['arr'][$i]['username']); ?></td>
						<td><?php echo readFromDb($tpl['arr'][$i]['name']); ?></td>
						<td><?php echo readFromDb($tpl['arr'][$i]['email']); ?></td>
						<td><span class="role_<?php echo $tpl['arr'][$i]['role_id']; ?>"><?php echo $tpl['arr'][$i]['role']; ?></span></td>
						<td><a class="icon icon_edit" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&amp;action=update&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo $GTM_LANG['_edit']; ?></a></td>
						<td><a class="icon icon_delete" href="#" onclick="var q = confirm('<?php echo htmlspecialchars($GTM_LANG['_sure']); ?>'); if (q) { window.location = '<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&amp;action=delete&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>';}"><?php echo $GTM_LANG['_delete']; ?></a></td>
					</tr>
					<?php
				}
				?>
					</tbody>
				</table>
				<?php
			} else {
				echo $GTM_LANG['Admin']['messages'][8];
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
				?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;role_id=<?php echo @$_GET['role_id']; ?>&amp;page=<?php echo $i; ?>" class="focus"><?php echo $i; ?></a></li><?php
			} else {
				?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;role_id=<?php echo @$_GET['role_id']; ?>&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
			}
		}
		?>
		</ul>
		<?php
	}
}
?>