<?php

class VideoUserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'roles'=>array('1','2','3'),
			),
			array('deny',  // deny all users
				'actions'=>array('index','view','error'),
				'users'=>array('none','guest'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
			$this->render('view',array(
					'model'=>$this->loadModel($id,Yii::app()->user->status),
			));
	}

	public function actionIndex()
	{
			if(Yii::app()->user->status<=0)
				throw new CHttpException(403,'Недостаточно прав. Купите тариф.');
			$dataProvider=new CActiveDataProvider('Video',
			 array(
			    'criteria'=>array(
			        'condition'=>'status<=:status',
			        'params'=>array(':status'=>Yii::app()->user->status)
			    ),
			    'pagination'=>array(
			        'pageSize'=>20
			    )));
			$this->render('index',array(
				'dataProvider'=>$dataProvider,
			));
	}

	/**
	 * Manages all models.
	 */
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Video the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id,$status)
	{
		$model=Video::model()->findByPk($id,array("condition"=>"status<=:status",'params'=>array(':status'=>$status)));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Video $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='video-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
