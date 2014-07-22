<?php

/**
 * This is the model class for table "user_info".
 *
 * The followings are the available columns in table 'user_info':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $second_name
 * @property string $phone
 * @property string $country
 * @property string $city
 * @property string $adress
 * @property integer $sex
 * @property string $birthday
 * @property string $date_of_registration
 *
 * The followings are the available model relations:
 * @property Users $id0
 */
class UserInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
// 			array('country, city, adress, sex, birthday, date_of_registration', 'required'),
// 			array('id, sex', 'numerical', 'integerOnly'=>true),
// 			array('first_name, last_name, second_name, phone', 'length', 'max'=>64),
// 			array('country, city, adress', 'length', 'max'=>32),
            array('filename', 'unsafe'),
            array('filename', 'file', 'allowEmpty'=>true,'types'=>'png,jpg,gif'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, first_name, last_name, second_name, phone, country, city, adress, sex, birthday, date_of_registration', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'id'),
            'comment' => array(self::HAS_MANY, 'Comments', 'author_name'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'id' => 'ID',
            'username' => 'Логин',
            'password' => 'Пароль',
            'status' => 'Status',
            'email' => 'Email',
            'role' => 'Role',
            // добавленные атрибуты из другой таблицы: НАЧАЛО
            'first_name'=>'Имя',
            'last_name'=>'Фамилия',
            'second_name'=>'Отчество',
            'phone'=>'Телефон',
            'country'=>'Страна',
            'city'=>'Город',
            'adress'=>'Адрес',
            'sex'=>'Пол',
            'birthday'=>'Дата рождения',
            'date_of_registration'=>'Date_of_registration', 
            'filename' => 'Путь к файлу',
            'password2' => 'Повторите пароль'
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

		$criteria->compare('id',$this->id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('second_name',$this->second_name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('adress',$this->adress,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('date_of_registration',$this->date_of_registration,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
//        public function behaviors()
//{
//	return array(
//		'image' => array(
//			'class' => 'ext.AttachmentBehavior.AttachmentBehavior',
//			# Should be a DB field to store path/filename
//			'attribute' => 'filename',
//			# Default image to return if no image path is found in the DB
//			'fallback_image' => 'images/sample_image.jpeg',
//			'path' => "/images/",
//			'processors' => array(
//				array(
//					# Currently GD Image Processor and Imagick Supported
//					'class' => 'GDProcessor',
//					'method' => 'resize',
//					'params' => array(
//						'width' => 310,
//						'height' => 150,
//						'keepratio' => true
//					)
//				)
//			),
//			'styles' => array(
//				# name => size 
//				# use ! if you would like 'keepratio' => false
//				'thumb' => '!100x60',
//			)			
//		),
//	);
//}
    
}
