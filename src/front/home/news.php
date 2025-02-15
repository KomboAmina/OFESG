<?php

$news=$this->controller->model->getLatestNews();

?>
<hr />
<h2>News</h2>

<?php

foreach($news as $new){

    ?>
    <h3><?php echo $new->title;?></h3>
    <p><small>Published: <?php echo $new->createdon;?></small></p>
    <p><a href="<?php echo URL."news/".$new->slug."/";?>">Read More &rarr;</a></p>
    <hr />
    <?php

}
