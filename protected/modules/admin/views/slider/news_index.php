<table>




<?php

foreach($n as $news){
    ?>

    <tr>
    <td>
    <?php echo CHtml::link('V', array('slider/addNews', 'id'=> $news->id)); ?>
    </td>
    <td>
    <?php echo $news->id; ?>
    </td>
    
    <td>
    <?php echo $news->id; ?>
    </td>
        <td>
    <?php echo $news->header; ?>
    </td>
    <td>
    <?php echo substr($news->preview, 0, 30) ."..."; ?>
    </td>
    </tr>
<?php } ?>

</table>