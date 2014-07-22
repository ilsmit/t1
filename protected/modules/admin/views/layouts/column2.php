<?php /* @var $this Controller */ ?>
<?php $this->beginContent('layouts/main'); ?>

	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Действия',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
			'title' => 'Операции'
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>

<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">

<?php $this->endContent(); ?>