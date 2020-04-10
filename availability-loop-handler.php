 <?php
	define('WP_USE_THEMES', false);  
	require_once('../../../wp-load.php');
	$sqft = ($_GET['sqft']) ? esc_attr($_GET['sqft']) : null;
	$complex = ($_GET['complex']) ? esc_attr($_GET['complex']) : null;
	$paged = ($_GET['paged']) ? esc_attr($_GET['paged']) : 1;
	$initial = ($_GET['initial']) ? esc_attr($_GET['initial']) : 0;
	
	$sqftIndex = ($_GET['sqftIndex']) ? esc_attr($_GET['sqftIndex']) : 0;
	$complexIndex = ($_GET['complexIndex']) ? esc_attr($_GET['complexIndex']) : 0;
	
	$initial = intval($initial);
	
	if($initial == 1) {
		$postsPerPage = 11;
		$offset = 0;
	} else {
		$postsPerPage = 9999999;
		$offset = 10;
	}
?>

<?php
	if($sqft) {
		$range = explode(' ', $sqft);
		if($range[0] === '20,000') {
			$lowsqft = '20,000+';
			$highsqft = '';
			$range[2] = '9999999';
			
			$sqftLow = 20000;
			$sqftHigh = 9999999;
		} else {
			$lowsqft = $range[0];
			$highsqft = $range[2];
			
			$sqftLow = intval(str_replace(',', '', $range[0]));
			$sqftHigh = intval(str_replace(',', '', $range[2]));
		}
	} 
?>
	
<?php $displayNum = $lowsqft . ' ' . $range[1] . ' ' . $highsqft . ' Sq. Ft.'; ?>

<?php 
	$headerText;
	
	if($sqft && $complex) :
		$headerText = get_the_title($complex) . ': ' . $displayNum;
		$args = array (
			'post_type' => 'listings',
			'posts_per_page' => $postsPerPage,
			'offset' => $offset,
			'meta_key' => 'square_footage',
			'orderby' => 'meta_value_num',
			'order' => 'ASC',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'complex',
					'value' => $complex,
					'compare' => '='
				),
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
	elseif($sqft && !$complex) :
		$headerText = $displayNum;
		$args = array (
			'post_type' => 'listings',
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
	elseif(!$sqft && $complex) :
		$headerText = get_the_title($complex);
		$args = array (
			'post_type' => 'listings',
			'posts_per_page' => $postsPerPage,
			'offset' => $offset,
			'meta_key' => 'square_footage',
			'orderby' => 'meta_value_num',
			'order' => 'ASC',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'complex',
					'value' => $complex,
					'compare' => '='
				),
				array(
					'key' => 'availability',
					'value' => true,
					'compare' => '='
				),
			)
		);
	endif;
?>
<?php if($initial == 1) : ?>
<div class="features">
	<div class="avail_info">
		<h3 class="garamond"><?php echo $headerText; ?></h3>
		<div class="listing_list">
			<ul class="listing_labels">
				<li>Complex</li>
				<li>Sq. Ft.</li>
				<li>Floor</li>
				<li>Suite</li>
				<li>Address</li>
			</ul>
			<ul class="current_listings">
			<?php
				$listing = new WP_Query($args);
				$postCount = 0;
				
				if ( $listing->have_posts() ) :
				
					while( $listing->have_posts() ) : $listing->the_post();
						if($postCount < 10) :
							$listingComplex = get_field('complex');
							$complexID = $listingComplex->ID;
				?>		
							<?php $postTitle = get_field('complex', $post->ID); ?>
							<div class="listing">
								<?php 
									$postLink = get_the_permalink(); 
									if($sqftIndex != 0 || $complexIndex != 0) {
										$postLink .= '?';
										if($sqftIndex != 0 && $complexIndex != 0) {
											$postLink .= "sqft=$sqftIndex&complex=$complexIndex";
										} else if($sqftIndex != 0 && $complexIndex == 0) {
											$postLink .= "sqft=$sqftIndex";
										} else if($sqftIndex == 0 && $complexIndex != 0) {
											$postLink .= "complex=$complexIndex";
										}
									}
								?>
								<a href="<?php echo $postLink; ?>">
									<li class="complex"><?php echo get_the_title($postTitle->ID); ?><?php if(get_field('coming_soon')) { echo '**'; } ?></li>
									<li class="sqft"><?php the_field('square_footage'); ?></li>
									<li class="floor"><?php the_field('floor'); ?></li>
									<li class="suite"><?php if(get_field('suite_number')) { the_field('suite_number'); }?></li>
									<li class="address"><?php the_field('address_line_1'); ?></li>
								</a>
							</div>
						<?php endif; ?>
						<?php $postCount++; ?>
				<?php endwhile; wp_reset_postdata(); ?>
				</ul>
				<?php if($postCount == 11) { ?>
					<a href="#" class="view_more_listings">View More Listings</a>
				<?php } ?>
				<?php $infoPhone = get_field('call_for_info_phone_#', 'options'); ?>
				<?php if($infoPhone) : ?>
					<a class="info_number" href="tel:<?php echo $infoPhone; ?>"><div class="call_for_info"><?php echo $infoPhone; ?></div></a>
				<?php else : ?>
					<div class="call_for_info">Call for detail on pricing</div>
				<?php endif; ?>
				<p class="disclaimer">**Coming soon.</p>
		<?php else : ?>
				<div class="no_listings">No listings were found.</div>
		<?php endif; ?>
		</div>
	</div>
</div>
<?php else : ?>
	<?php
		$listing = new WP_Query($args);
		$postCount = 0;
		
		if ( $listing->have_posts() ) :
		
			while( $listing->have_posts() ) : $listing->the_post();
				$listingComplex = get_field('complex');
				$complexID = $listingComplex->ID;
	?>		
				<?php $postTitle = get_field('complex', $post->ID); ?>
				<div class="listing">
					<?php 
						$postLink = get_the_permalink(); 
						if($sqftIndex != 0 || $complexIndex != 0) {
							$postLink .= '?';
							if($sqftIndex != 0 && $complexIndex != 0) {
								$postLink .= "sqft=$sqftIndex&complex=$complexIndex";
							} else if($sqftIndex != 0 && $complexIndex == 0) {
								$postLink .= "sqft=$sqftIndex";
							} else if($sqftIndex == 0 && $complexIndex != 0) {
								$postLink .= "complex=$complexIndex";
							}
						}
					?>
					<a href="<?php echo $postLink; ?>">
						<li class="complex"><?php echo get_the_title($postTitle->ID); ?><?php if(get_field('coming_soon')) { echo '**'; } ?></li>
						<li class="sqft"><?php the_field('square_footage'); ?></li>
						<li class="floor"><?php the_field('floor'); ?></li>
						<li class="suite"><?php if(get_field('suite_number')) { the_field('suite_number'); }?></li>
						<li class="complex"><?php the_field('address_line_1'); ?></li>
					</a>
				</div>
		<?php endwhile; wp_reset_postdata(); ?>
		<?php endif; ?>
<?php endif; ?>
