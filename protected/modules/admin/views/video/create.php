<?php
/* @var $this VideoController */
/* @var $model Video */

$this->menu=array(
	array('label'=>'Список видео', 'url'=>array('index')),
);
?>

<h1>Загрузить видео на сайт</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>