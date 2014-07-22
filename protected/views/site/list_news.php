
<?php 
    foreach($model as  $header=> $news){
        ?>
                
        <h2><?php echo $header; ?></h2>
     
<div class='base_item_view'>
       
        <?php if(is_array($news)){
            $i=0;
            $i1=0;
            $check = false;
            foreach($news as $item){
                $i1++;
                if($i == 0){
                    
                    echo "<div class='row_item_view'>";
                }
?>                
                <div class='item_view' aling='top'>                
                    <div class= "wrapper_view_n">                                   
                        <div class="view_image_site" >
                        <?php echo CHtml::link(CHtml::image($item->link_for_image, '', array(
                        'class' => 'view_image-img', 'width' => 300, 'height' => 180, 'align' => 'middle')), array('news/view', 'id'=>$item->id), array('align'=> 'middle')); ?>
                        </div>
                        
                        <div class="view_header">
                    	<h3 align='center' class="view_header_in">
                        <?php echo CHtml::link(CHtml::encode($item->header), array('news/view', 'id'=>$item->id)); ?>
                    	</h3>
                        </div> 
                        <div class="preview_view">
                        <?php echo $item->preview; ?>
                        </div>
                        <div class="soc_items">
                        
                        </div>
                                                               
                    </div>            
                </div> 
                            
                     <?php 
                     if(($i == 2 && $i!=0) || count($news) == $i1){
                        $i = -1; 
                        echo "</div>";
                     }
                     $i++;}
        }
       ?>
        </div>
        


    <?php } ?>
