<?php
/* @var $this VideoController */
/* @var $model Video */

$this->menu=array(
	array('label'=>'Список видео', 'url'=>array('index')),
	array('label'=>'Создать видео', 'url'=>array('create')),
	array('label'=>'Просмотреть видео', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update Video <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>