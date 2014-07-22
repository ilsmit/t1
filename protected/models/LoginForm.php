<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CActiveRecord
{
    public $username;
    public $password;
    public $rememberMe;
//
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function tableName(){
    return "users";
}


    public function rules()
    {
        return array(
            // username and password are required
            array('username, password', 'required'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('username', 'length', 'min'=>3, 'max'=>64),
            array('password', 'length', 'min'=>4, 'max'=>64),
            array('password', 'authenticate'),
        );
    }


    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password,$this->password);
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'username'=>'Логин',
            'password'=>'Пароль',
            'rememberMe'=>'Запомнить',
        );
    }

    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('username',$this->login,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('email',$this->email,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }



    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate() {
        if(!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, md5($this->password));
            if(!$this->_identity->authenticate()) {
                $this->addError('login', 'Неверно введен логин или пароль');
            }
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if($this->_identity===null)
        {
            $this->_identity=new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
        {
            $duration=$this->rememberMe ? 3600*24*30*12 : 0; // 360 days
            Yii::app()->user->login($this->_identity,$duration);
            return true;
        }
        else
            return false;
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

