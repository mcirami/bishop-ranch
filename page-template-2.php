<?php 
/* Template Name: Template 2
 *
 */

get_header(); ?>

<section class="customer_resources wrapper">
	<div class="container">
		<h1 class="page_title"><?php the_title(); ?></h1>
	</div>
		<?php get_template_part('content', 'template-2-sections'); ?>
</section>

<?php get_footer(); ?>