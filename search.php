<?php
/**
 * Template Name: Search Page
 *
 * @package boiler
 */

get_header(); ?>


	<section class="template_8 wrapper">
	
		<div class="container">

            <h2 class="page_title">Search Results: <?php echo get_search_query(); ?></h2>

                <div class="single_post">

                </div><!-- end of single post -->

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php boiler_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

		</div><!-- end of container -->
		
	</section>

<?php get_footer(); ?>