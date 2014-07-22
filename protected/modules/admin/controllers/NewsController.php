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
				'roles'=>array('admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'roles'=>array('admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
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
		$model=new News;


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			$model->news_author = Yii::app()->user->id;
            $d =date("d.m.Y  в H:i", time());
			$model->date = $d;
            $model->date_f = $d;
            if(!isset($_POST['link_for_image'])){
                if($model->filename = CUploadedFile::getInstance($model, 'file_for_news')){
    			$fileType = $model->filename->getType();
            }
            }  

	
			if($model->save()){
				if(!is_array($_POST['News']['region_news']))
				{
					$linkRegion= new LinkRegionsNews();
					$linkRegion->id_news=$model->id;
					$linkRegion->id_region=$_POST['News']['region_news'];
					$linkRegion->save();
				}
				else{
				foreach($_POST['News']['region_news'] as $a){
					$linkRegion= new LinkRegionsNews();
					$linkRegion->id_news=$model->id;
					$linkRegion->id_region=$a;
					$linkRegion->save();
				}
				}
				
				if(!is_array($_POST['News']['theme_news']))
				{
					$linkRegion= new LinkThemesNews();
					$linkRegion->id_news=$model->id;
					$linkRegion->id_theme=$_POST['News']['theme_news'];
					$linkRegion->save();
				}
				else{
				foreach($_POST['News']['theme_news'] as $a){
					$linkTheme= new LinkThemesNews();
					$linkTheme->id_news=$model->id;
					$linkTheme->id_theme=$a;
					$linkTheme->save();
				}		
				}
			
            
            	$this->redirect(array('view','id'=>$model->id));
			}
            
				
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
                if(!isset($_POST['link_for_image'])){
                if($model->filename = CUploadedFile::getInstance($model, 'file_for_news')){
    			$fileType = $model->filename->getType();
                
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
					
// 					$model->gotRegions = $_POST['News']['theme_news'];
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
        }
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
	 * Lists all models.
	 */


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


	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
	   $slide = new Slider();
       $slider = $slide->findAll();
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('index',array(
			'model'=>$model,
            'slider'=>$slider,
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
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
    
    public function actionAddSlider($id){
        
   	        $model=Slider::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
    }
    
        public function actionDeleteSlider($id){
        
   	        $model=Slider::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
    }
}
