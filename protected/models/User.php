<?php

/**
 * This is the model class for table "bo_user".
 *
 * The followings are the available columns in table 'bo_user':
 * @property string $id
 * @property string $login
 * @property string $password
 * @property integer $created
 * @property integer $activation
 */
class User extends CActiveRecord
{
	const ROLE_PROGER = 'proger';
	const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'banned';
    const STATUS_NONE = 'none';
	const STATUS_GROUP = 'group';
    const STATUS_INDIVIDUAL = 'individual';
    const STATUS_VIP = 'vip';
    public $verifyCode;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, password', 'required'),
			array('login','match','pattern'=>'/^([A-Za-z0-9_]+)$/u','message'=>'Присутствуют недопустимые символы'),
			array('created, activation, telephone', 'numerical', 'integerOnly'=>true),
			array('login, password', 'length', 'max'=>255),
			array('first_name, last_name', 'length', 'max'=>50),
			array('telephone', 'length', 'is'=>11),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			array('id, login, password, created, activation, status, first_name, last_name, telephone', 'safe','on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'statistic'=>array(self::HAS_MANY,'Statistic','user_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Логин',
			'password' => 'Пароль',
			'created' => 'Зарегистрирован',
			'activation' => 'Активирован',
			'role'=>'Права',
			'status'=>'Тариф',
			'verifyCode'=>'Код с картинки',
			'first_name'=>'Имя',
			'last_name'=>'Фамилия',
			'telephone'=>'Номер телефона'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('activation',$this->activation);
		$criteria->compare('role',$this->role);
		$criteria->compare('status',$this->status);
		$criteria->compare('first_name',$this->first_name);
		$criteria->compare('last_name',$this->last_name);
		$criteria->compare('telephone',$this->telephone);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave(){
		if($this->isNewRecord){
			$this->activation=0;
			$this->created=time();
		}
		$this->password=md5('hs2,1.2m@11!!!.'.$this->password);
		return parent::beforeSave();
	}
}
