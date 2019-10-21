<?php
require_once HELPERS_PATH . 'time.widget.php';

function getId($data, $sep = '-') {
    if (!empty($data)) {
        return $data['id'].$sep.$data['round_id'].$sep.$data['hole_id'];
    }

    return false;
}

if (!empty($tpl['error'])) {
    ?>
    <p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($tpl['error'])]; ?></p>
<?php
} else {
    ?>
    <div class="box">

        <!-- begin pasted form Rounds/create.php -->

        <p style="margin: 20px 0 10px 15px; font-weight: bold; font-size: 14px;">Please select round type to begin:</p>

        <form id="frmCreateRound" name="frmCreateRound" class="frm frmSave contMessage" method="post" enctype="multipart/form-data">
            <input type="hidden" name="round_create" value="1" />
            <input type="hidden" name="admin" value="1" />

            <ul class="listHole">
                <?php
                $counter = 1;
                foreach ($GTM_LANG['Rounds']['create']['round_types'] as $key => $val) {
                    ?>
                    <li><label class="radioLabelClass"><?php echo $val; ?> <input type="radio" name="type" value="<?php echo $key; ?>" <?php /*echo $counter == 1 ? 'checked="checked"' : null;*/ ?> class ="styleRadio radioClass" /></label></li>
                    <?php
                    $counter++;
                }
                ?>
            </ul>

            <div id="roundBasics">

                <p>
                    <label for="player_id">Player:</label>
                    <?php
                    if (count($tpl['courses']) > 0) {
                        ?>
                        <select name="player_id" id="player_id" class="sw300 required">
                            <option value=""><?php echo $GTM_LANG['_choose']; ?></option>
                            <?php
                            foreach ($tpl['players'] as $player) {
                                ?>
                                <option value="<?php echo $player['id']; ?>"><?= $player['name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php
                    } else {
                        echo anchor('Courses/create/', $GTM_LANG['Rounds']['create']['courses_not_found'], array('class' => 'lineHeight32'));
                    }
                    ?>
                </p>

                <p>
                    <label for="course_id"><?php echo $GTM_LANG['Rounds']['create']['course']; ?>:</label>
                    <?php
                    if (count($tpl['courses']) > 0) {
                        ?>
                        <select name="course_id" id="course_id" class="sw300 required">
                            <option value=""><?php echo $GTM_LANG['_choose']; ?></option>
                            <?php
                            foreach ($tpl['courses'] as $course) {
                                ?>
                                <option value="<?php echo $course['id']; ?>"><?php echo readFromDb($course['course_title']); ?> - <?php echo readFromDb($course['tee_box']); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php
                    } else {
                        echo anchor('Courses/create/', $GTM_LANG['Rounds']['create']['courses_not_found'], array('class' => 'lineHeight32'));
                    }
                    ?>
                </p>

                <p>
                    <label for="is_tournament"><?php echo $GTM_LANG['Rounds']['create']['is_tournament']; ?>:</label>
                    <select name="is_tournament" id="is_tournament" class="sw64">
                        <?php
                        foreach ($GTM_LANG['_yesno'] as $key => $val) {
                            ?>
                            <option value="<?php echo $key; ?>" <?php echo $key == 'F' ? 'selected="selected"' : null; ?>><?php echo $val; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </p>

                <p>
                    <label><?php echo $GTM_LANG['Rounds']['create']['date_played']; ?>:</label>
                    <?php
                    monthWidget(intval(@$_REQUEST['date_played_month']), 'M.', 'date_played_month', 'date_played_month', 'sw64', array('value' => '', 'title' => $GTM_LANG['_choose_1']));
                    echo '<span class="dateSeparator">/</span>';
                    dayWidget(intval(@$_REQUEST['date_played_day']), 'date_played_day', 'date_played_day', 'sw64', array('value' => '', 'title' => $GTM_LANG['_choose_1']));
                    echo '<span class="dateSeparator">/</span>';
                    yearWidget(intval(@$_REQUEST['date_played_year']), 100, 0, 'date_played_year', 'date_played_year', 'sw64', array('value' => '', 'title' => $GTM_LANG['_choose_1']), true);
                    ?>
                </p>

            </div>

            <div id="courseCard"></div>
        </form>

        <!-- // pasted form Rounds/create.php -->

    </div>

    <?php
}