<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Вход',
);
?>
<div>
<div class='wrapper_login' align="center">
<h1>Вход</h1>

<p>Введите логин и пароль:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
	'enableAjaxValidation' => false,
 	
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	),
)); ?>

<?php
if(Yii::app()->user->hasFlash('loginError')){
	echo "<div class='alert alert-danger' role='aler'>";
	echo Yii::app()->user->getFlash('loginError');
	echo "</div>";
} 
?>	

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->label($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		

	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="btn-group btn-group-lg" type='button'>
		<?php echo CHtml::submitButton('Вход') ; ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
</div>
