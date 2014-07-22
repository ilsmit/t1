<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="col-sm-10">
		<?php echo $form->labelEx($model,'header'); ?>
		<?php echo $form->textField($model,'header',array('size'=>120,'maxlength'=>512, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'header'); ?>
	</div>

	<div class="row">
    
   	<div class="row">
		<?php echo $form->labelEx($model,'preview'); ?>
		<?php echo $form->textField($model,'preview',array('size'=>120,'maxlength'=>264)); ?>
		<?php echo $form->error($model,'preview'); ?>
	</div>
    
		<?php echo $form->label($model,'body'); ?>
	<?php	
	
// 	$this->widget('application.extensions.cleditor.ECLEditor', array(
// 			'model'=>$model,
// 			'attribute'=>'body', //Model attribute name. Nome do atributo do modelo.
// 			'options'=>array(
// 					'width'=>'600',
// 					'height'=>250,
// 					'useCSS'=>true,
// 			),
// 			));	
	
	
	
	
	
	
$this->widget('application.extensions.editMe.widgets.ExtEditMe', array(  
    'model'=>$model,
    'attribute'=>'body',
    'filebrowserImageBrowseUrl' => 'kcfinder/browse.php?type=files',
    'filebrowserImageUploadUrl'=>'kcfinder/upload.php?type=files',
 //   'htmlOptions'=>array('option'=>'value','width'=>'900px'),
     'width'=>'900',
     'height'=>'300',

));
		?> 
		<?php echo $form->error($model,'body'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'region_news'); ?>
		<?php echo $form->dropDownList($model, 'region_news', $model->listRegions, array(  'multiple' => true, 'style'=> 'width: 20em', 'size' => '8')); ?>
		<?php echo $form->error($model,'region_news'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'theme_news'); ?>
		<?php echo $form->dropDownList($model, 'theme_news', $model->listThemes, array( 'multiple' => true, 'style'=> 'width: 20em', 'size' => '8')); ?>
		<?php echo $form->error($model,'theme_news'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'source'); ?>
		<?php echo $form->textField($model,'source',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'source'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>264)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>
    
        	<div class="row">
		<?php echo $form->labelEx($model,'link_for_image'); ?>
		<?php echo $form->textField($model,'link_for_image'); ?>
		<?php echo $form->error($model,'link_for_image'); ?>
	</div>
  
       <div class="row">
		<?php echo $form->labelEx($model,'file_for_news'); ?>
		<?php echo $form->fileField($model,'file_for_news'); ?>
		<?php echo $form->error($model,'file_for_news'); ?>
	</div>
    <hr />

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->