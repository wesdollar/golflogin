<!doctype html>
<html>
	<head>
		<title>Golf Login: Team Management</title>
        
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<?php
		foreach ($controller->css as $css)
		{
			echo '<link type="text/css" rel="stylesheet" href="'.(isset($css['remote']) && $css['remote'] ? NULL : NULL).$css['path'].$css['file'].'" />' . PHP_EOL;
		}
		
		foreach ($controller->js as $js)
		{
			echo '<script type="text/javascript" src="'.(isset($js['remote']) && $js['remote'] ? NULL : NULL).$js['path'].$js['file'].'"></script>' . PHP_EOL;
		}
		?>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="<?php echo NULL . CSS_PATH; ?>ie-sucks.css" />
		<![endif]-->
	</head>
	<body>
	
		<div id="container">
    		<div id="header">
				<h2>Golf Login: Team Management</h2>
				<div id="topmenu">
					<ul>
						<?php
						if ($controller->isAdmin())
						{
							foreach ($GTM_LANG['Admin']['menu'] as $k => $v)
							{
								?><li class="<?php echo @$_GET['controller'] == $k ? 'current' : NULL; ?>"><a href="<?php echo SCHOOL_URL; ?>index.php?controller=<?php echo $k; ?>&amp;action=<?php echo $k == 'Admin' ? 'logout' : 'index'; ?>"><?php echo $v; ?></a></li>
								<?php
							}
						}
						?>
					</ul>
				</div> <!-- topmenu -->
			</div> <!-- header -->
			
			<div id="top-panel">
				<div id="panel">
					<ul>
						<?php
						switch ($_GET['controller'])
						{
							case 'Admin':
								
								break;
							case 'AdminUsers':
								?>
								<li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminUsers&amp;action=index" class="group<?php echo @$_GET['controller'] == 'AdminUsers' && @$_GET['action'] == 'index' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['index']; ?></a></li>
								<li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminUsers&amp;action=create" class="useradd<?php echo @$_GET['controller'] == 'AdminUsers' && @$_GET['action'] == 'create' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['create']; ?></a></li>
								<?php
								break;
							case 'AdminOptions':
								?>
								<li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminOptions&amp;action=index" class="manage_page<?php echo @$_GET['controller'] == 'AdminOptions' && @$_GET['action'] == 'index' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['index']; ?></a></li>
								<li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminOptions&amp;action=email" class="manage_page<?php echo @$_GET['controller'] == 'AdminOptions' && @$_GET['action'] == 'email' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['email']; ?></a></li>
								<li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminOptions&amp;action=ranking" class="manage_page<?php echo @$_GET['controller'] == 'AdminOptions' && @$_GET['action'] == 'ranking' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['ranking']; ?></a></li>
								<?php
								break;
							case 'AdminPlayers':
								?>
								<li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminPlayers&amp;action=index" class="color_swatch<?php echo @$_GET['controller'] == 'AdminPlayers' && @$_GET['action'] == 'index' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['index']; ?></a></li>
								<li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminPlayers&amp;action=create" class="pagenew<?php echo @$_GET['controller'] == 'AdminPlayers' && @$_GET['action'] == 'create' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['create']; ?></a></li>
								<?php
								break;
							case 'AdminAnnouncements':
								?>
								<li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminAnnouncements&amp;action=index" class="color_swatch<?php echo @$_GET['controller'] == 'AdminAnnouncements' && @$_GET['action'] == 'index' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['index']; ?></a></li>
								<li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminAnnouncements&amp;action=create" class="pagenew<?php echo @$_GET['controller'] == 'AdminAnnouncements' && @$_GET['action'] == 'create' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['create']; ?></a></li>
								<li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminAnnouncements&amp;action=indexCategories" class="color_swatch<?php echo @$_GET['controller'] == 'AdminAnnouncements' && @$_GET['action'] == 'indexCategories' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['indexCategories']; ?></a></li>
								<li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminAnnouncements&amp;action=createCategory" class="pagenew<?php echo @$_GET['controller'] == 'AdminAnnouncements' && @$_GET['action'] == 'createCategory' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['createCategory']; ?></a></li>
								<?php
								break;
							case 'AdminCourses':
								?>
								<li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminCourses&amp;action=index" class="color_swatch<?php echo @$_GET['controller'] == 'AdminCourses' && @$_GET['action'] == 'index' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['index']; ?></a></li>
                                <li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminCourses&amp;action=create" class="pagenew<?php echo @$_GET['controller'] == 'AdminCourses' && @$_GET['action'] == 'create' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['create']; ?></a></li>
								<?php
								break;
                            case 'AdminRounds':
                                ?>
                                <li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminRounds&amp;action=index" class="color_swatch<?php echo @$_GET['controller'] == 'AdminRounds' && @$_GET['action'] == 'index' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['index']; ?></a></li>
                                <li><a href="<?php echo SCHOOL_URL; ?>index.php?controller=AdminRounds&amp;action=create" class="pagenew<?php echo @$_GET['controller'] == 'AdminRounds' && @$_GET['action'] == 'create' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['create']; ?></a></li>
                                <?php
                                break;
							/*
							case 'AdminNews':
								?>
								<li><a href="<?php echo BASE_PATH; ?>index.php?controller=AdminNews&amp;action=index" class="color_swatch<?php echo @$_GET['controller'] == 'AdminNews' && @$_GET['action'] == 'index' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['index']; ?></a></li>
								<li><a href="<?php echo BASE_PATH; ?>index.php?controller=AdminNews&amp;action=create" class="pagenew<?php echo @$_GET['controller'] == 'AdminNews' && @$_GET['action'] == 'create' ? ' focus' : NULL; ?>"><?php echo $GTM_LANG['Admin']['submenu'][@$_GET['controller']]['create']; ?></a></li>
								<?php
								break;
							*/
						}
						?>
					</ul>
				</div> <!-- panel -->
			</div> <!-- top-panel -->
			
			<div id="wrapper">
				<div id="content">
					<?php
					if (!empty($_GET['error'])) {
						if (array_key_exists(intval($_GET['error']), $GTM_LANG['Admin']['errors'])) {
							?>
							<p class="status_err"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['errors'][intval($_GET['error'])]; ?></p>
							<?php
						}
					}
					
					if (!empty($_GET['message'])) {
						if (array_key_exists(intval($_GET['message']), $GTM_LANG['Admin']['messages'])) {
							?>
							<p class="status_success"><span>&nbsp;</span><?php echo $GTM_LANG['Admin']['messages'][intval($_GET['message'])]; ?></p>
							<?php
						}
					}
					?>