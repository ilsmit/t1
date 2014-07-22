<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	$model->theme,
);

//if(Yii::app()->user->checkAccess('moderator')){
//	$this->menu=array(
//			array('label'=>'Create News', 'url'=>array('create'))
//	);
//}
//if(Yii::app()->user->checkAccess('admin')){
//	$this->menu=array(
//			array('label'=>'Создать новость', 'url'=>array('create')),
//			array('label'=>'Управление новостями', 'url'=>array('admin'))
//	);
//}

?>

<h2><?php echo $model->theme; ?> </h2>

<div class="most_commented">
<p></a><h4 align='center'>Популярные новости</h4></p>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider1,
	'itemView'=>'_view_c',
		'summaryText' => '',
        'htmlOptions' => array('class' => 'most_c')
)); ?>

</div>



<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
		'summaryText' => '',
        
        
)); ?>


