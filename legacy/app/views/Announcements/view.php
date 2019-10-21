<div class="contAddB">
	<div class="contAddC">
		<h3><img src="<?= WEB_URL; ?>img/h3_announcements.gif" alt="Announcements" /></h3>
		<?php
		if ($tpl['announcement']) {
			?>
			<div class="contRead">
				<?php
				if (!empty($tpl['announcement']['ann_image']) && is_file(ANNOUNCEMENTS_IMAGE_PATH . $tpl['announcement']['ann_image'])) {
					?>
					<img src="<?= SCHOOL_URL; ?>uploads/announcements/<?php echo readFromDb($tpl['announcement']['ann_image']); ?>" alt="<?php echo htmlspecialchars($tpl['announcement']['ann_title']); ?>" class="floatR" />
					<?php
				}
				?>
				<h4><?php echo readFromDb($tpl['announcement']['ann_title']); ?><span><?php echo date('F d, Y', strtotime($tpl['announcement']['date_added'])); ?></span></h4>
				
				<?php echo $tpl['announcement']['ann_body']; ?>
			</div>
			<?php
		} else {
			?>
			<p class="notFound"><strong><?php echo $GTM_LANG['Announcement']['view']['empty_result']; ?></strong></p>
			<?php
		}
		?>
	</div>
</div>
