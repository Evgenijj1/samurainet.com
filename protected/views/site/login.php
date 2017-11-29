<div id="loginbox">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions'=>array('class'=>'form-vertical'),
)); ?>
<br>
<br>

	<div class="row">
		<?php echo $form->textField($model,'username',array('placeholder'=>'Логин')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
<br>
	<div class="row">
		<?php echo $form->passwordField($model,'password',array('placeholder'=>'Пароль')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
<br>
	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
<br>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Войти',array('class'=>'btn btn-inverse')); ?>
		<a class="btn btn-small" href="/site/registration">Регистрация</a>
	</div>

<?php $this->endWidget(); ?>

</div>

