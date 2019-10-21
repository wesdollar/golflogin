<div class="contAddB">
	<div class="contAddC">
		<h3><img src="<?= WEB_URL; ?>img/h3_new.gif" alt="" width="40" height="13" /></h3>
		<?php
		if (count($tpl['news']) > 0) {
			?>
			<div class="contNews">
				<?php
				foreach ($tpl['news'] as $news) {
					?>
					<dl>
						<dt><div class="infoDate"><div><span class="date"><?php echo date('d', strtotime($news['date_added'])); ?></span><span><?php echo date('F', strtotime($news['date_added'])); ?></span></div></div></dt>
						<dd>
							<h4><?php echo anchor('News/view/' . $news['id'], readFromDb($news['news_title']), array('title' => htmlspecialchars($news['news_title']))); ?></h4>
							<p><?php echo mb_substr(strip_tags($news['news_body']), 0, 130); ?>... <?php echo anchor('News/view/' . intval($news['id']), $GTM_LANG['Front']['index']['read_more'], array('title' => htmlspecialchars($news['news_title']))); ?>
						</dd>
					</dl>
					<?php
				}
				?>
			</div>
			<?php
		} else {
			?>
			<p class="notFound"><strong><?php echo $GTM_LANG['News']['index']['empty_result']; ?></strong></p>
			<?php
		}
		?>
	</div>
</div>