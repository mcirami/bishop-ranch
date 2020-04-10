<?php
	define('WP_USE_THEMES', false);  
	require_once('../../../wp-load.php'); 
	$page = ($_GET['pageNumber']) ? $_GET['pageNumber'] : 0;
?>

	<?php $rows = get_field('normal_timeline', 162); ?>
	<?php if((5 * $page) < count($rows)) : ?>
	<?php 
		if(count($rows) < 5 * ($page + 1)) : 
			$rowEnd = count($rows);
		else :
			$rowEnd = 5 * ($page + 1);
		endif;
	?>

	<?php for($i = 5 * $page; $i < $rowEnd; $i++) : ?>
		<?php $row = $rows[$i]; ?>
		<li>
			<div class="timeline_event_wrap">
				<div class="event_image">
				<?php $image2 = $row['normal_timeline_event_image']; ?>
				<a class="fancybox" href="<?php echo $image2['url']; ?>"><img src="<?php echo $image2['sizes']['thumb-322-201']; ?>" alt="<?php echo $image2['alt']; ?>" /></a>
				</div>
				<div class="event_content">
					<h3><?php echo $row['normal_timeline_event_year']; ?></h3>
					<?php echo $row['normal_timeline_event_content']; ?>
				</div>
			</div>
		</li>
	<?php endfor; ?>
<?php endif; ?>
