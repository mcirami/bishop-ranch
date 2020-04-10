<?php
	define('WP_USE_THEMES', false);  
	require_once('../../../wp-load.php');

	$letter = ($_GET['letter']) ? esc_attr($_GET['letter']) : 'A';
	$industry = ($_GET['industry']) ? esc_attr($_GET['industry']) : null;
	$postType = ($_GET['postType']) ? esc_attr($_GET['postType']) : null;
	
	$letter = strtolower($letter);
?>

<?php 
	
	if($industry) {
		$args = array (
			'post_type' => 'business',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'directory-type',
					'field'    => 'slug',
					'terms'    => $postType,
				),
				array(
					'taxonomy' => 'alpha',
					'field'    => 'slug',
					'terms'    => $letter,
				),
				array(
					'taxonomy' => 'industry',
					'field'	   => 'slug',
					'terms'	   => $industry,
				),
			),
		);
	} else {
		$args = array (
			'post_type' => 'business',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'directory-type',
					'field'    => 'slug',
					'terms'    => $postType,
				),
				array(
					'taxonomy' => 'alpha',
					'field'    => 'slug',
					'terms'    => $letter,
				),
			),
		);
	}
	
	$business = new WP_Query($args); 
		
	if ( $business->have_posts() ) : 
?>
	<ul>
	<?php while( $business->have_posts() ) : $business->the_post(); ?>
		
		<li><a href="<?php the_field('site_link'); ?>" target="_blank"><?php the_title(); ?></a><div class="business_content hidden_content"><?php the_content(); ?></div></li>
	
	<?php endwhile; ?>
	</ul>
	
<?php endif; wp_reset_postdata(); ?>