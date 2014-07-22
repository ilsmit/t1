<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<?php 



 ?>
<h1>Добро пожайловать <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Главные новости</p>

<div class="carousel slide" id='main_slider'>
    <ol class='carousel-indicators'>
    <?php
    $i=0;
    foreach($slider as $a){
        if($i==0){
            echo "<li class='active' data-target=\"#main_slider\" data-slide-to=" . $i . "></li>";
        }
        else{
            echo "<li data-target=\"#main_slider\" data-slide-to=" . $i . "></li>";
        }
        $i++;
        
    }
    ?>
    </ol>
    
    <div class='carousel-inner'>
<?php
    $i1=0;
    foreach($slider as $a){
        $img = '';
        
        
        if($a->link_image != NULL){
            $img = $a->link_image;
        }
        else{
            $img=$a->idNews->link_for_image;
        }
        if($i1==0){
            echo "<div class='item active'>";
        }
        else{
            echo "<div class='item'>" ;
        }
        
        echo CHtml::link(CHtml::image($img, $a->idNews->header), array('news/view', 'id'=>$a->id_news));
        echo "<div class='carousel-caption'>";
        if($a->link_image != NULL){
            $img = $a->link_image;
        }
        else{
            $img=$a->idNews->link_for_image;
        }
        echo "<h3>" . CHtml::link($a->idNews->header, array('news/view', 'id'=>$a->id_news)) . "</h3>";
        echo "<p>" . $a->idNews->preview . "</p>";
        echo "</div>";
        echo "</div>";
        $i1++;
    }
    ?>
</div>
  <a class="left carousel-control" href="#main_slider" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left">&lsaquo;</span>
  </a>
  <a class="right carousel-control" href="#main_slider" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" style="margin-top: 5px;">&rsaquo;</span>
  </a>
    </div>





<div class='site__view'>

<?php $this->renderPartial('list_news', array('model' => $model)); ?>
</div>


