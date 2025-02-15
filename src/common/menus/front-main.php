<?php

$menu=$this->routesModel->validRoutes;

?>

<p align="right">

<?php 
foreach($menu as $page){

    if($page!==$this->route){echo "<a href='".URL.$page."/'>";}
    
    echo ucwords($page);
    
    if($page!==$this->route){echo "</a>";}

    echo " | ";

}
?>

Share

</p>
