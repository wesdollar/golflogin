<!doctype html>
<html>
	<head>
		<title>Golf Login | Team Management</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<?php
		foreach ($controller->css as $css)
		{
			echo '<link type="text/css" rel="stylesheet" href="'.(isset($css['remote']) && $css['remote'] ? NULL : NULL).$css['path'].$css['file'].'" />';
		}
		
		foreach ($controller->js as $js)
		{
			echo '<script type="text/javascript" src="'.(isset($js['remote']) && $js['remote'] ? NULL : NULL).$js['path'].$js['file'].'"></script>';
		}
		?>
	</head>
	<body>
        <p style="text-align: center; font-size: 32px; margin-top: 40px; margin-bottom: -65px; color: #fff;">Golf Login</p>
		<div id="container">
			<div id="wrapper">
				<div id="content_login">
				<?php require $content_tpl; ?>
				</div>
			</div> <!-- wrapper -->
		</div> <!-- container -->
	</body>
</html>