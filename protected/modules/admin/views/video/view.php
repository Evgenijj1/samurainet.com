<?php
/* @var $this VideoController */
/* @var $model Video */

$this->menu=array(
	array('label'=>'Список видео', 'url'=>array('index')),
	array('label'=>'Создать видео', 'url'=>array('create')),
	array('label'=>'Обновить видео', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить видео', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены?')),
);
?>

<h1>Просмотр видео #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'status'=>array(
			'name'=>'status',
			'value'=>($model->status==3)?'Премиум':(($model->status==2)?'Индивидуальный':(($model->status==1)?'Групповой':'Отсутствует')),
		),
	),
)); ?>
<iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$model->path;?>" frameborder="0" allowfullscreen></iframe>