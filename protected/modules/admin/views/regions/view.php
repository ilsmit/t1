<?php
/* @var $this RegionsController */
/* @var $model Regions */

$this->breadcrumbs=array(
	'Regions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список регионов', 'url'=>array('index')),
	array('label'=>'Создать регион', 'url'=>array('create')),
	array('label'=>'Обновить регион', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить регион', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить регион?')),
	array('label'=>'Управление регионами', 'url'=>array('admin')),
);
?>

<h1>View Regions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'region_name',
	),
)); ?>
