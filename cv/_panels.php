<?php foreach ($panels as $panel): ?>

<div class="panel-primary">
	<h2 class="heading-primary"><?php echo $panel->name ?></h2>

<?php if (! empty($panel->paragraphs)): ?>

	<ul class="achivements">

	<?php foreach ($panel->paragraphs as $paragraph): ?>
		
		<li class="achivement"><?php echo $paragraph ?></li>

	<?php endforeach ?>

	</ul>

<?php else: ?>
	<?php include '_panel-children.php' ?>
<?php endif ?>

</div>

<?php endforeach ?>
