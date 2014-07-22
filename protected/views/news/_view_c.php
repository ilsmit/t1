<?php
/* @var $this NewsController */
/* @var $data News */
?>



<div class="view_c">

<div class='view_inner_c'>


    <div class="view_image" align='center'>
	
    <?php echo CHtml::link(CHtml::image($data->link_for_image, '', array('class' => 'view_image-img', 'width' => 300, 'height' => 180)), array('view', 'id'=>$data->id)); ?>
	
    </div>

    
    <div class="view_header_c">
	<h3 align='center'>
    <?php echo CHtml::link(CHtml::encode($data->header), array('view', 'id'=>$data->id)); ?>
	</h3>
    </div>
    <br />






	<?php
	//if(is_array($data->regions)){                       вывод регионов
//	 	foreach($data->regions as $c){
//			echo CHtml::encode($c->region_name) . " ";
//	}
//}
			?>
	<?php 
	//if(is_array($data->themes1)){
//		foreach($data->themes1 as $c){
//			echo CHtml::link(CHtml::encode($c->theme), array('index', 'theme' => $c->id)) . " ";
//		}
//	}
			?>
	<br />
	
	<b><?php // echo CHtml::encode($data->getAttributeLabel('news_author')); ?></b>
    
	<?php //echo CHtml::encode($data->news_author);         АВТОР НОВОСТИ ?>
    
    <?php 
       echo CHtml::encode($data->preview);
    ?>
	<br />
    <br />
    <div class='view_date_c'>	
	<span><?php echo CHtml::encode($data->date); ?> </span>
    <?php echo "<p> Уже комментариев: " . count($data->comments); 
    ?>
    </div>
	<br />
    

</div>

</div>