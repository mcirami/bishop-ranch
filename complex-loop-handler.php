<?php 
	define('WP_USE_THEMES', false);  
	require_once('../../../wp-load.php');
	$complexSelected = ($_GET['complexID']) ? $_GET['complexID'] : null;
?>

<?php
	$args = array (
		'post_type' => 'property',
		'posts_per_page' => 1,
		'post__in' => array($complexSelected),
	);

	$complex = new WP_Query($args);

	while( $complex->have_posts() ) : $complex->the_post();
?>
	
	<div class="complex_wrap">
		<div class="comp_title"><?php the_title(); ?></div><div class="map_overlay_close_btn"></div>
		<?php $image = get_field('featured_image'); ?>
		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		<div class="short_desc"><?php echo substr(get_field('short_description'), 0, 291); ?></div>
		<ul class="complex_quicklinks">
			<li><a href="<?php the_permalink(); ?>">View More Details</a></li>
			<li><a href="<?php the_field('map_link'); ?>">View Map</a></li>
		</ul>
	</div>
	
<?php endwhile; ?>