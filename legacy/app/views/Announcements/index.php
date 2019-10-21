<div class="contAddB">
	<div class="contAddC">
		<h3><img src="<?= WEB_URL; ?>img/h3_announcements.gif" alt="" width="120" height="13" /></h3>
		<div class="contAnnouncements">
			<?php
			$counter = 0;
			foreach ($tpl['categories'] as $cat) {
				?>		
				<div class="boxAnnB">
					<div class="boxAnnT">
						<h4><?php echo readFromDb($cat['ann_category_title']); ?></h4>
						<p><?php echo strip_tags($cat['ann_category_description']); ?></p> <?php echo anchor('Announcements/category/' . intval($cat['id']), $GTM_LANG['Announcement']['index']['view_all'], array('title' => $GTM_LANG['Announcement']['index']['view_all'])); ?>
					</div>
				</div>
				<?php
				$counter++;

				if ($counter%3 == 0) {
					?>
					<div class="clear"></div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
