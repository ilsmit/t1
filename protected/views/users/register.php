<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
    'Регистрация',
);


?>

    <h1>Регистариция</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>