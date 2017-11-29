<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	$model->login,
);
?>
<h1 style="margin-left:-5%; ">Обновить данные </h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
