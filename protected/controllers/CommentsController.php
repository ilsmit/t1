<?php

class CommentsController extends Controller
{
    public static $checkRating = false;
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
			 // we only allow deletion via POST request
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
        
            array('allow',
                 'actions'=>array('getRating'),
                 'users'=>array('@')
                 ),  
                 
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('update', 'delete'),
					'roles'=>array('updateComment'),
				),
				
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'roles'=>array('admin'),
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
		$model=new Comments;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comments']))
		{
			$model->attributes=$_POST['Comments'];
			if($model->save()){
                 // проверка для вывода сообщения
				$this->redirect(array('view','id'=>$model->id));
                }
		}

		$this->render('create',array(
			'comment'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
// 		echo $model->author_name;
		$model=$this->loadModel($id);

		if(!(Yii::app()->user->id == $model->author_name) && !(Yii::app()->user->checkAccess('admin'))){
			throw new CHttpException(403,'У вас недостаточно прав');
				
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comments']))
		{
			$model->attributes=$_POST['Comments'];
			
            if($model->save()){
                Yii::app()->user->setFlash('updateComment', 'Комментарий изменен');
				$this->redirect(array('//news/view','id'=>$model->news_id));
		
        }
          }      
//        else
//        {
//            die("djkf");
//        }
//
		$this->render('update',array(
			'comment'=>$model,
		));
}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
            Yii::app()->user->setFlash('deleteComment', "Ваш комментарий удален");
			$this->redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Comments');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Comments('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comments']))
			$model->attributes=$_GET['Comments'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Comments the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Comments::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Comments $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comments-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public function actionComments()
	{
		$model=new Comments;
	
		// uncomment the following code to enable ajax-based validation
		/*
		 if(isset($_POST['ajax']) && $_POST['ajax']==='comments-comments-form')
		 {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
	
		if(isset($_POST['Comments']))
		{
			$model->attributes=$_POST['Comments'];
			if($model->validate())
			{
				// form inputs are valid, do something here
				return;
			}
		}
		$this->render('comments',array('model'=>$model));
	}
    
    
    public function actionGetRating(){
        if(Yii::app()->request->isAjaxRequest){
            
            if(isset($_POST['value'])){
                $plus_minus = $_POST['value'];
                $id = $_POST['id'];
                $author = $_POST['author']; 
                $comment = $this->loadModel($id);
                $cur_user = Yii::app()->user->id;
                                                                


                $user_c = new UserComment();
                $res = $user_c->findAllByAttributes(array('user_id' => $cur_user, 'comment_id' => $id));  
                    if(count($res) != 0){
                        //Yii::app()->user->setFlash('ratingComment', "Вы уже голосовали за данный комментарий");
                        if($plus_minus == 'plus'){
                            
                            echo CHtml::encode(($comment->rating_plus == '') ? 0 : $comment->rating_plus);
                            Yii::app()->end();
                        }
                        elseif($plus_minus == 'minus'){
                            echo CHtml::encode(($comment->rating_minus == '') ? 0 : $comments->rating_minus);
                            Yii::app()->end(); 
                        }
                        
                    }
                    
                if($_POST['value'] == 'plus'){
                        $v = $comment->rating_plus + 1;
                        $comment->updateByPk($id, array('rating_plus' => $v));
                        $user_c->user_id = Yii::app()->user->id;
                        $user_c->comment_id = $id;
                        $user_c->save(false);
                        echo CHtml::encode($v);
                        Yii::app()->end();
                    }
                if($_POST['value'] == 'minus'){
                    $v =$comment->rating_minus + 1;
                    $comment->updateByPk($id, array('rating_minus' => $v));
                        $user_c->user_id = Yii::app()->user->id;
                        $user_c->comment_id = $id;
                        $user_c->save(false);
                        echo CHtml::encode($v);
                    Yii::app()->end();
                }
              }
              Yii::app()->end();
        }
    }
}
