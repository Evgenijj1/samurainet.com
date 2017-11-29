<?php

$this->menu=array(
	array('label'=>'Список пользователей', 'url'=>array('index')),
	array('label'=>'Удаление пользователя', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены?')),
);
?>

<h1>Просмотр пользователя #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'login',
		'created'=>array(
			'name'=>'created',
			'value'=>date("j.m.Y H:i",$model->created),
			
		),
		'role'=>array(
			'name'=>'role',
			'value'=>($model->role==1)?'User':'Admin',
		),
		'activation'=>array(
			'name'=>'activation',
			'value'=>($model->activation==0)?'Не активирован':'Активирован',
		),
		'status'=>array(
			'name'=>'status',
			'value'=>($model->status==3)?'Премиум':(($model->status==2)?'Индивидуальный':(($model->status==1)?'Групповой':'Отсутствует')),
		),
	),
)); ?>
