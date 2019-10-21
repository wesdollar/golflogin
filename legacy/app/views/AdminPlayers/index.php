<?php
require_once HELPERS_PATH . 'array.widget.php';

if (!empty($tpl['error'])) {
	?>
	<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
	<?php
} else {
	?>
    <p style="margin-bottom: 12px;"><strong>Tip:</strong> Edit a player's info by clicking on the item you wish to edit or click edit to edit all of the player's details.</p>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="form" style="margin-bottom: 4px;">
		<input type="hidden" name="controller" value="AdminPlayers" />
		<input type="hidden" name="action" value="index" />
		<input type="hidden" name="page" value="1" />
		
		<input class="search-input" type="text" name="q" value="<?php echo !empty($_REQUEST['q']) ? $_REQUEST['q'] : null; ?>" />
		<input type="submit" value="Search" class="button1" />
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
				<table class="middle_table ajax-update-table w929">
					<thead>
						<tr>
							<th><?php echo $GTM_LANG['AdminPlayers']['name']; ?></th>
							<th><?php echo $GTM_LANG['AdminPlayers']['email']; ?></th>
							<th><?php echo $GTM_LANG['AdminPlayers']['phone']; ?></th>
							<th class="align-center"><?php echo $GTM_LANG['AdminPlayers']['shirt_size']; ?></th>
							<th><?php echo $GTM_LANG['AdminPlayers']['pant_size']; ?></th>
							<th class="align-center"><?php echo $GTM_LANG['AdminPlayers']['shoe_size']; ?></th>
							<th class="align-center"><?php echo $GTM_LANG['AdminPlayers']['glove_size']; ?></th>
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
								<td><span class="editable" id="name::<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo readFromDb($tpl['arr'][$i]['name']); ?></span></td>
								<td><span class="editable" id="email::<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo readFromDb($tpl['arr'][$i]['email']); ?></span></td>
								<td><span class="editable" id="phone::<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo readFromDb($tpl['arr'][$i]['phone']); ?></span></td>
								<td class="align-center"><span class="shirt-editable" id="shirt_size::<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo @$GTM_LANG['shirt_size'][readFromDb($tpl['arr'][$i]['shirt_size'])]; ?></span></td>
								<td class="pant-size"><?php echo $GTM_LANG['AdminPlayers']['pant_size_waist']; ?>: <span class="editable" id="pant_size_waist::<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo readFromDb($tpl['arr'][$i]['pant_size_waist']); ?></span> / <?php echo $GTM_LANG['AdminPlayers']['pant_size_length']; ?>: <span class="editable" id="pant_size_length::<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo readFromDb($tpl['arr'][$i]['pant_size_length']); ?></span></td>
								<td class="align-center shoe-size"><span class="editable" id="shoe_size::<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo readFromDb($tpl['arr'][$i]['shoe_size']); ?></span></td>
								<td class="align-center"><span class="glove-editable" id="glove_size::<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo @$GTM_LANG['glove_size'][readFromDb($tpl['arr'][$i]['glove_size'])]; ?></span></td>
								<td><a class="icon icon_edit" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminPlayers&amp;action=update&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo $GTM_LANG['_edit']; ?></a></td>
								<td><a class="icon icon_delete" href="#" onclick="var q = confirm('<?php echo htmlspecialchars($GTM_LANG['_sure']); ?>'); if (q) { window.location = '<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminPlayers&amp;action=delete&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>';}"><?php echo $GTM_LANG['_delete']; ?></a></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>

				<script type="text/javascript">
				$(function(){
					$('.editable').editable('<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminPlayers&action=inlineUpdate', {
						type      : 'text',
						cancel    : '&nbsp;',
						submit    : '&nbsp;',
					});

					$('.glove-editable').editable('<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminPlayers&action=inlineUpdate', {
					     data   : "{<?php echo arrayToJSONSimple($GTM_LANG['glove_size']); ?>, 'selected':'" + $("options:selected", $(this)).val() + "'}",
					     type   : 'select',
					     cancel    : '&nbsp;',
					     submit : '&nbsp;'
					 });

					$('.shirt-editable').editable('<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminPlayers&action=inlineUpdate', {
					     data   : "{<?php echo arrayToJSONSimple($GTM_LANG['shirt_size']); ?>, 'selected':'" + $("options:selected", $(this)).val() + "'}",
					     type   : 'select',
					     cancel    : '&nbsp;',
					     submit : '&nbsp;'
					 });
				});
				</script>
				
				<?php
			} else {
				echo $GTM_LANG['Admin']['messages'][4];
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
?>