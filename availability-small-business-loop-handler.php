<?php
	define('WP_USE_THEMES', false);  
	require_once('../../../wp-load.php');

	$sqftLow = ($_GET['sqftLow']) ? esc_attr($_GET['sqftLow']) : null;
	$sqftHigh = ($_GET['sqftHigh']) ? esc_attr($_GET['sqftHigh']) : null;
	$offset = ($_GET['offset']) ? esc_attr($_GET['offset']) : 0;
	$postsPerPage = 11;
	if($offset != 0) {
		$postPerPage = 999999;
	}
	
	if($sqftLow == 1) {
		$sqftLow = 0;
	}
?>
<?php 
	
	if(($sqftLow != null || $sqftLow == 0) && $sqftHigh != null) {
		$args = array (
			'post_type' => 'listings',
			'listing-type' => 'small-business',
			'posts_per_page' => $postsPerPage,
			'offset' => $offset,
			'meta_key' => 'square_footage',
			'orderby' => 'meta_value_num',
			'order' => 'ASC',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'availability',
					'value' => true,
					'compare' => '='
				),
				array(
					'key' => 'square_footage',
					'value' => $sqftLow,
					'type' => 'NUMERIC',
					'compare' => '>='
				),
				array(
					'key' => 'square_footage',
					'value' => $sqftHigh,
					'type' => 'NUMERIC',
					'compare' => '<='
				)
			)
		);
	} else {
		$args = array (
			'post_type' => 'listings',
			'listing-type' => 'small-business',
			'posts_per_page' => $postsPerPage,
			'offset' => $offset,
			'meta_key' => 'square_footage',
			'orderby' => 'meta_value_num',
			'order' => 'ASC',
			'meta_query' => array(
				array(
					'key' => 'availability',
					'value' => true,
					'compare' => '='
				),
			)
		);
	}
	
	$postCount = 0;
	$smallBusiness = new WP_Query($args); 
		
	if ( $smallBusiness->have_posts() ) : 
?>
	<?php if($offset == 0) { ?>

	<li class="available_label">
		<ul>
			<li class="complex">Complex</li>
			<li class="floor">Suite</li>
			<li class="square_feet">Sq. Ft.</li>
			<li class="address">Address</li>
			<li class="price">Price*</li>
		</ul>
	</li>
	
	<?php } ?>
	
	<?php while( $smallBusiness->have_posts() ) : $smallBusiness->the_post(); ?>
		
		<?php if($offset != 0 || ($offset == 0 && $postCount < 10)) : ?>
			<?php $complex = get_field('complex'); ?>
			
			<li class="available_item">
				<a href="<?php the_permalink(); ?>">
					<ul>
						<li class="complex"><?php echo $complex->post_title; ?><?php if(get_field('coming_soon')) { echo '**'; } ?></li>
						<li class="floor"><?php the_field('suite_number'); ?></li>
						<li class="square_feet"><?php the_field('square_footage'); ?></li>
						<li class="address"><?php the_field('address_line_1'); ?></li>
						<li class="price">$<?php the_field('price'); ?></li>
					</ul>
				</a>
			</li>
		<?php endif; ?>
		
		<?php $postCount++; ?>
	<?php endwhile; ?>
	<?php if($offset == 0) : ?>
		<input type="hidden" value="<?php echo $postCount; ?>" class="number_small_businesses">
	<?php endif; ?>
	
<?php else: ?>
	
	<li class="available_item">No listings available</li>
	
<?php endif; wp_reset_postdata(); ?>