<div class="boxContextB">
	<div class="boxContextC">
		<h3><img src="<?= WEB_URL; ?>img/h3_recent.gif" alt="" width="176" height="13" /></h3>
		<div class="contContext">
			<?php
			$counter = 1;
			foreach ($tpl['latest_ann'] as $ann) {
				$class = '';
				
				if ($counter == count($tpl['latest_ann'])) {
					$class .= 'last';
				}

				?>
				<dl class="<?php echo $class; ?>">
					<dd>
						<h4><?php echo anchor('Announcements/view/' . intval($ann['id']), readFromDb($ann['ann_title']), array('title' => htmlspecialchars($ann['ann_title']))); ?><span><?php echo date('F d, Y', strtotime($ann['date_added'])); ?></span></h4>
						<p><?php echo mb_substr(strip_tags($ann['ann_body']), 0, 80); ?>...</p>
						<p><?php echo anchor('Announcements/view/' . intval($ann['id']), $GTM_LANG['Front']['index']['read_more'], array('title' => htmlspecialchars($ann['ann_title']))); ?></p>
					</dd>
					<?php
					if (!empty($ann['ann_image']) && is_file(ANNOUNCEMENTS_IMAGE_PATH . '_thumbs/' . $ann['ann_image'])) {
						?>
						<dt>
							<a href="Announcements/view/<?php echo intval($ann['id']); ?>" title="<?php echo htmlspecialchars($ann['ann_title']); ?>">
								<img src="<?= SCHOOL_URL; ?>uploads/announcements/_thumbs/<?php echo readFromDb($ann['ann_image']); ?>" alt="<?php echo htmlspecialchars($ann['ann_title']); ?>" width="73" />
							</a>
						</dt>
						<?php
					}
					?>
				</dl>
				<?php
				$counter++;
			}
			?>
			<p><?php echo anchor('Announcements/', $GTM_LANG['Front']['index']['view_all_announcements']); ?></p>
		</div>
	</div>
</div>