<?php 
	$query = 'SELECT name, link FROM menu';
	require_once DATABASE_CONTROLLER;
	$records = getList($query);
?>
<?php if(count($records) > 0): ?>
	<?php foreach($records as $r): ?>
		<a href="<?=$r['link']?>"><?=$r['name']?></a>
	<?php endforeach; ?>
<?php endif; ?>