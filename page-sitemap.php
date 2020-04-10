<?php 
/* *
 * Template Name: Sitemap
 *	
 * @package boiler
 */

 get_header(); ?>
 
 	<div class="sitemap_content">
	 	<div class="container">
		 	<h1>Sitemap</h1>
		 	<div class="entry_content">
		 		<?php the_field('sitemap'); ?>
		 	</div>
	 	</div>
 	</div>
 
 <?php get_footer(); ?>