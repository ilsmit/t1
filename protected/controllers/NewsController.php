<?php

class NewsController extends Controller
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
            'ajaxOnly + getRating'
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
				'actions'=>array('create','update'),
				'roles' => array('createNews', 'updateNews', 'updateOwnNews')
				
			),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('updateComment'),
						'roles' => array('updateComment')
				
				),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'roles'=>array('manageNews', 'deleteNews'),
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
// 		$a= $this->loadModel($id);
// 		echo "<pre>";
// 		var_dump($a->commentsArray);
// 		echo "</pre>";
		$comment = new Comments();
		$this->addComment($id);
		$dataProvider = new CActiveDataProvider('Comments', array(
         'criteria' => array(
                   'condition' => 'news_id = :newsId',
                   'params' =>array('newsId' => $id),
                   'order' => 'date_comment ASC',
                   'limit' => 100	
               ),
               
                'pagination' => false,
//                (
//                    'pageSize' => 50,
//                )
     ))
				;

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'dataProvider'=>$dataProvider,
			'comment' => $comment	
		));
	
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new News;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			$model->news_author = Yii::app()->user->id;

			$model->date =date("d.m.Y  в H:i", time());

			if($model->save()){
				foreach($_POST['News']['region_news'] as $a){
					$linkRegion= new LinkRegionsNews();
					$linkRegion->id_news=$model->id;
					$linkRegion->id_region=$a;
					$linkRegion->save();

				}
				
				$model->gotRegions = $_POST['News']['theme_news'];
				foreach($_POST['News']['theme_news'] as $a){
					$linkTheme= new LinkThemesNews();
					$linkTheme->id_news=$model->id;
					$linkTheme->id_theme=$a;
					$linkTheme->save();
				}		

			}
				$this->redirect(array('view','id'=>$model->id));
		}
		
		$r = new Regions();
		$regions = $r->findAll();
		for($i=0; $i<count($regions); $i++){
			$model->listRegions[$regions[$i]->id] = $regions[$i]->region_name; // получаем все регионы
		}
		$t = new Themes();
		$themes = $t->findAll();
		for($i=0; $i<count($themes); $i++){
			$model->listThemes[$themes[$i]->id] = $themes[$i]->theme; // получаем все темы
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
		$model=$this->loadModel($id);

			if(!(Yii::app()->user->id == $model->news_author) && !(Yii::app()->user->checkAccess('updateNews'))){
			throw new CHttpException(403,'У вас недостаточно прав');
			
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			if($model->save()){

				if(count(($_POST['News']['region_news'])>0) && $_POST['News']['region_news'][0] != ''){
					LinkRegionsNews::model()->deleteAll('id_news=:id_news', array('id_news' => $model->id)); // т.к. кол-во регионов после изменения скорее всего  не равно количеству до изменения 
	  				foreach($_POST['News']['region_news'] as $a){
						$linkRegion= new LinkRegionsNews();
						$linkRegion->id_news=$model->id;
						$linkRegion->id_region=$a;
						$linkRegion->save();
	  				}
	 			}
	 		}	
	 			if(count(($_POST['News']['theme_news']))>0 && $_POST['News']['region_news'][0] != ''){
	 					LinkThemesNews::model()->deleteAll('id_news=:id_news', array('id_news' => $model->id)); // т.к. кол-во тем после изменения скорее всего  не равно количеству до изменения 
					foreach($_POST['News']['theme_news'] as $a){
						$linkTheme= new LinkThemesNews();
						$linkTheme->id_news=$model->id;
						$linkTheme->id_theme=$a;
						$linkTheme->save();
					}
	 			}
				$this->redirect(array('view','id'=>$model->id));
		}
		$r = new Regions();
		$regions = $r->findAll();
		for($i=0; $i<count($regions); $i++){
			$model->listRegions[$i+1] = $regions[$i]->region_name; // получаем все регионы
		}
		$t = new Themes();
		$themes = $t->findAll();
		for($i=0; $i<count($themes); $i++){
			$model->listThemes[$i+1] = $themes[$i]->theme; // получаем все темы
		}
		
		$this->render('update',array(
			'model'=>$model,
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}



     
     
     
	public function actionIndex($theme)
	{
	   if(isset($theme)){
  		    $dataProvider=new CActiveDataProvider('News', array(
			'criteria' => array(
					'condition'=> 'id in(select link_themes_news.id_news from link_themes_news where id_theme=:id)',
					'params' => array(':id' => $theme),
                    'order' => 'date DESC', 
				),
                'pagination' => array(
                'pageSize' => 20
                )
                ));
                
            $dataProvider1=new CActiveDataProvider('News', array( // Передает самые обсуждаемыеновости этого раздела
			'criteria' => array(
					'condition'=> 'id in(select comments.news_id from comments group by comments.news_id order by comments.news_id)',

				),
                'pagination' => array(
                'pageSize' => 20
                )
                ));
                
  		    $this->render('index',array(
			'dataProvider'=>$dataProvider,
            'dataProvider1'=>$dataProvider1,
            'model' => Themes::model()->findByPk($theme),
            ));         
	   } 
	}



	/**
	 * Manages all models.
	 */
     
	public function actionAdmin()
	{
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		$model->author = $model->newsAuthor->username;

		return $model;
	}
    
    
    
	public function addComment($id){
	   
		$comment= new Comments;
		if(isset($_POST['Comments'])){
			$comment->comment_text=$_POST['Comments']['comment_text'];
			$comment->author_name= Yii::app()->user->id;

			$comment->date_comment =date("d.m.Y  в H:i", time());
			$comment->parent; // Сделать !
			$comment->rating_plus;
			$comment->rating_minus;
			$comment->news_id = $id; 
			if($comment->save()){
    			Yii::app()->user->setFlash('lastAddComment', $comment->id); 
    			Yii::app()->user->setFlash('addComment', 'Ваш комментарий добавлен');
    			$this->refresh();
			}
		}	
	}

	
    
	public function actionUpdateComment($id)
	{
		$model= $this->loadModel($id);
		$idC = $model->comments->id;
		$commentM = new Comments();
		$comment=$commentM->loadModel($idC);
		if(!(Yii::app()->user->id == $comment->author_name) && !(Yii::app()->user->checkAccess('updateComment'))){
			throw new CHttpException(403,'У вас недостаточно прав');
	
		}	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Commentsu']))
		{
			$comment = new Comments();
			$comment->attributes=$_POST['Commentsu'];
			if($model->save())
				$this->redirect(array('view','id'=>$model-id));
		}
		$this->render('update',array(
				'comment'=>$model,
		));
	}
    
    
    
    
    	public function actionCreateComment()
	{
		$model=new Comments;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comments']))
		{
			$model->attributes=$_POST['Update_comment'];
		$this->addComment($id);
    }
	}
	
	
	/**
	 * Performs the AJAX validation.
	 * @param News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function getNews() {
		if ($this->actionParams['id']) {
			return $this->loadModel($this->actionParams['id']);
		}
	}
    
    public function actionGetRating(){
        $comment = new Comments();
        if(Yii::app()->request->isAjaxRequest){

            if(isset($_POST['value']) && $_POST['value'] == 'plus'){
                $plus = $_POST['value'];
                $id = $_POST['id'];
                $v = $comment->rating_plus;
                $comment->updateByPk($id, array('rating_plus' => $v= $v + 1));
                echo CHtml::encode($v);
                Yii::app()->end();
            }
            if(isset($_POST['value']) && $_POST['value'] == 'minus'){
                $plus = $_POST['value'];
                $id = $_POST['id'];
                $v =$comment->rating_minus + 1;
                $comment->updateByPk($id, array('rating_minus' => $v));
                echo CHtml::encode($v);
                Yii::app()->end();
            }
              Yii::app()->end();
            }
        }
        
  
}
