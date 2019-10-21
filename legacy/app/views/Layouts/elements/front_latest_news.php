<div class="boxContextB">
	<div class="boxContextC">
		<h3><img src="<?= WEB_URL; ?>img/h3_last_news.gif" alt="" width="105" height="13" /></h3>

        <?php if($tpl['latest_rounds'] != NULL) : ?>
        <div class="contContext">
            <div class="slideshow">
                <div class="slidesContainer">
                    <?php
                    $counter = 1;
                    foreach ($tpl['latest_rounds'] as $news) {
                        $class = '';

                        if ($counter == count($tpl['latest_rounds'])) {
                            $class .= ' lastNews01';
                        }

                        ?>

                        <?php if ($counter != 1) : ?>
                            <div class="slide">
                                <div class="infoDate"><div><span class="date"><?php echo date('d', strtotime($news['date_added'])); ?></span><span><?php echo date('F', strtotime($news['date_added'])); ?></span></div></div>
                                <div class="clear"></div>
                                <h4><?php echo anchor('Players/view/' . intval($news['user_id']), readFromDb($news['name']), array('title' => htmlspecialchars($news['name']))); ?></h4>

                                <p><?php echo $news['course_title']; ?> - <?php echo $news['tee_box']; ?></p>

                                <p><?php echo $GTM_LANG['Front']['index']['score']; ?>: <strong><?php echo $news['score']; ?></strong></p>

                                <p><?php echo anchor('Rounds/viewCard/' . intval($news['id']), $GTM_LANG['Front']['index']['view_card']); ?></p>
                            </div>
                            <?php else: ?>

                    <div class="slide">
                        <div class="infoDate"><div><span class="date"><?php echo date('d', strtotime($news['date_added'])); ?></span><span><?php echo date('F', strtotime($news['date_added'])); ?></span></div></div>
                            <div class="clear"></div>
                            <h4><?php echo anchor('Players/view/' . intval($news['user_id']), readFromDb($news['name']), array('title' => htmlspecialchars($news['name']))); ?></h4>

                            <p><?php echo $news['course_title']; ?> - <?php echo $news['tee_box']; ?></p>

                            <p><?php echo $GTM_LANG['Front']['index']['score']; ?>: <strong><?php echo $news['score']; ?></strong></p>

                            <p><?php echo anchor('Rounds/viewCard/' . intval($news['id']), $GTM_LANG['Front']['index']['view_card']); ?></p>

                            <?php endif; ?>

                        <?php
                        $counter++;
                    }
                    ?>
                </div>
                    <div id="slideNav">
                        <div id="icon_previous">

                        </div>
                        <div id="icon_pause">

                        </div>
                        <div id="icon_next">

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
            <p style="margin: 10px 20px;;">No Rounds Available.</p>
        <?php endif; ?>

	</div>
</div>