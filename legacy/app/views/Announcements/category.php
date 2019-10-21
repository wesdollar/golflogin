<div class="contAddB">
	<div class="contAddC">
		<h3><img src="<?= WEB_URL; ?>img/h3_announcements.gif" alt="" width="120" height="13" /></h3>
		
		<div class="contViewAll">
			<?php
			if (count($tpl['announcements']) > 0) {
				$counter = 1;
				foreach ($tpl['announcements'] as $ann) {
					if ($counter == 1) {
						?>
						<div class="innerAnn">
						<?php
					}
					?>
					<dl>
						<dd>
							<h4><?php echo anchor('Announcements/view/' . intval($ann['id']), readFromDb($ann['ann_title']), array('title' => htmlspecialchars($ann['ann_title']))); ?><span><?php echo date('F d, Y', strtotime($ann['date_added'])); ?></span></h4>
							<p><?php echo mb_substr(strip_tags($ann['ann_body']), 0, 160); ?>...</p>
							<p><?php echo anchor('Announcements/view/' . intval($ann['id']), $GTM_LANG['Front']['index']['read_more'], array('title' => htmlspecialchars($ann['ann_title']))); ?></p>
						</dd>
						<?php
						if (!empty($ann['ann_image']) && is_file(ANNOUNCEMENTS_IMAGE_PATH . '_thumbs/' . $ann['ann_image'])) {
							?>
							<dt>
								<a href="Announcements/view/<?php echo intval($ann['id']); ?>" title="<?php echo htmlspecialchars($ann['ann_title']); ?>">
									<img src="<?= WEB_URL; ?>uploads/announcements/_thumbs/<?php echo readFromDb($ann['ann_image']); ?>" alt="<?php echo htmlspecialchars($ann['ann_title']); ?>" width="73" />
								</a>
							</dt>
							<?php
						}
						?>
					</dl>
					<?php
					$counter ++;
					
					if ($counter > 2) {
						$counter = 1;
						?>
						</div>
						<?php
					}
				}
			} else {
				?>
				<p class="notFound"><strong><?php echo $GTM_LANG['Announcement']['index']['empty_result']; ?></strong></p>
				<?php
			}
			?>
		</div>
	</div>
</div>
