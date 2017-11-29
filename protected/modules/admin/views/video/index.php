<?php
/* @var $this VideoController */
/* @var $model Video */

$this->menu=array(
	array('label'=>'Список видео', 'url'=>array('index')),
	array('label'=>'Создать видео', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#video-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Список видео</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
	echo CHtml::form();
	echo CHtml::submitButton('Групповой',array('name'=>'group'));
	echo CHtml::submitButton('Индивидуальный',array('name'=>'individual'));
	echo CHtml::submitButton('Премиум',array('name'=>'vip'));
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'video-grid',
	'selectableRows'=>2,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		array(
			'class'=>'CCheckBoxColumn',
			'id'=>'Video_id',
			),
		'status'=>array(
			'name'=>'status',
			'value'=>'($data->status==3)?"Премиум":(($data->status==2)?"Индивидуальный":"Групповой")',
			'filter'=>array(1=>"Групповой",2=>"Индивидуальный",3=>"Премиум"),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<?= CHtml::endform();?>