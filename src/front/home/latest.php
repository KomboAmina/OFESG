<?php

$latest=$this->controller->model->getLatestGuide();

//print_r($latest);

?>

<h2>Latest Guide</h2>

<h3>OFESG <?php echo $latest->slug;?></h3>

<p><small>Published <?php echo $latest->createdon;?></small></p>

<?php

echo $latest->contents;

?>

<p><a href="<?php echo URL."guides/".$latest->slug."/";?>">Read Now &rarr;</a></p>
