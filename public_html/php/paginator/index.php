<?php 
	$botones = ceil($count_rows / $limit);
	$x = 1;
?>
<ul class="pagination">
    <li class="disabled "><a href="#!"><i class="grey-text text-lighten-4 material-icons">chevron_left</i></a></li>
    <?php  
    	while ($x <= $botones) {
    		$pag = $x - 1;  ?>
    		<li class="<?php  echo $pag == $pagina ? "active" : '';?> ">
    			<a href="<?php echo $href ?>" pag="<?php echo $pag ?>" class="grey-text text-lighten-4 pagination" ><?php echo $x; ?></a>
    		</li>
    	    <?php
    	    $x++;
    	}
    ?>
    <li class="disabled"><a href="#!"><i class="grey-text text-lighten-4 material-icons">chevron_right</i></a></li>
</ul>