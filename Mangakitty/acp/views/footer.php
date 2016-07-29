<?php 
	$customJs .= ' extended = new Extended();'; 
	// if(!is_array($jsFiles['local'])) $jsFiles['local'] = array();
	// array_unshift($jsFiles['local'], 'acp/assets/js/jquery-2.1.1.min.js');
	$jsFiles['local'][] = 'acp/assets/js/bootstrap.min.js';
	$jsFiles['local'][] = 'acp/assets/js/custom.js';
	$jsFiles['local'][] = 'acp/assets/js/extended.min.js'; 
?>

<?php echo event('js', $jsFiles); ?>
<?php echo event('customJs', $customJs); ?>
<?php if (is_array($noty)): ?>
	<?php if (is_array($noty[0])): ?>
		<script>
			<?php foreach ($noty as &$single): ?>
				$.growl({ type: '<?php echo $single[0] ?>', message: '<?php echo $single[1] ?>' });
			<?php endforeach ?>
		</script>
	<?php else: ?>
	<script> $.growl({ type: '<?php echo $noty[0] ?>', message: '<?php echo $noty[1] ?>' });</script>
	<?php endif ?>
<?php endif ?>