<?php
require_once HELPERS_PATH . 'array.widget.php';

if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="form" style="margin-bottom: 4px;">
		<input type="hidden" name="controller" value="AdminAnnouncements" />
		<input type="hidden" name="action" value="indexCategories" />
		<input type="hidden" name="page" value="1" />
		
		<input type="text" name="q" value="<?php echo !empty($_REQUEST['q']) ? $_REQUEST['q'] : null; ?>" />
		<input type="submit" value="<?php echo $GTM_LANG['_filter']; ?>" class="button1" />
	</form>
	
	<div class="box">
		<h3><?php echo $GTM_LANG['AdminAnnouncements']['heading_categories']; ?></h3>
	
	<?php
	if (isset($tpl['arr']))
	{
		if (is_array($tpl['arr']))
		{
			$count = count($tpl['arr']);
			if ($count > 0)
			{
				?>
				<form action="#" method="post" class="ajax-update-table">
					<table class="middle_table">
						<thead>
							<tr>
								<th><?php echo $GTM_LANG['AdminAnnouncements']['c_title']; ?></th>
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
							<td><span class="editable"><?php echo readFromDb($tpl['arr'][$i]['ann_category_title']); ?></span></td>
							<td><a class="icon icon_edit" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminAnnouncements&amp;action=updateCategory&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo $GTM_LANG['_edit']; ?></a></td>
							<td><a class="icon icon_delete" href="#" onclick="var q = confirm('<?php echo htmlspecialchars($GTM_LANG['_sure']); ?>'); if (q) { window.location = '<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminAnnouncements&amp;action=deleteCategory&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>';}"><?php echo $GTM_LANG['_delete']; ?></a></td>
						</tr>
						<?php
					}
					?>
						</tbody>
					</table>
				</form>
				<?php
			} else {
				echo $GTM_LANG['Admin']['messages'][14];
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
				?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=indexCategories&amp;q=<?php echo @$_REQUEST['q']; ?>&amp;page=<?php echo $i; ?>" class="focus"><?php echo $i; ?></a></li><?php
			} else {
				?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=indexCategories&amp;q=<?php echo @$_REQUEST['q']; ?>&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
			}
		}
		?>
		</ul>
		<?php
	}
}
?>