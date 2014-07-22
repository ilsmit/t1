<?php
/* @var $this SliderController */
/* @var $model Slider */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'slider-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>



	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_news'); ?>
       	<?php echo $form->dropDownList($model, 'id', $listNews,  array('options' => array($model->idNews->id=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'id_news'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link_image'); ?>
		<?php echo $form->textField($model,'link_image',array('size'=>60,'maxlength'=>254)); ?>
		<?php echo $form->error($model,'link_image'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


