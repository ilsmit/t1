<?php
/* @var $this ThemesController */
/* @var $model Themes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'themes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поле отмеченное  <span class="required">*</span> обязательно для заполнения</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="row">
		<?php echo $form->labelEx($model,'theme'); ?>
		<?php echo $form->textField($model,'theme',array('size'=>60,'maxlength'=>264)); ?>
		<?php echo $form->error($model,'theme'); ?>
	</div>
    
    	<div class="row">
		<?php echo $form->label($model,'position'); ?>
		<?php echo $form->DropDownList($model,'position',array('', 'top'=> 'Вверху', 'left' => 'Слева')); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->