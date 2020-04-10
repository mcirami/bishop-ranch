<?php
/**
 * The Template for displaying all single posts.
 *
 * @package boiler
 */

get_header(); ?>
<?php 
	$complex = get_field('complex'); 
	$brochure = get_post_meta($post->ID, 'generated_pdf');
	
	$sqftIndex = ($_GET['sqft']) ? esc_attr($_GET['sqft']) : null;
	$complexIndex = ($_GET['complex']) ? esc_attr($_GET['complex']) : null;
	
	if($sqftIndex || $complexIndex) {
		
		if($sqftIndex) {
			$sqftLow = -1;
			$sqftHigh = -1;
			if($sqftIndex == 1) {
				$sqftLow = 0;
				$sqftHigh = 1000;
			} else if($sqftIndex == 2) {
				$sqftLow = 1000;
				$sqftHigh = 2500;
			} else if($sqftIndex == 3) {
				$sqftLow = 2500;
				$sqftHigh = 5000;
			} else if($sqftIndex == 4) {
				$sqftLow = 5000;
				$sqftHigh = 20000;
			} else if($sqftIndex == 5) {
				$sqftLow = 20000;
				$sqftHigh = 9999999;
			}
		}
		
		if($complexIndex) {
			$other_args = array (
				'post_type' => 'property',
				'posts_per_page' => 1,
				'offset' => ($complexIndex-1),
				'orderby' => 'meta_value_num',
				'meta_key' => 'post_order',
				'order' => 'ASC',
			);
		
			$complexes = new WP_Query($other_args);
			
			$i = 0;
			$complex_id = null;
			
			while( $complexes->have_posts() ) : $complexes->the_post();
				$complex_id = get_the_ID();
			endwhile; wp_reset_postdata();
		}
		
		if($sqftLow != -1 && $sqftHigh != -1 && $complex_id) {
			$args = array (
				'post_type' => 'listings',
				'posts_per_page' => -1,
				'meta_key' => 'square_footage',
				'orderby' => 'meta_value_num',
				'order' => 'ASC',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'complex',
						'value' => $complex_id,
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
		} else if($sqftLow != -1 && $sqftHigh != -1) {
			$args = array (
				'post_type' => 'listings',
				'posts_per_page' => -1,
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
		} else if($complex_id) {
			$args = array (
				'post_type' => 'listings',
				'posts_per_page' => -1,
				'meta_key' => 'square_footage',
				'orderby' => 'meta_value_num',
				'order' => 'ASC',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'complex',
						'value' => $complex_id,
						'compare' => '='
					),
					array(
						'key' => 'availability',
						'value' => true,
						'compare' => '='
					)
				)
			);
		} else {
			$args = array (
				'post_type' => 'listings',
				'posts_per_page' => -1,
				'meta_key' => 'square_footage',
				'orderby' => 'meta_value_num',
				'order' => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'availability',
						'value' => true,
						'compare' => '='
					)
				)
			);
		}
	} else {
		$args = array (
			'post_type' => 'listings',
			'posts_per_page' => -1,
			'meta_key' => 'square_footage',
			'orderby' => 'meta_value_num',
			'order' => 'ASC',
			'meta_query' => array(
				array(
					'key' => 'availability',
					'value' => true,
					'compare' => '='
				)
			)
		);
	}
?>

<?php
	
	$allListings = new WP_Query($args);
	//echo '<pre>'; print_r($allListings->posts); echo '</pre>';
	$posts = array();
	while( $allListings->have_posts() ) : $allListings->the_post();
?>
	<?php array_push($posts, get_permalink(get_the_ID())); ?>
<?php endwhile; wp_reset_postdata(); ?>

<?php $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>

<?php $pathURL = array_search(parse_url($url, PHP_URL_PATH), $posts); ?>

<?php $prev_post = $posts[($pathURL - 1)]; ?>
<?php $next_post = $posts[($pathURL + 1)]; ?>

