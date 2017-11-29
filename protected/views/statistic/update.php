<?php

$this->breadcrumbs=array(
	'Статистика'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Обновление',
);
?>
<div class="center-column" style="z-index: 1; position: absolute; left: -430px; top:7px">
        	<a href="/Statistic/index" class="btn">На главную</a>
        	<a href="/Statistic/create" class="btn">Добавить запись</a><br>
        	<a href="/Statistic/admin" class="btn" style="margin-top: 6px;">Просмотреть все записи</a>
</div>
<h1>Обновить данные</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>