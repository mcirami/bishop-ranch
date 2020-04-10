<?php
/**
 * Template Name: Edit Account
 */
 
if ( !is_user_logged_in() ) {
	wp_safe_redirect( get_permalink( wc_get_page_id( 'myaccount' ) ) );
}

get_header(); ?>

	<section class="page wrapper">
		<div class="container">
			<div class="top_row">
				<div class="title_row">
					<h1 class="page_title">Welcome</h1>
				</div>
				<?php get_template_part('woocommerce/content', 'account-icons'); ?>
				<div class="page_content"><?php the_content(); ?></div>
			</div>
			<section class="profile_section">
				
				<?php wc_get_template( 'myaccount/form-edit-account.php', array( 'user' => get_user_by( 'id', get_current_user_id() ) ) ); ?>
			
			</section>
		</div>	
	</section>

<?php get_footer(); ?>
