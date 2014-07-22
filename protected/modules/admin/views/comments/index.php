<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->breadcrumbs=array(
	'Комментарии'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Создать комментарий', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#comments-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление комментариями</h1>

<p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comments-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'comment_text',
		'author_name',
		'date_comment',
		'parent',
		'rating_plus',
		'rating_minus',
		array(
            'name'=>'news_id',
            'value' => '$data->news->header'),
	
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
