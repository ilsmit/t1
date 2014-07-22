<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Профиль'
);

?>


<h1>Мой профиль</h1>
<?php
?>
<br />
<div id>
<?php echo CHtml::link(CHtml::button('Изменить профиль', array('type'=>'button', 'class'=>'btn btn-default', 'width'=>'300px')), array('users/update', 'id'=>$model->id), array('width'=>'300px')); ?>
</div>
<br />
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
    'htmlOptions'=>array(
    'class'=>'table table-striped'),
	'attributes'=>array(
        array(
        'label' => 'Аватар',
        'type' => 'raw',
        'value' => ($model->filename === NULL) ? html_entity_decode(CHtml::image($model->defaultImage, 'image', array('width' => 300, 'height' => 400))) : html_entity_decode(CHtml::image('../' . $model->filename, 'image', array('width' => 300, 'height' => 400))),
		),
        'id',
		'username',
		'email',
        'first_name',
        'last_name',
        'second_name',
        'phone',
        'country',
        'city',
        'adress',

        
	
))); ?>
