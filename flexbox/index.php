<html>
<head>
	<meta charset="UTF-8">
	<title>Flexbox</title>
	<link rel="stylesheet" href="asset/common.bundle.css">
	<link rel="stylesheet" href="css/common.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body>
	<div class="wrap">
		<div class="typography">
			<h1>Content that is above</h1>
			<p>world world world world world world world world world world world world world world world world world world world.</p>
		</div>
		<div class="flex-container">
			<div class="flex-item">
				<h1 class="h1 mt0">hello much more in this heading</h1>
				<p class="p">world world world world world world world world world world world world world world world world world world world.</p>
			</div>
			
	<?php for ($index = 0; $index < 5; $index++) { ?>

			<div class="flex-item">
				<h1 class="h1 mt0">hello</h1>
				<p class="p">world</p>
				<div class="flex-item-inner-item text-right">
					<button class="button">Action Go</button>
				</div>
			</div>
		
	<?php } ?>

			<div class="flex-item">
				<h1 class="h1 mt0">hello much more in this heading</h1>
				<p class="p">world world world world world world world world world world world world world world world world world world world.</p>
			</div>
		</div>
		<div class="typography">
			<h1>Content that is below.</h1>
			<p>world world world world world world world world world world world world world world world world world world world.</p>
		</div>
	</div>
</body>
</html>
