<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}public function actionError(){
        if($error=Yii::app()->errorHandler->error){
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error',$error);
        }
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
				'actions'=>array('index','view','update','delete','error'),
				'roles'=>array('2','3'),
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
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->user->checkAccess('3')){
			$this->loadModel($id)->deleteByPk($id,array('condition'=>'role<>3'));
		}elseif(Yii::app()->user->checkAccess('2')){
			$this->loadModel($id)->deleteByPk($id,array('condition'=>'role=1'));
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		if(isset($_POST['activate'])){
			$model=User::model()->updateByPk($_POST['User_id'],array('activation'=>1));
		}elseif(isset($_POST['deactivate'])){
			$model=User::model()->updateByPk($_POST['User_id'],array('activation'=>0),array('condition'=>'role=1'));
		}


		if(isset($_POST['admin'])){
			$model=User::model()->updateByPk($_POST['User_id'],array('activation'=>1,'role'=>2,'status'=>3),array('condition'=>'role=1'));
		}elseif(isset($_POST['noadmin'])){
			if(Yii::app()->user->checkAccess('3')){
				$model=User::model()->updateByPk($_POST['User_id'],array('role'=>1,'status'=>0),array('condition'=>'id<>'.Yii::app()->user->id));
			}else{
				$model=User::model()->updateByPk($_POST['User_id'],array('role'=>1,'status'=>0),array('condition'=>'role=1'));
			}
		}

		
		if(isset($_POST['individual'])){
			$model=User::model()->updateByPk($_POST['User_id'],array('status'=>2),array('condition'=>'role=1'));
		}elseif(isset($_POST['group'])){
			$model=User::model()->updateByPk($_POST['User_id'],array('status'=>1),array('condition'=>'role=1'));
		}elseif(isset($_POST['none'])){
			$model=User::model()->updateByPk($_POST['User_id'],array('status'=>0),array('condition'=>'role=1'));
		}elseif(isset($_POST['vip'])){
			$model=User::model()->updateByPk($_POST['User_id'],array('status'=>3),array('condition'=>'role=1'));
		}


		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
