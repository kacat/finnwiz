<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>FinnWIZ 1.0</title>
		
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript">
			var base_URL = '<?= site_url() ?>';
		</script>
		<?php foreach($js_files as $js_file){ ?>
			<?= $js_file ?>
		<?php } ?>
		
		<?php foreach($css_files as $css_file){ ?>
			<?= $css_file ?>
		<?php } ?>
	</head>
	<body>
		
	<div id="header">
		<div class="inside">
			<ul class="main">
				<li><a href="<?= site_url() ?>"><h1><span class="finn">Finn</span><span class="wiz">WIZ</span> <span class="version">1.0</span></h1></a></li>
			</ul>
		</div>
	</div>
