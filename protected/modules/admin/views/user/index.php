<?php
$this->menu=array(
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал пользователей</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>
<?php
	echo CHtml::form();
	echo "<br>";
	echo CHtml::submitButton('Активировать',array('name'=>'activate'));
	echo CHtml::submitButton('Деактивировать',array('name'=>'deactivate'));
	echo "<br>";
	echo "<br>";
	echo CHtml::submitButton('Админ',array('name'=>'admin'));
	echo CHtml::submitButton('Смертный',array('name'=>'noadmin'));
	echo "<br>";
	echo "<br>";
	echo CHtml::submitButton('Отсутствует',array('name'=>'none'));
	echo CHtml::submitButton('Групповой',array('name'=>'group'));
	echo CHtml::submitButton('Индивидуальный',array('name'=>'individual'));
	echo CHtml::submitButton('Премиум',array('name'=>'vip'));
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'selectableRows'=>2,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'login',
		'created'=>array(
			'name'=>'created',
			'value'=>'date("j.m.Y H:i",$data->created)',
			'filter'=>false,
		),
		array(
			'class'=>'CCheckBoxColumn',
			'id'=>'User_id',
			),
		'role'=>array(
			'name'=>'role',
			'value'=>'($data->role==1)?"User":"Admin"',
			'filter'=>array(2=>"Admin",1=>"User"),
		),
		'activation'=>array(
			'name'=>'activation',
			'value'=>'($data->activation==0)?"Не активирован":"Активирован"',
			'filter'=>array(1=>"Активирован",0=>"Не активирован"),
		),
		'status'=>array(
			'name'=>'status',
			'value'=>'($data->status==3)?"Премиум":(($data->status==2)?"Индивидуальный":(($data->status==1)?"Групповой":"Отсутствует"))',
			'filter'=>array(0=>"Отсутствует",1=>"Групповой",2=>"Индивидуальный",3=>"Премиум"),
		),
		array(
			'class'=>'CButtonColumn',
			'updateButtonOptions'=>array('style'=>'display:none'),
		)
	),
));
	echo CHtml::endForm();
?>