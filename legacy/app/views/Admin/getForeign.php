<select name="foreign_id" id="foreign_id">
	<option value=""><?php echo $GTM_LANG['task_choose']; ?></option>
	<?php
	if (isset($tpl['arr']))
	{
		foreach ($tpl['arr'] as $v)
		{
			?><option value="<?php echo $v['id']; ?>"><?php echo stripslashes($v['campaign_title']); ?></option><?php
		}
	}
	?>
</select>