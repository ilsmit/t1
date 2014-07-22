<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'header'); ?>
		<?php echo $form->textField($model,'header',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'header'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'region_news'); ?>
		<?php echo $form->dropDownList($model, 'region_news', $model->listRegions, array('prompt'=>'Выберите регион',  'multiple' => true, 'style'=> 'width: 20em', 'size' => '8')); ?>
		<?php echo $form->error($model,'region_news'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'theme_news'); ?>
		<?php echo $form->dropDownList($model, 'theme_news', $model->listThemes, array('prompt'=>'Выберите тему', 'multiple' => true, 'style'=> 'width: 20em', 'size' => '8')); ?>
		<?php echo $form->error($model,'theme_news'); ?>
	</div>
	


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->