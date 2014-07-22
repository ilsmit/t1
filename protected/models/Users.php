<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $status
 * @property string $email
 * @property string $role
 *
 * The followings are the available model relations:
 * @property Comments[] $comments
 * @property News[] $news
 * @property UserInfo[] $userInfos
 */
class Users extends CActiveRecord
{
	public $first_name;
	public $last_name;
	public $second_name;
	public $phone;
	public $country;
	public $city;
	public $adress;
	public $sex;
	public $birthday;
	public $date_of_registration;
	public $filename; // обьект image
	public $path= "images/users";
	public $fileType;
	public $file;
    public $defaultImage = "../images/users/default/avatar.png";
    public $password2;
	
    
	
	const ROLE_GUEST = 'guest';
	const ROLE_USER = 'user';
	const ROLE_MODERATOR = 'moderator';
	const ROLE_ADMIN = 'admin';
	const ROLE_BANNED = 'banned';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
        return array(
//         	array('image', 'file', 'types'=>'jpg, gif, png', 'on'=>'insert', 'maxSize'=> 5000, 'minSize'=> 3),
            array('username, password, password2, email', 'required', 'message'=> 'Поля логин пароль и емайл должны быть заполнены'),
            array('username', 'unique', 'message'=> 'Такой логин уже существует'),
            array('username', 'length', 'min'=>3, 'max'=>64),
            array('password', 'compare', 'on'=>'register'),
            array('password2', 'compare', 'on'=>'register'),
            array('email', 'unique','message'=> 'Такой емайл уже сущетсвует'),
            array('email', 'email'),
            array('email', 'length', 'min'=>4, 'max'=>64),
            array('status', 'numerical', 'integerOnly'=>true),
            array('username, password, email', 'length', 'max'=>64),
            array('filename', 'file', 'types'=>'jpg, jpeg, png'),
        	
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, status, email, role', 'safe', 'on'=>'search'),
        );
	}
	

    	protected function beforeSave(){
            if($this->isNewRecord){
             $this->password = md5($this->password);
             return parent::beforeSave();     
        }
    }
   
   
    
	protected function afterSave(){
	
		parent::afterSave();
		if($this->isNewRecord){

			$user_info = new UserInfo();
			$user_info->id = $this->id;
			$user_info->first_name = $this->first_name;
			$user_info->last_name =  $this->last_name;
			$user_info->second_name = $this->second_name;
			$user_info->phone = $this->phone;
			$user_info->country = $this->country;
			$user_info->city = $this->city;
			$user_info->adress = $this->adress;
			$user_info->sex = $this->sex;
			$user_info->birthday = $this->birthday;
			$user_info->date_of_registration = $this->date_of_registration;
			if($this->filename){
			$path_to_file =$this->path;
			$year_of_reg = substr($this->date_of_registration, 6, 4);
			$month_of_reg = substr($this->date_of_registration, 3, 2);
            
		  	   if(!file_exists($path_to_file .'/' . $year_of_reg) && !is_dir($path_to_file .'/' . $year_of_reg)){
				mkdir($path_to_file .'/' . $year_of_reg);			
			}
            $path_to_file .= '/' . $year_of_reg;
                if(!file_exists($path_to_file .'/' . $month_of_reg) && !is_dir($path_to_file .'/' . $month_of_reg)){
				mkdir($path_to_file .'/' . $month_of_reg);	
			}
            $path_to_file .= '/' . $month_of_reg; 
                if(!file_exists($path_to_file .'/' . $this->username) && !is_dir($path_to_file .'/' .  $this->username)){
				mkdir($path_to_file .'/' .  $this->username . '/');	
			}
            $path_to_file .='/' .  $this->username . '/' . $this->username . "_avatar." . 'png';
// 			$path_to_file .= '/' . $this->username . "_avatar." . 'png';
			$user_info->filename = $path_to_file;	
			$this->filename->saveAs($path_to_file);
			$user_info->save();
            }
			} else {
			UserInfo::model()->updateAll(array(
					'id' => $this->id,
					'first_name' => $this->first_name,
					'last_name' => $this->last_name,
					'second_name' => $this->second_name,
					'phone' => $this->phone,
					'country' => $this->country,
					'city' => $this->city,
					'adress' => $this->adress,
					'sex' => $this->sex,
					'birthday' => $this->birthday,
					'date_of_registration' => $this->date_of_registration,
			),
					'id=:id', array(':id'=> $this->id));
		}
	}
	

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'comments' => array(self::HAS_MANY, 'Comments', 'author_name'),
			'news' => array(self::HAS_MANY, 'News', 'news_author'),
            'userComment' => array(self::HAS_MANY, 'userComment', 'user_id'),
			'userInfo1' => array(self::HAS_ONE, 'UserInfo', '.id'),
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
            'filename' => 'Картинка для аватара',
            'password2' => 'Повторите пароль'
        	
            // добавленные атрибуты из другой таблицы: КОНЕЦ
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('role',$this->role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    

    
}
