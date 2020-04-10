<?php
/**
 * The Template for displaying all events posts.
 *
 * @package boiler
 */

get_header(); ?>

	
	<section class="press_release wrapper">
		
		<article class="container">
			
			<div class="single_header">
				<h2 class="page_title"><?php the_title(); ?></h2>
				<div class="second_line">
					<h3 class="byline"><?php the_field('byline'); ?></h3>
					<h3 class="publish_date"><?php the_date('j M Y'); ?></h3>
				</h3>
			</div>

			<?php while ( have_posts() ) : the_post(); ?>
	
				<?php get_template_part( 'content', 'single' ); ?>
	
			<?php endwhile; // end of the loop. ?>
		
		</article>

	</section>

<?php get_footer(); ?>