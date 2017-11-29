<?php if(Yii::app()->user->hasFlash('registration')): ?>

<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('registration'); ?>
</div>

<?php else: ?>
<div id="loginbox">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'form-vertical'),
)); ?>
<br>
    <div class="row">
        <?php echo $form->textField($model,'login',array('placeholder'=>'Придумайте логин','pattern'=>'([a-zA-Z][A-Za-z0-9_-]{1,253}[a-zA-Z0-9])')); ?>
        <?php echo $form->error($model,'login'); ?>
    </div>
    <br>
    <div class="row">
        <?php echo $form->passwordField($model,'password',array('placeholder'=>'Придумайте пароль')); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>
    <br>
    <div class="row">
        <input type="password" id="current_password" placeholder="Повторите пароль">
    </div>

    <?php if(CCaptcha::checkRequirements()): ?>
    <div class="row">
        <div>
        <?php $this->widget('CCaptcha'); ?>
        <?php echo $form->textField($model,'verifyCode',array('placeholder'=>'Код с картинки')); ?>
        </div>
        <?php echo $form->error($model,'verifyCode'); ?>
    </div>
    <?php endif; ?>
    <br>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Зарегистрироваться',array('class'=>'btn btn-inverse','onclick'=>'return prov();')); ?>
        <a class="btn btn-small" href="/site/login">Авторизация</a>
    </div>

<?php $this->endWidget(); ?>
</div>
<?php endif; ?>