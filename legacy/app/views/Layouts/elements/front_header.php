<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN">
<head>
	<base href="<?php echo SCHOOL_URL ?>" />
	
	<title><?php echo !empty($controller->pageTitle) ? $controller->pageTitle : $GTM_LANG['Front']['PageTitle']['default']; ?></title>
        
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Wes Dollar" />
	<meta name="keywords" content="<?php echo !empty($controller->metaKeywords) ? $controller->metaKeywords : null; ?>" />
	<meta name="description" content="<?php echo !empty($controller->metaDescription) ? $controller->metaDescription : null; ?>" />
	<meta name="Robots" content="index,all"/>

	<link rel="shortcut icon" href="<?= WEB_URL; ?>img/favicon.ico" />
	
	<?php
	foreach ($controller->css as $css) {
		echo '<link type="text/css" rel="stylesheet" href="'.(isset($css['remote']) && $css['remote'] ? NULL : NULL).$css['path'].$css['file'].'" />' . PHP_EOL;
	}
	
	foreach ($controller->js as $js) {
        // todo: replace all other instances of (isset($js['remote']) && $js['remote'] ? NULL : BASE_PATH)
		echo '<script type="text/javascript" src="'.(isset($js['remote']) && $js['remote'] ? NULL : NULL).$js['path'].$js['file'].'"></script>' . PHP_EOL;
	}
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			$("table.courseCardPreview tr:even").css("background-color","#eee");
		});
	</script>
    <style type="text/css">
        #container {width:100%; height: auto !important; background:url(<?= SCHOOL_URL; ?>img/bgd_container.jpg) center 0 no-repeat; margin: 0 auto -85px; min-height: 100%;}
    </style>
</head>
<body>
<div id="container">
	<div id="header">
		<h1><a href="Front/index/" title="Golf Team Software" style="height:94px;weight:361px;display:inline-block;">&nbsp;</a></h1>
		
		<ul class="nav">
			<li><a href="Front/index/" class="<?php echo $controller->getController() == 'Front' && $controller->getAction() == 'index' ? 'current' : null; ?>"><img src="<?= WEB_URL; ?>img/dummy.gif" alt="Home" class="uiNav nav01" /></a></li>
			<li><a href="Front/rankings/" class="<?php echo $controller->getController() == 'Front' && $controller->getAction() == 'rankings' ? 'current' : null; ?>"><img src="<?= WEB_URL; ?>img/dummy.gif" alt="Rankings" class="uiNav nav05" /></a></li>
			<li><a href="Players/index/" class="<?php echo $controller->getController() == 'Players' && $controller->getAction() == 'index' ? 'current' : null; ?>"><img src="<?= WEB_URL; ?>img/dummy.gif" alt="Players" class="uiNav nav02" /></a></li>
			<?php
			if ($tpl['is_logged']) {
				?>
				<li><a href="Rounds/create/" class="<?php echo $controller->getController() == 'Rounds' && $controller->getAction() == 'create' ? 'current' : null; ?>"><img src="<?= WEB_URL; ?>img/dummy.gif" alt="Rounds" class="uiNav nav03" /></a></li>
				<li><a href="Courses/create/" class="<?php echo $controller->getController() == 'Courses' && $controller->getAction() == 'create' ? 'current' : null; ?>"><img src="<?= WEB_URL; ?>img/dummy.gif" alt="Courses" class="uiNav nav04" /></a></li>
				<li><a href="Front/profile/" class="<?php echo $controller->getController() == 'Front' && $controller->getAction() == 'profile' ? 'current' : null; ?>"><img src="<?= WEB_URL; ?>img/dummy.gif" alt="Front" class="uiNav nav06" /></a></li>
				<li><a href="Front/logout/" class="<?php echo $controller->getController() == 'Front' && $controller->getAction() == 'logout' ? 'current' : null; ?>"><img src="<?= WEB_URL; ?>img/dummy.gif" alt="Logout" class="uiNav nav07" /></a></li>
				<?php
			} else {
				?>
				<li><a href="Front/login/" class="<?php echo $controller->getController() == 'Front' && $controller->getAction() == 'login' ? 'current' : null; ?>"><img src="<?= WEB_URL; ?>img/dummy.gif" alt="Login" class="uiNav nav08" /></a></li>
				<?php
			}
			?>
		</ul>
	</div>
	<div id="main">
		<?php
		if (!empty($_GET['error'])) {
			if (array_key_exists($_GET['error'], $GTM_LANG['Front']['messages'])) {
				?>
				<div class="infoSucces"><?php echo $GTM_LANG['Front']['messages'][$_GET['error']]; ?></div>
				<?php
			} elseif (array_key_exists($_GET['error'], $GTM_LANG['Front']['errors'])) {
				?>
				<div class="infoError"><?php echo $GTM_LANG['Front']['errors'][$_GET['error']]; ?></div>
				<?php
			}
		}
		?>