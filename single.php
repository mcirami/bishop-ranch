<?php
/**
 * The Template for displaying all single posts.
 *
 * @package boiler
 */

get_header(); ?>

	
	<section class="template_8 wrapper">
		
		<article class="container">

			<?php while ( have_posts() ) : the_post(); ?>
			
				<h2 class="page_title"><?php the_title(); ?></h2>
	
				<?php get_template_part( 'content', 'single' ); ?>
	
				<?php //boiler_content_nav( 'nav-below' ); ?>
	
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						//comments_template();
				?>
	
			<?php endwhile; // end of the loop. ?>
		
		</article>
		
		<?php //get_sidebar(); ?>

	</section>

<?php get_footer(); ?>