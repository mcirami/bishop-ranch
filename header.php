<?php
/**
 * The Header for our theme.
 *
 * @package boiler
 */

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1" />

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="//use.typekit.net/xms6qbe.js"></script>
<script>try{Typekit.load();}catch(e){}</script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
	
	<header id="global_header">
		<div class="container">
			<div class="header_top">
				<div class="logo">
					<a href="/">Bishop Ranch</a>
				</div>
				<div class="mobile_menu_btn"><img src="<?php echo bloginfo('template_url'); ?>/images/mobile_menu_icon.png" /></div>
				<div class="secondary_nav">
					<ul>
						<?php if(have_rows('top_header_links', 'options')) : ?>
							<?php while(have_rows('top_header_links', 'options')) : the_row(); ?>
								<li><a href="<?php the_sub_field('page_link', 'options'); ?>"><?php the_sub_field('link_title', 'options'); ?></a></li>		
							<?php endwhile; ?>
						<?php endif; ?>	
						<?php if(is_user_logged_in()) : ?>
							<li class="profile_link"><a href="/profile"><img src="<?php echo bloginfo('template_url'); ?>/images/header_profile_icon.png" /></a></li>
							<li class="log_out_link"><a href="<?php echo wp_logout_url( '/' ); ?>">Logout</a></li>
						<?php else : ?>
							<li><a href="#login" class="log_in button_hover">Log In</a></li>
						<?php endif; ?>
					</ul>
                    <form method="get" id="search" action="<?php bloginfo('url'); ?>">
                        <input type="hidden" name="submit" value="Search">
                        <input class="search" type="text" value=""  name="s" id="s" onblur="if (this.value == '') {this.value = '<?php echo $search_text; ?>';}" onfocus="if (this.value == '<?php echo $search_text; ?>') {this.value = '';}">
                    </form>
				</div><!-- end of secondary nav -->
			</div>
			<nav role="navigation" class="tablet_menu">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'header_menu' ) ); ?>
			</nav>
			<div class="mobile_menu">
				<form method="get" id="mobile_search" action="<?php bloginfo('url'); ?>">
                        <input type="hidden" name="submit" value="Search">
                        <input class="search" type="text" value=""  name="s" id="s" onblur="if (this.value == '') {this.value = '<?php echo $search_text; ?>';}" onfocus="if (this.value == '<?php echo $search_text; ?>') {this.value = '';}">
                </form>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'mobile_header_menu' ) ); ?>
				<div class="mobile_menu_buttons">
					<div class="request_form_link standard_btn"><a href="">Request Form</a></div>
					<?php if(is_user_logged_in()) : ?>
						<div class="mobile_prof_link"><img src="<?php echo bloginfo('template_url'); ?>/images/header_profile_icon.png" /><a href="/profile">Profile</a></div>
						<div class="mobile_log_out"><a href="<?php echo wp_logout_url( '/' ); ?>">Log Out</a></div>
					<?php else : ?>
						<div class="standard_btn"><a href="#login" class="log_in">Log In</a></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</header>