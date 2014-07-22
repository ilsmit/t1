<?php
/* @var $this CommentsController */
/* @var $model Comments */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-comments-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'comment_text'); ?>
		<?php echo $form->textField($model,'comment_text'); ?>
		<?php echo $form->error($model,'comment_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author_name'); ?>
		<?php echo $form->textField($model,'author_name'); ?>
		<?php echo $form->error($model,'author_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_comment'); ?>
		<?php echo $form->textField($model,'date_comment'); ?>
		<?php echo $form->error($model,'date_comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php echo $form->textField($model,'parent'); ?>
		<?php echo $form->error($model,'parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rating_plus'); ?>
		<?php echo $form->textField($model,'rating_plus'); ?>
		<?php echo $form->error($model,'rating_plus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rating_minus'); ?>
		<?php echo $form->textField($model,'rating_minus'); ?>
		<?php echo $form->error($model,'rating_minus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'news_id'); ?>
		<?php echo $form->textField($model,'news_id'); ?>
		<?php echo $form->error($model,'news_id'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->