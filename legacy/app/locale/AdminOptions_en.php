<?php
$GTM_LANG['AdminOptions']['heading_general'] = 'General';
$GTM_LANG['AdminOptions']['heading_emails'] = 'Email Templates';

$GTM_LANG['AdminOptions']['system_email'] = 'System email address';
$GTM_LANG['AdminOptions']['required_front_login'] = 'Required frontend login';
$GTM_LANG['AdminOptions']['new_round_admin_notify'] = 'Email admin(s) when new round is posted';
$GTM_LANG['AdminOptions']['new_round_player_notify'] = 'Email players when new round is posted';
$GTM_LANG['AdminOptions']['stats_toggle'] = 'Turn on/off stats categories in front-end';
$GTM_LANG['AdminOptions']['ranking_toggle'] = 'Turn on/off ranking categories in front-end';

$GTM_LANG['AdminOptions']['email_user_added_subject'] = 'New player added email subject';
$GTM_LANG['AdminOptions']['email_user_added_body'] = 'New user player email content';
$GTM_LANG['AdminOptions']['email_new_round_added_subject'] = 'New round added email subject';
$GTM_LANG['AdminOptions']['email_new_round_added_body'] = 'New round added email content';

$GTM_LANG['AdminOptions']['email_new_announcement_subject'] = 'New announcement email subject';
$GTM_LANG['AdminOptions']['email_new_announcement_body'] = 'New announcement email content';

$GTM_LANG['AdminOptions']['email_user_added_tokens'] = '
	Available tokens are:<br/><br/>
	{USERNAME} - Player username<br/>
	{PASSWORD} - Player password<br/>
	{NAME} - Player name<br/>
	{EMAIL} - Player email address<br/>
	{DOB} - Player date of birth<br/>
	{CLASS} - Player classification<br/>
	{TOWN} - Player hometown<br/>
	{DEXTERITY} - Player dexterity<br/>
	{PHONE} - Player phone number<br/>
	{SHIRT_SIZE} - Player shirt size<br/>
	{PANT_SIZE_WAIST} - Player pants size (waist)<br/>
	{PANT_SIZE_LENGTH} - Player pants size (length)<br/>
	{SHOE_SIZE} - Player shoes size<br/>
	{GLOVE_SIZE} - Player gloves size
';

$GTM_LANG['AdminOptions']['email_new_round_added_tokens'] = '
	Available tokens are:<br/><br/>
	{USERNAME} - Player username<br/>
	{NAME} - Player name<br/>
	{STATS} - 9/18 stats or no stats round<br/>
	{COURSE} - Course played<br/>
	{TOURNAMENT} - Touranament round Yes/No<br/>
	{DATE_PLAYED} - Date played
';

$GTM_LANG['AdminOptions']['email_new_announcement_tokens'] = '
	Available tokens are:<br/><br/>
	{ANNOUNCEMENT_URL} - Announcement URL
';

$GTM_LANG['AdminOptions']['show_overall'] = "Show Overall Ranking";
$GTM_LANG['AdminOptions']['show_18TAvg'] = "Show 18 Hole Tournament Round Scoring Average";
$GTM_LANG['AdminOptions']['show_18Anv'] = "Show 18 Hole Scoring Average";
$GTM_LANG['AdminOptions']['show_9Avg'] = "Show 9 Hole Scoring Average";
$GTM_LANG['AdminOptions']['show_handicap'] = "Show Estimated USGA Handicap";
$GTM_LANG['AdminOptions']['show_fir'] = "Show Fairway in Regulation";
$GTM_LANG['AdminOptions']['show_gir'] = "Show Greens in Regulation";
$GTM_LANG['AdminOptions']['show_ppg'] = "Show Putts Per Green";
$GTM_LANG['AdminOptions']['show_ppr'] = "Show Putts Per Round";
$GTM_LANG['AdminOptions']['show_ups'] = "Show Up &amp; Down/Par Saves";
$GTM_LANG['AdminOptions']['show_sand_save'] = "Show Sand Saves";
$GTM_LANG['AdminOptions']['show_par_or_better'] = "Show Par or better";
$GTM_LANG['AdminOptions']['show_par_breakers'] = "Show Par Breakers";
$GTM_LANG['AdminOptions']['show_pspr'] = "Show Penalty Shots per Round";
$GTM_LANG['AdminOptions']['show_par3avg'] = "Show Par Three Average";
$GTM_LANG['AdminOptions']['show_par4avg'] = "Show Par Four Average";
$GTM_LANG['AdminOptions']['show_par5avg'] = "Show Par Five Average";

$GTM_LANG['AdminOptions']['show_total_rounds'] = "Show total number of rounds played";
$GTM_LANG['AdminOptions']['show_eagles'] = "Show total Eagles or better";
$GTM_LANG['AdminOptions']['show_birdies'] = "Show total Birdies";
$GTM_LANG['AdminOptions']['show_pars'] = "Show total Pars";
$GTM_LANG['AdminOptions']['show_bogies'] = "Show total Bogies";
$GTM_LANG['AdminOptions']['show_2xbogies'] = "Show total Double bogies";
$GTM_LANG['AdminOptions']['show_3xbogies'] = "Show 3 over par or worse";