<?php
/* @var $this RegionsController */
/* @var $model Regions */

$this->breadcrumbs=array(
	'Регионы'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Изменить регион',
);

$this->menu=array(
	array('label'=>'Список регионов', 'url'=>array('index')),
	array('label'=>'Создать регион', 'url'=>array('create')),
	array('label'=>'Просмотр региона', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление регионами', 'url'=>array('admin')),
);
?>

<h1>Изменить регион регион <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>