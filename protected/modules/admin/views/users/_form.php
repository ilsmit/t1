<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<p class="note">Поля с данным символом <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password2'); ?>
		<?php echo $form->passwordField($model,'password2',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'password2'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

    <!--добавление начато-->

    <div class="row">
        <?php echo $form->labelEx($model,'first_name'); ?>
        <?php echo $form->textField($model,'first_name'); ?>
        <?php echo $form->error($model,'first_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'last_name'); ?>
        <?php echo $form->textField($model,'last_name'); ?>
        <?php echo $form->error($model,'first_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'second_name'); ?>
        <?php echo $form->textField($model,'second_name'); ?>
        <?php echo $form->error($model,'second_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'phone'); ?>
        <?php echo $form->textField($model,'phone'); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'country'); ?>
        <?php echo $form->textField($model,'country'); ?>
        <?php echo $form->error($model,'country'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'city'); ?>
        <?php echo $form->textField($model,'city'); ?>
        <?php echo $form->error($model,'city'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'adress'); ?>
        <?php echo $form->textField($model,'adress'); ?>
        <?php echo $form->error($model,'adress'); ?>
    </div>
<div class="row">
		<?php echo $form->label($model,'filename'); ?>
		<?php echo $form->fileField($model,'filename'); ?>
		<?php echo $form->error($model,'filename'); ?>
	</div>
    <?php
//echo '<img src="'.$model->userInfos->getAttachment('thumb').'" />'; //thumbnail
//echo '<img src="'.$model->userInfos->attachment.'" />'; //base image
    ?>

    <!--    добавление оконченно-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>
</div>
<?php $this->endWidget(); ?>


