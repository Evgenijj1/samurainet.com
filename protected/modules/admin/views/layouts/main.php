<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="ru">

	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>


	<link rel="icon" type="image/png" href="/img/logo.png"/>

	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
    
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/unicorn.main.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/unicorn.grey.css" class="skin-color" />
    
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backoffice.css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/img/apple-touch-icon.png" rel="apple-touch-icon" />
</head>

<body>

<div id="header">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png">
</div>
<br>


    <div id="user-nav" class="navbar navbar-inverse pull-left">

        <ul class="nav btn-group">
            <li><a href="#">Вы вошли как <?=Yii::app()->user->name?></a></li>
        </ul>
        <ul class="nav btn-group">
            <li class="btn btn-inverse"><a title="" href="/site/logout"><i class="icon icon-share-alt"></i> <span
                    class="text">Выйти</span></a></li>
        </ul>
    </div>
    <div id="sidebar">
		<?php $this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>'<i class="icon icon-home active"></i>Профиль', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'<i class="icon icon-file "></i>О проекте', 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'<i class="icon icon-file "></i>Моя торговля', 'url'=>array('/', 'view'=>'about'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'<i class="icon icon-file "></i>Единый счет', 'url'=>array('/', 'view'=>'about'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'<i class="icon icon-file "></i>Статистика', 'url'=>array('/statistic/index'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'<i class="icon icon-file "></i>Проп трейдинг', 'url'=>array('#'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'<i class="icon icon-file "></i>Pamm счет', 'url'=>array('#'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'<i class="icon icon-file "></i>Общение', 'url'=>array('/', 'view'=>'about'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'<i class="icon icon-file "></i>Софт', 'url'=>array('/', 'view'=>'about'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'<i class="icon icon-signal "></i>Видео', 'url'=>array('/videoUser'), 'visible'=>Yii::app()->user->status>0),
				array('label'=>'<i class="icon icon-signal "></i>Админка', 'url'=>array('/admin'), 'visible'=>(Yii::app()->user->checkAccess('2') or Yii::app()->user->checkAccess('3')),'itemOptions'=>array('class'=>'submenu open'),
					'items'=>array(
						array('label'=>'Главная','url'=>array('/admin'),'active'=>Yii::app()->controller->id=='default'),
						array('label'=>'Видео','url'=>array('/admin/video'),'active'=>Yii::app()->controller->id=='video'),
						array('label'=>'Пользователи','url'=>array('/admin/user'),'active'=>Yii::app()->controller->id=='user'),
						)),
				array('label'=>'<i class="icon icon-signal "></i>Контакты', 'url'=>array('/site/contact')),
			),
		)); ?>
	</div>
	<div id="content">
<div id="content-header">
    <h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>
</div>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'htmlOptions'=>array('id'=>'breadcrumb'),
			'links'=>$this->breadcrumbs,
		)); ?>
	<?php endif?>
                <?php echo $content; ?>
	
<div class="row-fluid">
	<div id="footer" class="span12">
		Copyright &copy; <?php echo date('Y'); ?> by Sanich.<br/>
		Все права защищены.<br/>
	</div>
	</div>
</div>
</body>
</html>