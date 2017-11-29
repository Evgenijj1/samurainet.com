<?php
/* @var $this VideoUserController */
/* @var $data Video */
?>
<?php if(Yii::app()->user->status>=$data->status){?>
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php
		if(strlen($data->description)>100){
			echo CHtml::encode(substr($data->description,0,100));
		}else{
			echo CHtml::encode($data->description);
		}
	?>
	<br />
	<?php	if(($data->path!='') and !is_null($data->path)){ ?>
	<br />
	<iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$data->path;?>" frameborder="0" allowfullscreen></iframe>
	<?php }else{?>
	<b> Видео отсутствует
	<br />
	<?php }?>
</div>
<?php }?>