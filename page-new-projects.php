<?php 
/* *
 * Template Name: New Projects
 */
get_header(); ?>

<section class="press_releases wrapper">
	<div class="container">
		<div class="title_row">
			<h1 class="page_title"><?php the_title(); ?></h1>
		</div>
		<?php if(get_field('top_content')) : ?>
			<div class="top_content">
				<?php the_field('top_content'); ?>
			</div>
		<?php endif; ?>
		<div class="press_release_wrap">
			
			<?php
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array (
					'post_type' => 'new-projects',
					'posts_per_page' => '5',
					'order' => 'ASC',
					'paged' => $paged
				);
			
				query_posts($args);
			
				while( have_posts() ) : the_post();
			?>
			
			<div class="press_release">
				<div class="pr_image">
					<?php the_post_thumbnail(); ?>
				</div>
				<div class="pr_content">
					<p class="garamond date"><?php the_time('j F Y'); ?></p>
					<h2><?php the_title(); ?></h2>
					<p><?php the_excerpt(); ?></p>
					<a class="read_full" href="<?php the_permalink(); ?>">Read Full Story</a>
				</div>
			</div>
			
			<?php endwhile; ?>
			<div class="pagination">
				<?php br_pagination(); ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>