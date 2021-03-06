<?php

class StatisticController extends Controller
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
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
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Statistic;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Statistic'])) $model->attributes=$_POST['Statistic'];
		$model->user_id=Yii::app()->user->id;
		if(isset($_POST['Statistic']))
		{
			if(Statistic::model()->exists('user_id=:id and day=:date',array(':id'=>$model->user_id,':date'=>$model->day))){
				Statistic::model()->updateAll(array('amount'=>$model->amount, 'direction'=>$model->direction),'user_id=:id and day=:date',array(':id'=>$model->user_id, ':date'=>$model->day));
				$this->actionIndex();
			}else{
				if($model->save())
					$this->actionIndex();
			}
		}else{
			$this->render('create',array(
				'model'=>$model,
			));
		}

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Statistic']))
		{
			$model->attributes=$_POST['Statistic'];
			if($model->save())
				$this->actionIndex();
		}else{
			$this->render('update',array(
				'model'=>$model,
			));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->layout='//layouts/column3_stat';
		$dataProvider=Statistic::model()->findAll(array(
			'select'=>'amount,day,direction',
			'condition'=>'user_id=:id order by day ASC',
			'params'=>array(':id'=>Yii::app()->user->id),
			));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Statistic('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Statistic']))
			$model->attributes=$_GET['Statistic'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Statistic the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Statistic::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Statistic $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='statistic-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
