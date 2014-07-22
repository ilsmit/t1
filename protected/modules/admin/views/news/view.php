<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'Новости'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список новостей', 'url'=>array('index')),
	array('label'=>'Создать новость', 'url'=>array('create')),
	array('label'=>'Изменить новость', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить новость', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы точно хотите удалить новость?')),
);
?>

<?php
$model->getRegionsForAdmin();
?>

<h1>Просмотр новости ID:<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'header',
		array(
				'label' => 'Текст',
				'type' => 'raw',
				'value' => htmlspecialchars_decode($model->body)),	
		
		'date',
		'region_news' => array(
            'label' => 'Регионы',
            'type' => 'raw',
            'value' => News::getRegionsForAdmin(),
            ),
		'theme_news',
		'news_author',
		'source',
		'link',
	),
)); ?>
