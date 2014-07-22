<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property string $header
 * @property string $body
 * @property string $date
 * @property string $region_news
 * @property string $theme_news
 *
 * The followings are the available model relations:
 * @property Comments[] $comments
 * @property LinkRegionsNews[] $linkRegionsNews
 * @property LinkThemesNews[] $linkThemesNews
 * @property Comments $id0
 */
class News extends CActiveRecord
{
	public $regionsArray= array();
	public $themes;
	public $commentsArray = array();
	//    public $comment_test;
	public $author;
	public $listRegions;
	public $listThemes;
	public $gotRegions;
	public $gotThemes;
    public $listRegionsForAdmin;
    public $themeForQuery;
    public static $addComment = false;
    public $filename; // обьект изображения
    public $path= "images/news";
    public $check_link = false; // проверка ввода ссылки на изображение    
    public $date_f;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('header, body, region_news, theme_news', 'required'),
			array('header', 'length', 'max'=>521),
			array('date', 'length', 'max'=>64),
			array('body, source, link, preview, link_for_image ', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, header, body, date, region_news, theme_news, news_author, source, link, preview, link_for_image, ',  'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comments', 'news_id'),
          
 			'linkRegionsNews1' => array(self::HAS_MANY, 'LinkRegionsNews', 'id_news'),
 			'linkThemesNews1' => array(self::HAS_MANY, 'LinkThemesNews', 'id_news'),
			'newsAuthor' => array(self::BELONGS_TO, 'Users', 'news_author'),
			'regions' => array(self::MANY_MANY, 'Regions', 'link_regions_news(id_news, id_region)'),
			'themes1' => array(self::MANY_MANY, 'Themes', 'link_themes_news(id_news, id_theme)'),
            'slider1' => array(self::HAS_ONE, 'Slider', 'id_news'),
		);
	}

 	protected function afterSave(){
 	  		parent::afterSave();
            if($this->isNewRecord){
			 if($this->filename){
    			$path_to_file = $this->path;
    			$year_of_reg = substr($this->date_f, 6, 4);
    			$month_of_reg = substr($this->date_f, 3, 2);
                $day_of_reg = substr($this->date_f, 0, 2);
                
    		  	   if((!file_exists($path_to_file .'/' . $year_of_reg)) && (!is_dir($path_to_file .'/' . $year_of_reg))){
    				    mkdir($path_to_file .'/' . $year_of_reg);	
                      		
    			}
                $path_to_file .= '/' . $year_of_reg;
                    if((!file_exists($path_to_file .'/' . $month_of_reg)) && (!is_dir($path_to_file .'/' . $month_of_reg))){
    				    mkdir($path_to_file .'/' . $month_of_reg);	
    			}
                $path_to_file .= '/' . $month_of_reg; 
                    if(!file_exists($path_to_file .'/' . $day_of_reg) && !is_dir($path_to_file .'/' .  $day_of_reg)){
    				    mkdir($path_to_file .'/' .  $day_of_reg);	
    			}
                    $path_to_file .= '/' . $day_of_reg; 
                    if(!file_exists($path_to_file .'/' . $this->id) && !is_dir($path_to_file .'/' .  $this->id)){
    				mkdir($path_to_file .'/' .  $this->id );	
    			}
                
                $path_to_file .='/' .  $this->id . '/' . $this->id . ".png";
                $p = "/" . $path_to_file;
    			
    			$this->filename->saveAs($path_to_file);
                $this->updateByPk($this->id, array('link_for_image' => $p));
            }
      }    
      }
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'header' => 'Заголовок',
			'body' => 'Текст новости',
			'date' => 'Дата публикации',
			'region_news' => 'Регионы: ',
			'theme_news' => 'Темы: ',
			'news_author' => 'Автор',
            'source' => 'Источник',
            'link' => 'Ссылка на источник',
            'preview' => 'Превью', 
            'link_for_image' => 'Ссылка на главную картинку',
            'file_for_news' => 'Картинка'
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
		$criteria->compare('header',$this->header,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('region_news',$this->region_news,true);
		$criteria->compare('theme_news',$this->theme_news,true);
		$criteria->compare('news_author',$this->news_author,true);
		
		return new CActiveDataProvider($this, 
        array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize'=>30),
		      )
              );
	}
	

	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    
    public static function getRegionsForAdmin(){
        $sumstr = '';
        $model = new News;
        for($i=0; $i<count($model->regions); $i++){
            if($i == (count($model->regions)-1)){
                $sumstr .= $model->regions[$i]->region_name;    
            }
            else{
                $sumstr .= $model->regions[$i]->region_name . ", ";
            }
        }
        return $sumstr;

        }
        
    public function getThemesForAdmin($id){
        $sumstr = '';
        $model = new News;
//        $res=$model->findlAllByPk($id);
        if(is_array($model->themes1)){
            for($i=0; $i<count($model->themes1); $i++){
                if($i == count($model->themes1)-1){
                    $sumstr .= $model->themes1[$i]->theme;    
                }
                else{
                    $sumstr .= $model->themes1[$i]->theme . ", ";
                }
            }
        }
        else{
            $sumstr = $model->themes1->theme;
        }
        return $sumstr;

        }   
    
}
