		<div class="box">
			<h3><?php echo $GTM_LANG['AdminCourses']['add_course']; ?></h3>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminCourses&amp;action=create" method="post" id="frmUpdateNews" class="form" enctype="multipart/form-data">
                <input type="hidden" name="course_create" value="1" />

                <p>
                    <label class="title" for="course_title">Course Title</label>
                    <input type="text" name="course_title" id="course_title" value="<?php echo @$_REQUEST['course_title']; ?>" class="w400 required" />
                </p>

                <p>
                    <label class="title" for="tee_box">Tee Box</label>
                    <input type="text" name="tee_box" id="tee_box" value="<?php echo @$_REQUEST['tee_box']; ?>" class="w400 required" />
                </p>

                <p>
                    <label class="title" for="usga_rating">USGA Rating</label>
                    <input type="text" name="usga_rating" id="usga_rating" value="<?php echo @$_REQUEST['usga_rating']; ?>" class="w100 required" />
                </p>

                <p>
                    <label class="title" for="slop_rating">Slope Rating</label>
                    <input type="text" name="slop_rating" id="slop_rating" value="<?php echo @$_REQUEST['slop_rating']; ?>" class="w100 required" />
                </p>

                <table cellpadding="0" cellspacing="0" class="courseCard">
                    <tr>
                        <th colspan="10" class="alignCenter">Front 9</th>
                    </tr>
                    <tr>
                        <th class="alignLeft">Hole</th>
                        <?php
                        foreach (range(1, 9) as $i) {
                            ?>
                            <th class="alignCenter"><?php echo $i; ?></th>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <th class="alignLeft">Par</th>
                        <?php
                        foreach (range(1, 9) as $i) {
                            ?>
                            <td><input type="text" name="par[<?php echo $i; ?>]" value="<?php echo @$_REQUEST['par'][$i]; ?>" class="w60" /></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <th class="alignLeft">Yardage</th>
                        <?php
                        foreach (range(1, 9) as $i) {
                            ?>
                            <td><input type="text" name="yardage[<?php echo $i; ?>]" value="<?php echo @$_REQUEST['yardage'][$i]; ?>" class="w60" /></td>
                            <?php
                        }
                        ?>
                    </tr>
                </table>

                <table cellpadding="0" cellspacing="0" class="courseCard">
                    <tr>
                        <th colspan="10" class="alignCenter">Back 9</th>
                    </tr>
                    <tr>
                        <th class="alignLeft">Hole</th>
                        <?php
                        foreach (range(10, 18) as $i) {
                            ?>
                            <th class="alignCenter"><?php echo $i; ?></th>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <th class="alignLeft">Par</th>
                        <?php
                        foreach (range(10, 18) as $i) {
                            ?>
                            <td><input type="text" name="par[<?php echo $i; ?>]" value="<?php echo @$_REQUEST['par'][$i]; ?>" class="w60" /></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <th class="alignLeft">Yardage</th>
                        <?php
                        foreach (range(10, 18) as $i) {
                            ?>
                            <td><input type="text" name="yardage[<?php echo $i; ?>]" value="<?php echo @$_REQUEST['yardage'][$i]; ?>" class="w60" /></td>
                            <?php
                        }
                        ?>
                    </tr>
                </table>
                <p>
                    <label class="title">&nbsp;</label>
                    <input type="submit" value="<?php echo $GTM_LANG['_save']; ?>" class="button1" />
                </p>
            </form>
		</div>