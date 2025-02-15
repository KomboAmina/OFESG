<?php

$guides=$this->controller->model->getPublishedGuides();

//print_r($guides);

if(count($guides)>=2){

    unset($guides[0]);

?>

<h2>Older Versions</h2>

<?php

    foreach($guides as $guide){

        ?>
        <h3>v<?php echo $guide->slug;?></h3>
        <p><small>Released: <?php echo $guide->createdon;?></small></p>
        <p><a href="<?php echo URL."guides/".$guide->slug."/";?>">Read More &rarr;</a></p>
        <?php

    }


}
