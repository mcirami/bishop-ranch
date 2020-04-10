<?php
	define('WP_USE_THEMES', false);  
	require_once('../../../wp-load.php'); 
?>
<?php
	$events = (isset($_GET['events'])) ? $_GET['events'] : array();  
?>
<?php
	foreach($events as $eventId) {
		$post = get_post($eventId);
		setup_postdata($post);
		
		$start = tribe_get_start_date( $post, false, 'h:ia' );
		$end = tribe_get_end_date( $post, false, 'h:ia' );
		$venue = tribe_get_venue(get_the_ID());
		$instructor = tribe_get_event_meta(get_the_ID(), 'instructor', true);
?>
		<div class="day_event">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p class="event_time">Time: <?php echo $start; ?> - <?php echo $end; ?></p>
			<p>Location: <?php echo $venue; ?></p>
			<?php if($instructor) { ?>
				<p>Instructor: <?php echo $instructor; ?></p>
			<?php } ?>
			<p class="event_description"><?php the_excerpt(); ?> <a href="<?php the_permalink(); ?>">Learn more</a></p>
		</div>
<?php 
	} 
	wp_reset_query();
?>