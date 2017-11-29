<?php
$this->breadcrumbs=array(
	'Статистика'=>array('index'),
	'Список',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#statistic-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="center-column" style="z-index: 1; position: absolute; left: -430px; top:7px">
        	<a href="/Statistic/index" class="btn">На главную</a>
        	<a href="/Statistic/create" class="btn">Добавить запись</a>
</div>
<h1>Список записей</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'statistic-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'amount',
		'direction'=>array(
			'name'=>'direction',
			'value'=>'($data->direction==1)?"Прибыль":"Убыток"',
			'filter'=>array(1=>"Прибыль",0=>"Убыток"),
		),
		'day',
		array(
			'class'=>'CButtonColumn',
			'viewButtonOptions'=>array('style'=>'display:none'),
		),
	),
)); ?>
