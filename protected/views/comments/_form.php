<?php
/* @var $this CommentsController */
/* @var $comment Comments */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>



	<?php echo $form->errorSummary($comment); ?>

	<div class="row">
		<?php echo $form->label($comment,'comment_text'); ?>
		<?php echo $form->textArea($comment,'comment_text',array('rows'=>6, 'cols'=>50, 'class' =>'update_comment')); ?>
		<?php echo $form->error($comment,'comment_text'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($comment->isNewRecord ? 'Отправить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->