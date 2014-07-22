<?php
$this->menu=array(

	array('label'=>'Создать слайд', 'url'=>array('create')),
);
?>

<h1>Слайдер</h1>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(

	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
		'id_news',
        'header' => array(
        'name' => 'новость',
        'value' => '$data->idNews->header' 
        ),
		'link_image',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
