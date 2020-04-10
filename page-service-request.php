<?php
/* Template Name: Service Request
 *
 */

get_header(); ?>

<?php 
	global $current_user;
	get_currentuserinfo();
	$user_id = $current_user->ID;
	$user_info = get_userdata($user_id);
	$user_role = implode(',', $user_info->roles);
	if(is_user_logged_in() && ($user_role === 'angus-user' || $user_role === 'administrator')) :
 ?>

<section class="page wrapper">
	<div class="container">
		<div class="top_row">
			<div class="title_row">
				<h1 class="page_title">Welcome</h1>
			</div>
			<?php get_template_part('woocommerce/content', 'account-icons'); ?>
			<div class="page_content"><?php the_content(); ?></div>
			<div class="standard_btn handbooks"><a href="#" download><p>Download Handbooks</p><img src="<?php echo bloginfo('template_url'); ?>/images/handbooks_download_icon.png"></a></div>
		</div>
        <?php require_once(get_template_directory() . '/inc/soap_call.php'); ?>
	</div>

	<?php else : ?>
	
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

	<?php endif; ?>

<?php get_footer(); ?>