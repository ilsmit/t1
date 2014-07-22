<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список пользователей', 'url'=>array('index')),
);
?>

<h1>Создать пользователя</h1>
<hr />

<?php $this->renderPartial('_form', array('model'=>$model)); ?>