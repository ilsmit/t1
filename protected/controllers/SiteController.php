<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
                'testLimit'=>1,
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
	   $slider = Slider::model()->findAll();
	    $model = News::model();
        $themes = Themes::model();
        $listThemes = $themes->findAll();
        $newsArray = array();
        foreach($listThemes as $t){
            $id = $t->id;
            $res = $model->findAllBySql('select * from news where not id in(select id_news from slider) and id in(select distinct id_news from link_themes_news where id_theme = :id) order by date DESC limit 6' ,  array('id' => $id));
            $newsArray[$t->theme] = array();
                if(is_array($res)){
                foreach($res as $n){
                    $newsArray[$t->theme][] = $n;
                }
                }
                else{
                    $newsArray[$t->theme][] = $res;
                }    
        }
        
        //$res = $model->findBySql('select * from news where id in (select id_news form link_themes_news where theme = :id) Order by date DESC limit 4' ,  array(':id' => $id));//   
	    //$res = $model->findAll(array('order' => 'date DESC',  ));   
    
				$dataProvider=new CActiveDataProvider('News');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'model'=>$newsArray,
            'slider' =>$slider,
		));
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
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
                
                
//                $path = "../../messages";
//                $time = time();
//                $year = date('Y', $time);
//                $month = date('m', $time);
//	               if((!file_exists($path .'/' . $year)) && (!is_dir($path .'/' . $year))){
//    				    mkdir($path .'/' . $year);	
//                      		
//    			}
//                $path .= '/' . $year;
//                    if((!file_exists($path .'/' . $month)) && (!is_dir($path .'/' . $month))){
//    				    mkdir($path .'/' . $month);	
//    			}
//                $path .= '/' . $month . '/' . $_POST['ContactForm']['email'];
//                $fp = fopen($path, "a+");
//                fwrite($fp, "Имя: " . $_POST['ContactForm']['name'] . "\n" .
//                            "Почта: " . $_POST['ContactForm']['email'] . "\n" .
//                            "Предмет: " . $_POST['ContactForm']['subject'] . "\n" .
//                            "Текст: " . $_POST['ContactForm']['body'] . "\n" .
//                            "*****************************************************************" .
//                            "\n \n \n"
//                );

                
				Yii::app()->user->setFlash('contact','Спасибо, что связались с нами. В ближайшее время мы ответим вам');
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
		$model=new LoginForm();

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
			if($model->validate() && $model->login()){
				$this->redirect(Yii::app()->user->returnUrl);
			}
			else{
				Yii::app()->user->setFlash('loginError', 'Не верно введены логин или пароль');
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
		
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}