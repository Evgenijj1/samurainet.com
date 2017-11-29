<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="ru">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css">
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/pswd.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link rel="icon" type="image/png" href="/img/logo.png"/>
</head>

<body>

		<a href="/"><div id="logo"  style="text-align: center; vertical-align: middle">SSG</div></a>

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
	<?php endif?>
			
			<?= $content ?>
			
	</body>
</html>