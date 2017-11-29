<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-form',

	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone'); ?>
		<?php echo $form->telField($model,'telephone',array('size'=>11,'placeholder'=>'+7(900)123-45-67','minlength'=>11,'maxlength'=>16,'id'=>'tel')); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить',array('onClick'=>'return telephone();')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->