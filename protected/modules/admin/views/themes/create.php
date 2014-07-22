<?php
/* @var $this ThemesController */
/* @var $model Themes */

$this->breadcrumbs=array(
	'Темы'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список тем', 'url'=>array('index')),
	array('label'=>'Упраление темами', 'url'=>array('admin')),
);
?>

<h1>Создать тему</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>