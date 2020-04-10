<?php 
/* *
 * Template Name: Template 3 - Medical
 */
get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php endwhile; else: ?>

<?php endif; ?>
<section class="single_listing single_space wrapper">
	<div class="container">
		<div class="info_wrap">
			<div class="listing_info">
				<h1 class="page_title"><?php the_title(); ?></h1>
			</div>
		</div>
		<div class="listing_hero">
			<?php $featuredImage = get_field('featured_image'); ?>
			<img src="<?php echo $featuredImage['sizes']['thumb-940-437']; ?>" alt="<?php echo $featuredImage['alt']; ?>" />
			<p><?php the_field('featured_caption'); ?></p>
		</div>
		
		<div class="features">
			<div class="avail_info listing_summary">
				<?php the_field('listing_summary'); ?>
			</div>

			<div class="avail_info available_spaces">
				<h3 class="garamond">Medical & Dental Spaces</h3>
				<div class="right_content">
					<ul class="available_table">
						
						<?php
							$args = array (
								'post_type' => 'listings',
								'listing-type' => 'medical-dental',
								'posts_per_page' => -1,
								'meta_query' => array(
									array(
										'key' => 'availability',
										'value' => true,
										'compare' => '='
									),
								)
							);
						
							$medical = new WP_Query($args); 
							
							if ( $medical->have_posts() ) : 
						?>
						
						<li class="available_label">
							<ul>
								<li class="complex">Complex</li>
								<li class="suite">Suite</li>
								<li class="floor">Floor</li>
								<li class="square_feet">Sq. Ft.</li>
								<li class="address">Address</li>
							</ul>
						</li>
						
						<?php while( $medical->have_posts() ) : $medical->the_post(); ?>
						<?php $complex = get_field('complex'); ?>
						
						<li class="available_item">
							<a href="<?php the_permalink(); ?>">
								<ul>
									<li class="complex"><?php echo $complex->post_title; ?><?php if(get_field('coming_soon')) { echo '**'; } ?></li>
									<li class="suite"><?php the_field('suite_number'); ?></li>
									<li class="floor"><?php the_field('floor'); ?></li>
									<li class="square_feet"><?php the_field('square_footage'); ?></li>
									<li class="address"><?php the_field('address_line_1'); ?></li>
								</ul>
							</a>
						</li>
						
						<?php endwhile; wp_reset_postdata(); ?> 
						</ul>
						<?php if(get_field('disclaimer_one')) { ?>
							<p class="disclaimer_one disclaimer">*<?php the_field('disclaimer_one'); ?></p>
						<?php } ?>
						<?php $infoPhone = get_field('call_for_info_phone_#', 'options'); ?>
						<?php if($infoPhone) : ?>
							<a class="info_number" href="tel:<?php echo $infoPhone; ?>"><div class="call_for_info"><?php echo $infoPhone; ?></div></a>
						<?php endif; ?>
						<?php if(get_field('disclaimer_two')) { ?>
							<p class="disclaimer_two disclaimer">**<?php the_field('disclaimer_two'); ?></p>
						<?php } ?>
							
					<?php else: ?>
							<li class="available_item">No listings available</li>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
		
		<?php get_template_part('content', 'template-3-sections'); ?>
		
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