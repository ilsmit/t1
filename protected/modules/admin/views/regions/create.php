<?php
/* @var $this RegionsController */
/* @var $model Regions */

$this->breadcrumbs=array(
	'Regions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список регионов', 'url'=>array('index')),
	array('label'=>'Управление регионами', 'url'=>array('admin')),
);
?>

<h1>Create Regions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>