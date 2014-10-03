<?php foreach ($panel->children as $child): ?>

<div class="panel-primary-item">
	<span class="year"><?php echo $child->date ?></span>
	<h3 class="panel-primary-item-name"><?php echo $child->name ?></h3>
	<ul class="achivements">

<?php include '_panel-children-achivements.php' ?>

	</ul>
</div>
	

<?php endforeach ?>
