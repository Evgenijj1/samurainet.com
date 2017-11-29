<?php

class SiteController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','contact','actions'),
				'roles'=>array('1','2','3'),
			),
			array('deny',  // deny all users
				'actions'=>array('contact'),
				'users'=>array('guest'),
			),
		);
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if(isset($_POST['User'])){
			$model=User::model()->updateByPk(Yii::app()->user->id,array('first_name'=>$_POST['User']['first_name'],'last_name'=>$_POST['User']['last_name'],'telephone'=>$_POST['User']['telephone']));
		}
		if(Yii::app()->user->isGuest){
			$this->renderPartial('init');
		}else{
			$model=User::model()->findByPk(Yii::app()->user->id);
			$this->render('index',array('model'=>$model));
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
public function actionError(){
        if($error=Yii::app()->errorHandler->error){
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error',$error);
        }
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionRegistration()
	{
		if(!Yii::app()->user->isGuest){
             $this->render('index');
        }else{
			$model=new User;
			$model->scenario='registration';
			if(isset($_POST['User']))
			{
				$model->attributes=$_POST['User'];
					if($model->model()->count("login = :login", array(':login' => $model->login))){
						$model->addError('login', 'Логин уже занят');
                    }else{
						if($model->save()){
							Yii::app()->user->setFlash('registration','Зайдите в скайп. С Вами свяжества администратор.');
						}
					}
			}
			$this->layout='login';
			$this->render('registration',array(
				'model'=>$model,
			));
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Письмо удачно отправлено.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!Yii::app()->user->isGuest) {
            $this->render('index');
        }else{
			$model=new LoginForm;

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['LoginForm']))
			{
				$model->attributes=$_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login())
					$this->redirect(Yii::app()->user->returnUrl);
			}
			// display the login form
			$this->layout='login';
			$this->render('login',array('model'=>$model));
		}
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}