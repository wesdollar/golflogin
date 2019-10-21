<?php

$link = @mysqli_connect(DEFAULT_HOST, DEFAULT_USER, DEFAULT_PASS, DEFAULT_DB);
if (!$link) {
    die('Could not connect: ' . mysqli_error($link));
}

# PAGE TITLES
// get title from db
    $sql = "SELECT pageTitle FROM gtm_settings LIMIT 1";
    $result = mysqli_query($link, $sql)
        or die('Query Failed. Contact Golf Login support.');
    $row = mysqli_fetch_assoc($result);
    $title = $row['pageTitle'];
$GTM_LANG['Front']['PageTitle']['default'] = 'Golf Login: ' . $title;

# SYSTEM MESSAGES
$GTM_LANG['Front']['messages']['login_successful']  = 'You are successfully logged in.';
$GTM_LANG['Front']['messages']['profile_update_success']  = 'Your profile was successfully updated.';
$GTM_LANG['Front']['messages']['profile_image_delete_success']  = 'Your profile image was deleted.';
$GTM_LANG['Front']['messages']['course_created_success']  = 'New course added successfully.';
$GTM_LANG['Front']['messages']['round_created_success']  = 'New round added successfully.';
$GTM_LANG['Front']['messages']['round_update_success']  = 'Round was successfully updated.';
$GTM_LANG['Front']['messages']['round_delete_success']  = 'Round was successfully deleted.';
$GTM_LANG['Front']['messages']['round_update_success_error'] = 'was successfully updated but unable to update the users stats.';
$GTM_LANG['Front']['messages'][11] = '';
$GTM_LANG['Front']['messages'][12] = '';
$GTM_LANG['Front']['messages'][13] = '';
$GTM_LANG['Front']['messages'][14] = '';
$GTM_LANG['Front']['messages'][15] = '';
$GTM_LANG['Front']['messages'][16] = '';
$GTM_LANG['Front']['messages'][17] = '';
$GTM_LANG['Front']['messages'][18] = '';
$GTM_LANG['Front']['messages'][19] = '';
$GTM_LANG['Front']['messages'][20] = '';
$GTM_LANG['Front']['messages'][21] = '';
$GTM_LANG['Front']['messages'][22] = '';
$GTM_LANG['Front']['messages'][23] = '';
$GTM_LANG['Front']['messages'][24] = '';
$GTM_LANG['Front']['messages'][25] = '';
$GTM_LANG['Front']['messages']['round_no_access'] = 'You are not allowed to delete this round.';

$GTM_LANG['Front']['errors']['not_logged_in']  = 'You need to login first.';
$GTM_LANG['Front']['errors']['login_failed']  = 'Wrong username and/or password.';
$GTM_LANG['Front']['errors']['login_denied']  = 'Login failed. Please try again with valid credentials.';
$GTM_LANG['Front']['errors']['login_forbidden']  = 'Login forbidden.';
$GTM_LANG['Front']['errors']['profile_update_upload_error']  = 'Your profile was successfully updated but the image was not uploaded because of error.';
$GTM_LANG['Front']['errors']['profile_image_delete_error']  = 'Unable to delete your profile image.';
$GTM_LANG['Front']['errors'][7]  = '';
$GTM_LANG['Front']['errors'][8]  = '';
$GTM_LANG['Front']['errors'][9]  = '';
$GTM_LANG['Front']['errors'][10] = '';
$GTM_LANG['Front']['errors'][11] = '';
$GTM_LANG['Front']['errors'][12] = '';
$GTM_LANG['Front']['errors'][13] = '';
$GTM_LANG['Front']['errors'][14] = '';
$GTM_LANG['Front']['errors'][15] = '';
$GTM_LANG['Front']['errors'][16] = '';
$GTM_LANG['Front']['errors'][17] = '';
$GTM_LANG['Front']['errors'][18] = '';
$GTM_LANG['Front']['errors'][19] = '';
$GTM_LANG['Front']['errors'][20] = '';
$GTM_LANG['Front']['errors'][21] = '';
$GTM_LANG['Front']['errors'][22] = '';
$GTM_LANG['Front']['errors'][23] = '';
$GTM_LANG['Front']['errors'][24] = '';
$GTM_LANG['Front']['errors'][25] = '';

$GTM_LANG['o_list'] = "Option list";
$GTM_LANG['o_key'] = "Option key";
$GTM_LANG['o_description'] = "Options";
$GTM_LANG['o_value'] = "Value";

$GTM_LANG['_yesno']['T'] = "Yes";
$GTM_LANG['_yesno']['F'] = "No";

$GTM_LANG['_onoff']['ON'] = "On";
$GTM_LANG['_onoff']['OFF'] = "Off";

$GTM_LANG['_switch'] = "Switch On/Off";
$GTM_LANG['_search'] = "Search";
$GTM_LANG['_filter'] = "Filter";
$GTM_LANG['_print']  = "Print";
$GTM_LANG['_save']   = "Save changes";
$GTM_LANG['_cancel'] = "Cancel";
$GTM_LANG['_upload'] = "Upload";
$GTM_LANG['_edit']   = "edit";
$GTM_LANG['_update']   = "update";
$GTM_LANG['_delete'] = "delete";
$GTM_LANG['_view']   = "view";
$GTM_LANG['_never']  = "never";
$GTM_LANG['_empty']  = "No records.";
$GTM_LANG['_sure']   = "Are you sure you want to delete selected record?";
$GTM_LANG['_up']     = "up";
$GTM_LANG['_down']   = "down";
$GTM_LANG['_inch']   = "inch";
$GTM_LANG['_inches'] = "inches";
$GTM_LANG['_export']  = "Export";
$GTM_LANG['_check_all'] = "Check All";
$GTM_LANG['_uncheck_all'] = "Uncheck All";
$GTM_LANG['_choose'] = "-- Choose --";
$GTM_LANG['_choose_1'] = "---";

# Shurt sizes - XS, S, M, L, XL, XXL
$GTM_LANG['shirt_size'][1] = 'XS';
$GTM_LANG['shirt_size'][2] = 'S';
$GTM_LANG['shirt_size'][3] = 'M';
$GTM_LANG['shirt_size'][4] = 'L';
$GTM_LANG['shirt_size'][5] = 'XL';
$GTM_LANG['shirt_size'][6] = 'XXL';

# Glove Sizes - S, M, M/L, L
$GTM_LANG['glove_size'][1] = 'S';
$GTM_LANG['glove_size'][2] = 'M';
$GTM_LANG['glove_size'][3] = 'M/L';
$GTM_LANG['glove_size'][4] = 'L';

# Dexterity
$GTM_LANG['dexterity']['R'] = 'R';
$GTM_LANG['dexterity']['L'] = 'L';

# Classification
$GTM_LANG['classification']['rs_freshman'] = 'RS Freshman';
$GTM_LANG['classification']['freshman'] = 'Freshman';
$GTM_LANG['classification']['sophomore'] = 'Sophomore';
$GTM_LANG['classification']['junior'] = 'Junior';
$GTM_LANG['classification']['senior'] = 'Senior';

# Ranking
$GTM_LANG['ranking']['rank'] = 'Rank';
$GTM_LANG['ranking']['player'] = 'Player';
$GTM_LANG['ranking']['avg_pts'] = 'Avg';
$GTM_LANG['ranking']['percent'] = '%';
$GTM_LANG['ranking']['score'] = 'Pts';
$GTM_LANG['ranking']['number'] = '#';





