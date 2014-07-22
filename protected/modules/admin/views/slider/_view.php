<?php
/* @var $this SliderController */
/* @var $data Slider */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_news')); ?>:</b>
	<?php echo CHtml::encode($data->id_news); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link_image')); ?>:</b>
	<?php echo CHtml::encode($data->link_image); ?>
	<br />


</div>