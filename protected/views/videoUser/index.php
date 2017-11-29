<h1>Видеоуроки</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
$this->breadcrumbs=array(
	'Видеоуроки'
);
?>
