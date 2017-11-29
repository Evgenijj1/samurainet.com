<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'statistic-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direction'); ?>
		<?php echo $form->dropDownList($model,'direction',array(1=>'Прибыль',0=>'Убыток')); ?>
		<?php echo $form->error($model,'direction'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'day'); ?>
		<?php echo $form->dateField($model,'day',array('value'=>date('Y-m-d'),'max'=>date('Y-m-d'))); ?>
		<?php echo $form->error($model,'day'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Обновить'); ?>
	</div>
<?php $this->endWidget(); ?>

</div>