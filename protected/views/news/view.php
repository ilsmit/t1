<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'Новости'=>array('site/index',),
	$model->header,
);

//if(Yii::app()->user->checkAccess('user')){
//	
//	$this->menu=array(
//
//				
//			array('label'=>'Создание комментария', 'url'=>array('create')),
//			array('label'=>'Управление комментариями', 'url'=>array('//comments/admin')),
//
//				
//	);
//}


//if(Yii::app()->user->checkAccess('moderator')){
//	
//	$this->menu=array(
//	array('label'=>'Список новостей', 'url'=>array('index')),
//			array('label'=>'Создать новость', 'url'=>array('create')),
//			array('label'=>'Создание комментария', 'url'=>array('create')),
//			array('label'=>'Упралвение комментариями', 'url'=>array('//comments/admin')),
//	
//			
//	);
//}

//if(Yii::app()->user->checkAccess('moderator') && Yii::app()->user->id==$model->news_author){
//	
//	$this->menu=array(
//			array('label'=>'Список новостей', 'url'=>array('index')),
//			array('label'=>'Создать новость', 'url'=>array('create')),
//			array('label'=>'Изменение новости', 'url'=>array('update', 'id'=>$model->id)),
//			array('label'=>'Удаление новости', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить новость?')),
//			
//			array('label'=>'Создание комментария', 'url'=>array('create')),
//			array('label'=>'Упралвение комментариями', 'url'=>array('//comments/admin')),
//				
//	);
//}

//if(Yii::app()->user->checkAccess('admin')){
//	$this->menu=array(
//	array('label'=>'Список новостей', 'url'=>array('index')),
//	array('label'=>'Создать новость', 'url'=>array('create')),
//	array('label'=>'Изменение новости', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Удаление новости', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить новость?')),
//	array('label'=>'управление новостями', 'url'=>array('admin')),
//			
//			array('label'=>'Создание комментария', 'url'=>array('create')),
//			array('label'=>'Упралвение комментариями', 'url'=>array('//comments/admin')),
//	);
//}



// $this->menu=array(
// // 	array('label'=>'Список новостей', 'url'=>array('index')),
// // 	array('label'=>'Создать новость', 'url'=>array('create')),
// // 	array('label'=>'Изменение новости', 'url'=>array('update', 'id'=>$model->id)),
// // 	array('label'=>'Удаление новости', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить новость?')),
// // 	array('label'=>'управление новостями', 'url'=>array('admin')),
		
// // 		array('label'=>'Создание комментария', 'url'=>array('create')),
// // 		array('label'=>'Упралвение комментариями', 'url'=>array('//comments/admin')),
// );
?>
<div class="text_news_w">

<h1 ><?php echo $model->header; ?></h1>

<div id="wrapper_news">
	<div id='news_info'>
	
		<div id='author_name'>
		<?php //  echo $model->author; ?> 
		</div>
		
		<div id='time_stamp' class='view_date' >
		<?php echo $model->date; ?>
		</div>
		
		<div id='regions_news' >
        <?php 
//		foreach($model->regions as $a){     вывод регионов
//			echo $a->region_name . " ";
//		}
		?>
		
		</div>
		<div id='themes_news' >
        <span class='view_date' >Темы: </span> 
		<?php 
		if(is_array($model->themes1))
			foreach($model->themes1 as $a){
				echo CHtml::link(CHtml::encode($a->theme), array('index', 'theme' => $a->id)) . " ";
		}
		 ?>
         </div>
         <br />
</div>
<div class="show_preview">
    <?php echo htmlspecialchars_decode($model->preview); ?>
</div>

<br />

	
	<div id="image_for_news">
	<?php 
    if($model->link_for_image != NULL){
        echo "<img src=\"" . $model->link_for_image . "\"/>";
    }
    
// 	$path = "news/". $model->year_of_create . "/" .  $model->month_of_create . "/" . $model->day_of_create . "/" . $model->id;
// 	if(file_exists($path)){
// 		if(is_dir($path)){
// 			echo "<img src=\"" . $path . "/" . "header.png" . "\"/>";
// 		}
// 	}
		?>
	
<!-- 	 !Указать путь -->
	</div>
    </div>
    <br />
	<div id="text_news">
	<?php echo htmlspecialchars_decode($model->body); ?>
	</div>
    	<br />
        
        	<?php
            if($model->source != ''){
                echo "<span class=\"view_date\">Источник: </span>";
                echo CHtml::link(CHtml::encode($model->source), $model->link, array('class' => 'view_date')); 
            }
			?>
	
</div>


<?php
    if(Yii::app()->user->hasFlash('addComment')){ ?>
    <script>setTimeout(function(){$('#message_c').fadeOut('slow')}, 5000)</script>
        
        <div class="alert alert-success" id='message_c' tabindex="1">
        <button type="button" class="close" data-dismiss="alert" autofocus>&times;</button>
        <?php 
        echo Yii::app()->user->getFlash('addComment');
        
        echo "</div>";
        echo "</div>";
}
        if(Yii::app()->user->hasFlash('updateComment')){ ?>
    <script>setTimeout(function(){$('#message_c').fadeOut('slow')}, 5000)</script>
        <button type="button" class="close" data-dismiss="alert" autofocus>&times;</button>
        <div class="alert alert-success" id='message_c' autofocus>
        <?php 
        echo Yii::app()->user->getFlash('updateComment');
        
        echo "</div>";
}

        if(Yii::app()->user->hasFlash('deleteComment')){ ?>
    <script>setTimeout(function(){$('#message_c').fadeOut('slow')}, 5000)</script>
        <button type="button" class="close" data-dismiss="alert" autofocus>&times;</button>
        <div class="alert alert-success" id='message_c' autofocus>
        <?php 
        echo Yii::app()->user->getFlash('deleteComment');
        
        echo "</div>";
}


?>

<div id="field_for_comment">
<?php 
if(Yii::app()->user->isGuest){
	echo '<br />';
echo 'Для того, чтобы оставить комментарий ' . CHtml::link('войдите', array('site/login')) . " или " . Chtml::link('зарегистрируйтесь', array('users/register'));
}
else{
	$this->renderPartial('application.views.news.update_comment', array('comment'=> $comment));
}
?>
</div>




<!-- Вывод комментариев -->
<br />
Количество комментариев: <?php echo count($model->comments)?>
<?php

?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'comment',
		'summaryText' =>'',
		'emptyText' => ''
)); ?>

<?php
// echo CHtml::form();
//echo CHtml::submitButton('label' => 'Показать все комментарии',  )