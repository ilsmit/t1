<?php
/* @var $this CommentsController */
/* @var $data Comments */
?>

<?php if($data->author_name == Yii::app()->user->id){
    echo "<div class=\"view_my_comment\">";
}
else{
    echo "<div class=\"view_comment\">";
}



?>
<div class="username_time">
<span class="username_in_comment">
<strong> <?php echo CHtml::encode($data->authorName->username); ?> </strong>
</span>

    <span class="view_date">
	<?php echo CHtml::encode($data->date_comment); ?>
    </span>
	<br />
</div>
        <div class="image_in_comment">
    <?php
    $u  = new Users();
    $da = $data->authorName;
    if($da != NULL && $da->userInfo1 != NULL && $da->userInfo1->filename != NULL){
        echo html_entity_decode(CHtml::image('../' . $da->userInfo1->filename, $data->authorName->username, array('width' => 70, 'height' => 85)));
        
    }
    else{
        echo html_entity_decode(CHtml::image($u->defaultImage, $data->authorName->username, array('width' => 70, 'height' => 85)));
    }
?>
</div>
    <div class="comment_text">
	   <?php echo CHtml::encode($data->comment_text, array('id' => 'text_comment')); ?>
	</div>
    
<div class="rating_plus_minus" align='right'>
    <span class="content_rating_p">+</span><span class="content_rating_p" id="rating_plus_<?php echo $data->id; ?>"><?php echo ($data->rating_plus == '') ? 0 : $data->rating_plus; ?></span>
&nbsp;
    <span class="content_rating_m" >-</span><span class="content_rating_m" id="rating_minus_<?php echo $data->id; ?>"><?php echo ($data->rating_minus == '') ? 0 : $data->rating_minus; ?></span>
    
    &nbsp;
    <?php 
    if(Yii::app()->user->id == $data->author_name){
        echo CHtml::image('../images/other/plus.png', 'плюс', array('width' => 25, 'height' => 25));
    }
    else{
          echo CHtml::ajaxLink(CHtml::image('../images/other/plus.png', 'плюс', array('width' => 25, 'height' => 25, 'onmouseover' => "this.src='../images/other/plus_hover.png'",
	                'onmouseout' => "this.src='../images/other/plus.png'")), array('comments/getRating'), array('type' => 'post', 'update' => '#rating_plus_'.$data->id, 'data' => 
          array('value' => 'plus', 'id' => $data->id, 'author' => $data->author_name), array())); 
    }        
    ?>
    &nbsp;
    <?php
    if(Yii::app()->user->id == $data->author_name){
        echo CHtml::image('../images/other/minus.png', 'минус', array('width' => 25, 'height' => 25));    
    } 
    else{
            echo CHtml::ajaxLink(CHtml::image('../images/other/minus.png', 'минус', array('width' => 25, 'height' => 25, 'onmouseover' => "this.src='../images/other/minus_hover.png'",
	                'onmouseout' => "this.src='../images/other/minus.png'")), array('comments/getRating'), array('type' => 'post', 'update' => '#rating_minus_'.$data->id, 'data' => 
                array('value' => 'minus', 'id' => $data->id, 'author' => $data->author_name))); 
       } ?>
  
</div>

    <?php
    if(Yii::app()->user->hasFlash('ratingComment')){ ?>
        <script>setTimeout(function(){$('#message_rating').fadeOut('slow')}, 3000)</script>
        <div class="alert alert-success" id='message_rating'>
        <?php 
        echo Yii::app()->user->getFlash('ratingComment');
        echo "</div>";
        } ?>



	<?php if(Yii::app()->user->id==$data->author_name) { ?>
	<br />
	<b><?php echo CHtml::link('Изменить комментарий', array('comments/update', 'id' => $data->id)); ?>:</b>            
&emsp; &emsp; 
	<b><?php echo CHtml::link('Удалить комментарий', array('comments/delete', 'id'=> $data->id), array(
																										'submit'=> array('comments/delete', 'id'=> $data->id),
																										'class'=>'delete', 
																										'confirm' => 'Вы точно хотите удалить комментарий?')); ?>:</b>
	<?php  } ?>
    



	
	
	
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('news_id')); ?>:</b>
	<?php echo CHtml::encode($data->news_id); ?>
	<br />

	*/ ?>

</div>

