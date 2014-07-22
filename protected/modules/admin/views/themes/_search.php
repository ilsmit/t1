<?php
/* @var $this ThemesController */
/* @var $model Themes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theme'); ?>
		<?php echo $form->textField($model,'theme',array('size'=>60,'maxlength'=>264)); ?>
	</div>
	
	    	<div class="row">
		<?php echo $form->label($model,'position'); ?>
		<?php echo $form->DropDownList($model,'position',array('', 'top'=> 'Вверху', 'left' => 'Слева')); ?>
		
	</div>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->