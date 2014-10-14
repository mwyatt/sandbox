<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $config->title ?></title>
	<link rel="stylesheet" href="screen.css">
</head>
<body>
	<div class="key-information clearfix">
		<h1 class="full-name"><?php echo $config->fullName ?></h1>

<?php if ($config->address): ?>
	
		<p class="address"><?php echo $config->address ?></p>
	
<?php endif ?>

		<p class="email-and-telephone">
			<a href="mailto:<?php echo $config->email ?>" class="email"><?php echo $config->email ?></a>
			<span class="telephone"><?php echo $config->telephone ?></span>
		</p>
	</div>

<?php include '_panels.php' ?>
<?php if ($config->footer): ?>
	
	<div class="footer">
		<p class="footer-text">Built with love using PHP, JSON, HTML &amp; CSS</p>
	</div>

<?php endif ?>

</body>
</html>
