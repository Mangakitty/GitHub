<?php 
	
	header('Content-Type: text/html; charset=utf-8');
	
	if(R('slug') == '') exit();

	
		$manga = WASD::$sql->select(C('app.db_prefix').'manga', array('description', 'cover', 'alternativeName', 'author', 'artist' ,'genre'), array('slug'=>R('slug'), 'LIMIT'=>'1'));
 		$manga = $manga[0];

?>

 	<div style='float:left; width: 670px;'>
        <img class='img-thumbnail' style='float:left; width:150px; margin: 10px' src='<?php echo URL($manga['cover']) ?>'>
        <small><?php echo $manga['alternativeName'] ?><br />
        <strong><?php echo T('Authors') ?></strong>: <?php echo $manga['author'] ?> <br />
        <strong><?php echo T('Artists') ?></strong>: <?php echo $manga['artist'] ?>  <br />
        <strong><?php echo T('Genres') ?></strong>: <?php echo $manga['genre'] ?> <br />
        <?php echo $manga['description'] ?>
        </small>
    </div>
	