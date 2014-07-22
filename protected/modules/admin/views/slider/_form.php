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
       	<?php echo $form->dropDownList($model,'id', $listNews); ?>
		<?php echo $form->error($model,'id_news'); ?>
	</div>

        <button class="btn " data-toggle="modal" data-target="#myModal">
          Спец. картинка для слайда
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                <h4 class="modal-title" id="myModalLabel">Ссылка на специальную картинку для слайда</h4>
              </div>
              <div class="modal-body">
                
                	<div class="row">
                		<?php echo $form->labelEx($model,'link_image'); ?>
                		<?php echo $form->textField($model,'link_image',array('size'=>60,'maxlength'=>254)); ?>
                		<?php echo $form->error($model,'link_image'); ?>
                	</div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ОК</button>
              </div>
            </div>
          </div>
        </div>



	<div class="row buttons">
    <hr />
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : '', array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>
<script src="../../../../bootstrap/js/bootstrap-modal.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="../../../../bootstrap/js/bootstrap.min.js"> </script>

</div><!-- form -->
