<?php
$this->breadcrumbs=array(
	'Статистика'=>array('index'),
	'Создание',
);
?>
<div class="center-column" style="z-index: 1; position: absolute; left: -430px; top:7px">
        	<a href="/statistic/index" class="btn">На главную</a>
        	<a href="/statistic/admin" class="btn">Просмотреть все записи</a>
</div>
<h1 style="margin-left: -60px;">Добавить запись</h1><br>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>