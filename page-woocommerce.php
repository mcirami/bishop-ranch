<?php 
/* *
 * Template Name: WooCommerce Pages
 *	
 * @package boiler
 */

 get_header(); ?>

 	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 	<section class="page wrapper">
		<div class="container">
			<?php the_content(); ?>
		</div>	
	</section>
 	<?php endwhile; else: ?>
 	
 	<?php endif; ?>
	
 
 <?php get_footer(); ?>