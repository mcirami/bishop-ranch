<?php
/**
 * The Template for displaying all single posts.
 *
 * @package boiler
 */

get_header(); ?>

<section class="single_listing wrapper">
	<div class="container">
		<div class="info_wrap">
			<div class="listing_info">
				<h1 class="page_title"><?php the_title(); ?><?php if (get_field('square_footage')) { echo ' - '; the_field('square_footage'); echo 'Sq. Ft.'; } ?></h1>
				<p class="address"><?php if (get_field('address_line_1')) { the_field('address_line_1'); echo ', '; } ?><?php if (get_field('address_line_2')) { the_field('address_line_2'); echo ', '; } ?><?php if (get_field('city')) { the_field('city'); echo ', '; } ?><?php if (get_field('state')) { the_field('state'); echo ' '; } ?><?php if (get_field('zip_code')) { the_field('zip_code'); } ?></p>
				<ul>
					<?php if(get_field('map_link')) : ?>
						<li><a href="<?php the_field('map_link'); ?>">View Map</a></li>
					<?php endif; ?>
					<?php if (get_field('email_link')) : ?>
						<li><a href="<?php the_field('email_link'); ?>">Email Link</a></li>
					<?php endif; ?>
				</ul>
			</div>
			<?php if(get_field('brochure')) { ?>
				<a href="<?php the_field('brochure'); ?>" download>
					<div class="brochure">
						Download Brochure
					</div>
				</a>
			<?php } ?>
		</div>
		<div class="listing_hero">
			<?php $featuredImage = get_field('featured_image'); ?>
			<img src="<?php echo $featuredImage['sizes']['thumb-940-437']; ?>" alt="<?php echo $featuredImage['alt']; ?>" />
			<?php if (get_field('featured_caption')) : ?>
				<p><?php the_field('featured_caption'); ?></p>
			<?php endif; ?>
		</div>
				
		<div class="features static-info">
	
			<?php if (have_rows('complex_features')) : ?>
			<div class="avail_info">
				<h3 class="garamond">Complex Features</h3>
				<div class="right_content">
					<ul>
						<?php while (have_rows('complex_features')) : the_row(); ?>
							<li><?php the_sub_field('feature'); ?></li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
			<?php endif; ?>
			
			<?php if(get_field('complex_amenities')) : ?>
				<?php $amenities = get_field('complex_amenities'); ?>
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
			
			<?php if (have_rows('br_highlights', 'options')) : ?>
				<div class="avail_info">
					<h3 class="garamond">Bishop Ranch Highlights</h3>
					<div class="right_content">
						<ul>
							<?php while (have_rows('br_highlights', 'options')) : the_row(); ?>
								<li><?php the_sub_field('highlight', 'options'); ?></li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>
		
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