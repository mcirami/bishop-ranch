<?php 
/**
* Template for calendar month	
*/
	
get_header(); ?>


	<section class="calendar wrapper">
		
		<article class="container">
			
			<div class="single_header">
				<h2 class="page_title">Events Calendar</h2>
                <?php $headerContent = get_field('header_content', 'options'); ?>
				<h3><?php echo $headerContent; ?></h3>
			</div>

			<?php tribe_get_template_part( 'month/content' ); ?>
			
		</article>
		
	</section>

<?php get_footer(); ?>