<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package boiler
 */

get_header(); ?>

	<section class="page wrapper">
		<div class="container">
			<div class="title_row">
				<h1 class="page_title"><?php the_title(); ?></h1>
			</div>
			<?php if(get_field('top_content')) : ?>
				<div class="top_content <?php if( is_page('Bus Pass & Clipper Card Request')) { echo "form_content"; } ?>">
					<?php the_field('top_content'); ?>
				</div>
			<?php endif; ?>
			<?php get_template_part('content', 'sections'); ?>
		</div>	
	</section>

<?php get_footer(); ?>
