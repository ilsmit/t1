<?php
/* @var $this CommentsController */
/* @var $comment Comments */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'commentsu-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($comment); ?>

	<div class="row">
		<?php echo $form->labelEx($comment,'comment_text'); ?>
		<?php echo $form->textArea($comment,'comment_text',array('id' => 'text_area')); ?>
		<?php echo $form->error($comment,'comment_text'); ?>
	</div>

<!-- 	<div class="row"> -->
		<?php //echo $form->labelEx($comment,'author_name'); ?>
		<?php //echo $form->textField($comment,'author_name'); ?>
		<?php //echo $form->error($comment,'author_name'); ?>
<!-- 	</div> -->

<!-- 	<div class="row"> -->
		<?php //echo $form->labelEx($comment,'date_comment'); ?>
		<?php //echo $form->textField($comment,'date_comment',array('size'=>60,'maxlength'=>64)); ?>
		<?php //echo $form->error($comment,'date_comment'); ?>
<!-- 	</div> -->

<!-- 	<div class="row"> -->
		<?php //echo $form->labelEx($comment,'parent'); ?>
		<?php //echo $form->textField($comment,'parent'); ?>
		<?php //echo $form->error($comment,'parent'); ?>
<!-- 	</div> -->

<!-- 	<div class="row"> -->
		<?php //echo $form->labelEx($comment,'rating_plus'); ?>
		<?php //echo $form->textField($comment,'rating_plus'); ?>
		<?php //echo $form->error($comment,'rating_plus'); ?>
<!-- 	</div> -->

<!-- 	<div class="row"> -->
		<?php //echo $form->labelEx($comment,'rating_minus'); ?>
		<?php //echo $form->textField($comment,'rating_minus'); ?>
		<?php //echo $form->error($comment,'rating_minus'); ?>
<!-- 	</div> -->

<!-- 	<div class="row"> -->
		<?php //echo $form->labelEx($comment,'news_id'); ?>
		<?php //echo $form->textField($comment,'news_id'); ?>
		<?php //echo $form->error($comment,'news_id'); ?>
<!-- 	</div> -->

	<div class="row buttons">
		<?php echo CHtml::submitButton($comment->isNewRecord ? 'Отправить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->