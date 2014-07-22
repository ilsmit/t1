<?php

/**
 * This is the model class for table "comments".
 *
 * The followings are the available columns in table 'comments':
 * @property integer $id
 * @property string $comment_text
 * @property integer $author_name
 * @property string $date_comment
 * @property integer $parent
 * @property integer $rating_plus
 * @property integer $rating_minus
 * @property integer $news_id
 *
 * The followings are the available model relations:
 * @property News $news
 * @property News $news1
 */
class Comments extends CActiveRecord
{

    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment_text', 'required', 'message' => "Введите комментарий"),
			array('author_name, parent, rating_plus, rating_minus, news_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, comment_text, author_name, date_comment, parent, rating_plus, rating_minus, news_id', 'safe', 'on'=>'search'),
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
			'authorName' => array(self::BELONGS_TO, 'Users', 'author_name'),
			'news' => array(self::BELONGS_TO, 'News', 'news_id'),
            'authorInfo' => array(self::BELONGS_TO, 'Users', 'author_name'),
            'userComment' => array(self::HAS_MANY, 'userComment', 'comment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'comment_text' => 'Текст комментария',
			'author_name' => 'Автор',
			'date_comment' => 'Дата',
			'parent' => 'Parent',
			'rating_plus' => 'Рейтиг + ',
			'rating_minus' => 'Рейтинг - ',
			'news_id' => 'News',
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
		$criteria->compare('comment_text',$this->comment_text,true);
		$criteria->compare('author_name',$this->author_name);
		$criteria->compare('date_comment',$this->date_comment,true);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('rating_plus',$this->rating_plus);
		$criteria->compare('rating_minus',$this->rating_minus);
		$criteria->compare('news_id',$this->news_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
             'pagination' => array(
                'pageSize'=>30),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
