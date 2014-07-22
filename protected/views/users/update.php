<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	
	'Мой профиль'=>array('view','id'=>$model->id),
	'Изменение',
);
?>

<h1>Изменение профиля</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>