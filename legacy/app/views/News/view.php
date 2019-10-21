<div class="contAddB">
	<div class="contAddC">
		<h3><img src="<?= WEB_URL; ?>img/h3_new.gif" alt="News" /></h3>
		<?php
		if ($tpl['news']) {
			?>
			<div class="contRead">
				<div class="infoDate"><div><span class="date"><?php echo date('d', strtotime($tpl['news']['date_added'])); ?></span><span><?php echo date('F', strtotime($tpl['news']['date_added'])); ?></span></div></div>
				<?php
				if (!empty($tpl['news']['news_image']) && is_file(NEWS_IMAGE_PATH . $tpl['news']['news_image'])) {
					?>
					<img src="<?= WEB_URL; ?>uploads/news/<?php echo readFromDb($tpl['news']['news_image']); ?>" alt="<?php echo htmlspecialchars($tpl['news']['news_title']); ?>" class="floatR marT42" />
					<?php
				}
				?>
				<h4><?php echo readFromDb($tpl['news']['news_title']); ?></h4>
				
				<?php echo $tpl['news']['news_body']; ?>
			</div>
			<?php
		} else {
			?>
			<p class="notFound"><strong><?php echo $GTM_LANG['News']['view']['empty_result']; ?></strong></p>
			<?php
		}
		?>
	</div>
</div>