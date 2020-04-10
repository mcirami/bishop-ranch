<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package boiler
 */

get_header(); ?>

	<section class="page_404">
		<div class="container">
			<div class="content">
				<article id="post-0" class="post not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Sorry that page can&rsquo;t be found.', 'boiler' ); ?></h1>
					</header>
	
					<div class="entry-content">
						<p><?php _e( 'A page does not exist at this location. Try one of the links above or do a search:', 'boiler' ); ?></p>
	
						<?php get_search_form(); ?>
	
					</div>
				</article>
			</div>
		</div>
	</section>

<?php get_footer(); ?>