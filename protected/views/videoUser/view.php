<h1>Просмотр Видео <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'description',
	),
)); 
$this->breadcrumbs=array(
	'Видеоуроки'=>'/videoUser',
	$model->name,
);
?>
<iframe width="700" height="394" src="https://www.youtube.com/embed/<?=$model->path;?>" frameborder="0" allowfullscreen></iframe>