<section class="single_listing wrapper">
	<div class="container">
		<div class="single_nav">
			<div class="listing_search">
				<h1 class="garamond mobile_header">Available Space for Lease</h1>
				<div class="mobile_left">
					<?php if($sqftIndex || $complexIndex) { ?>
						<?php 
							$postLink = '/availability?';
							if($sqftIndex && $complexIndex) {
								$postLink .= "sqft=$sqftIndex&complex=$complexIndex";
							} else if($sqftIndex && !$complexIndex) {
								$postLink .= "sqft=$sqftIndex";
							} else if(!$sqftIndex && $complexIndex) {
								$postLink .= "complex=$complexIndex";
							}
						?>
						<ul>
							<li><a href="<?php echo $postLink; ?>">Return to Search Result</a></li>
						</ul>
					<?php } ?>
				</div>
				<form id="avail_form" class="form availability_form" action="/availability" method="post">
					<div id="home_sqft"></div>
					<input type="hidden" name="sqft" id="sqft" value="">
					<?php
						$args = array (
							'post_type' => 'property',
							'posts_per_page' => -1,
							'orderby' => 'meta_value_num',
							'meta_key' => 'post_order',
							'order' => 'ASC',
						);
					
						$complexes = new WP_Query($args);
					?>
					
					<select id="home_complex">
						<option value="" selected="">Complex</option>
						<?php
							while( $complexes->have_posts() ) : $complexes->the_post();
						?>
							<?php $postid = get_the_ID(); ?>
							<option value="<?php echo $postid; ?>"><?php the_title(); ?></option>
							
						<?php endwhile; wp_reset_postdata(); ?>
					</select>
					<input type="hidden" name="complex" id="complex" value="">
					<button class="standard_btn">Search</button>
				</form>
				<div class="search_divider"></div>
				<div class="availability_pages">
					<a href="/availability/medical-dental-space">Medical and Dental</a>
					<a href="/availability/small-business">Small Business</a>
				</div>
			</div>
			<div class="left">
				<?php if($sqftIndex || $complexIndex) { ?>
					<?php 
						$postLink = '/availability?';
						if($sqftIndex && $complexIndex) {
							$postLink .= "sqft=$sqftIndex&complex=$complexIndex";
						} else if($sqftIndex && !$complexIndex) {
							$postLink .= "sqft=$sqftIndex";
						} else if(!$sqftIndex && $complexIndex) {
							$postLink .= "complex=$complexIndex";
						}
					?>
					<ul>
						<li><a href="<?php echo $postLink; ?>">Return to Search Result</a></li>
					</ul>
				<?php } ?>
			</div>
			<div class="right">
				<ul>
					<?php if($prev_post) { ?>
						<?php 
							$postLink = $prev_post;
							if($sqftIndex && $complexIndex) {
								$postLink .= "?sqft=$sqftIndex&complex=$complexIndex";
							} else if($sqftIndex && !$complexIndex) {
								$postLink .= "?sqft=$sqftIndex";
							} else if(!$sqftIndex && $complexIndex) {
								$postLink .= "?complex=$complexIndex";
							}
						?>
						<li><a href="<?php echo $postLink; ?>">&lt; Previous Listing</a></li>
					<?php } ?>
					<?php if($next_post) { ?>
						<?php 
							$postLink = $next_post;
							if($sqftIndex && $complexIndex) {
								$postLink .= "?sqft=$sqftIndex&complex=$complexIndex";
							} else if($sqftIndex && !$complexIndex) {
								$postLink .= "?sqft=$sqftIndex";
							} else if(!$sqftIndex && $complexIndex) {
								$postLink .= "?complex=$complexIndex";
							}
						?>
						<li><a href="<?php echo $postLink; ?>">Next Listing &gt;</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="info_wrap">
			<div class="listing_info">
				<?php $square_footage = get_field('square_footage'); ?>
				<h1 class="page_title"><?php echo $complex->post_title; ?> - <?php echo number_format($square_footage); ?> Sq. Ft.<?php if(get_field('coming_soon')) { echo ' - Coming Soon'; } elseif(!get_field('availability')) { echo ' - Unavailable'; } ?></h1>
				<p class="address">Suite <?php the_field('suite_number'); ?><span class="address_divider">|</span><?php the_field('address_line_1'); ?><?php if (get_field('address_line_2')) { echo ' '; the_field('address_line_2'); } ?>, <?php the_field('city'); ?>, <?php the_field('state'); ?> <?php the_field('zip_code'); ?></p>
				<ul>

						<li><a href="<?php the_field('map_link'); ?>" target="_blank">View Map</a></li>
						<li><a href="mailto:<?php the_field('email_link'); ?>">Email Link</a></li>
				</ul>
			</div>
            <?php if($brochure) : ?>
			<a target="_blank" href="<?php echo $brochure[0]; ?>">
				<div class="brochure green_buttn_arrow">
					Download Brochure
				</div>
			</a>
			<?php endif; ?>
		</div>
		<div class="listing_hero">
			<?php if (get_field('featured_image', $complex->ID)) : ?>
				<?php $featuredImage = get_field('featured_image', $complex->ID); ?>
				<img src="<?php echo $featuredImage['sizes']['thumb-940-437']; ?>" alt="<?php echo $featuredImage['alt']; ?>" />
				<?php if (get_field('featured_caption')) : ?>
					<p><?php the_field('featured_caption'); ?></p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		
		<div class="features static-info">
			<?php if (get_field('floorplan_1') || get_field('floorplan_2')) : ?>
			<div class="avail_info">
				<h3 class="garamond">Floor Plan</h3>
				<div class="plans">
					<?php if(get_field('floorplan_1')) : ?>
						<div class="plan">
							<?php $floorplan1 = get_field('floorplan_1'); ?>
							<a class="fancybox" data-fancybox-type="ajax" href="<?php bloginfo('template_url'); ?>/ajax-image.php?image=<?php echo $floorplan1['ID']; ?>"><img src="<?php echo $floorplan1['sizes']['floorplan']; ?>" alt="<?php echo $floorplan1['alt']; ?>" /></a>
							<?php if(get_field('floorplan_1_caption')) : ?>
								<p><?php the_field('floorplan_1_caption'); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					
					<?php if(get_field('floorplan_2')) : ?>
						<div class="plan">
							<?php $floorplan2 = get_field('floorplan_2'); ?>
							<a class="fancybox" data-fancybox-type="ajax" href="<?php bloginfo('template_url'); ?>/ajax-image.php?image=<?php echo $floorplan2['ID']; ?>"><img src="<?php echo $floorplan2['sizes']['floorplan']; ?>" alt="<?php echo $floorplan2['alt']; ?>" /></a>
							<?php if(get_field('floorplan_2_caption')) : ?>
								<p><?php the_field('floorplan_2_caption'); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
	
			<?php if (have_rows('complex_features', $complex->ID)) : ?>
			<div class="avail_info">
				<h3 class="garamond">Complex Features</h3>
				<div class="right_content">
					<ul class="small_dots">
						<?php while (have_rows('complex_features', $complex->ID)) : the_row(); ?>
							<li><?php the_sub_field('feature', $complex->ID); ?></li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
			<?php endif; ?>
			
			<?php
				$squareFeet = get_field('square_footage');
				if ($squareFeet >= 0 && $squareFeet <= 1000 ) {
					$amenities = get_field('range_1', 'options');
				} else if ($squareFeet > 1000 && $squareFeet <= 2500) {
					$amenities = get_field('range_2', 'options');
				} else if ($squareFeet > 2500 && $squareFeet <= 5000) {
					$amenities = get_field('range_3', 'options');
				} else if ($squareFeet > 5000 && $squareFeet <= 20000) {
					$amenities = get_field('range_4', 'options');
				}  else if ($squareFeet > 20000 && $squareFeet <= 99999999) {
					$amenities = get_field('range_5', 'options');
				}
			?>

			<?php if (have_rows('br_highlights', 'options')) : ?>
				<div class="avail_info">
					<h3 class="garamond">Bishop Ranch Highlights</h3>
					<div class="right_content">
						<ul class="small_dots">
							<?php while (have_rows('br_highlights', 'options')) : the_row(); ?>
								<li><?php the_sub_field('highlight', 'options'); ?></li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>
			
			<?php if($amenities) : ?>
				<div class="avail_info">
					<h3 class="garamond">Featured Amenities</h3>
					<div class="highlight_wrap">
						<?php foreach($amenities as $amenity) : ?>
							<div class="highlights">
								<?php $threeColConImage = get_field('amenity_image', $amenity->ID); ?>
								<a href="<?php the_field('amenity_link', $amenity->ID); ?>"><img src="<?php echo $threeColConImage['sizes']['thumb-180-135']; ?>" alt="<?php echo $threeColConImage['alt']; ?>" /></a>
								<div class="highlight_content">
									<h3><a href="<?php echo the_field('amenity_link', $amenity->ID); ?>"><?php echo $amenity->post_title; ?></a></h3>
									<?php the_field('amenity_description', $amenity->ID); ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		
		</div>
		
		<?php //get_template_part('content', 'template-3-sections'); ?>
		
		<div class="features">
			<div class="next-prev">
				<ul>
					<li><a href="<?php echo $prev_post ?>">&lt; Previous Listing</a></li>
					<li><a href="<?php echo $next_post; ?>">Next Listing &gt;</a></li>
				</ul>
			</div>
		</div>
		
		<?php if(get_field('leasing_address','options')) : ?>
		<div class="features leasing_info">
			<div class="avail_info">
				<h3 class="garamond">Bishop Ranch Leasing</h3>
				<div class="right_content">
					<?php the_field('leasing_address', 'options'); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
