<?php
/**
 * boiler functions and definitions
 *
 * @package boiler
 */

if ( ! function_exists( 'boiler_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function boiler_setup() {

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'boiler' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // boiler_setup
add_action( 'after_setup_theme', 'boiler_setup' );

// add parent class to menu items 
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {

	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'parent-item'; 
		}
	}
	
	return $items;
}

	
/* remove some of the header bloat */

// EditURI link
remove_action( 'wp_head', 'rsd_link' );
// windows live writer
remove_action( 'wp_head', 'wlwmanifest_link' );
// index link
remove_action( 'wp_head', 'index_rel_link' );
// previous link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
// start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
// links for adjacent posts
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
// WP version
remove_action( 'wp_head', 'wp_generator' );

// remove pesky injected css for recent comments widget
add_filter( 'wp_head', 'boiler_remove_wp_widget_recent_comments_style', 1 );
// clean up comment styles in the head
add_action('wp_head', 'boiler_remove_recent_comments_style', 1);
// clean up gallery output in wp
add_filter('gallery_style', 'boiler_gallery_style');

// Thumbnail image sizes
// add_image_size( 'thumb-400', 400, 400, true );
add_image_size( 'thumb-180-135', 180, 135, true );
add_image_size( 'thumb-180-150', 180, 150, true );
add_image_size( 'thumb-277-190', 277, 190, true );
add_image_size( 'floorplan', 277, 190, false );
add_image_size( 'thumb-940-437', 940, 437, true );
add_image_size( 'thumb-214-131', 214, 131, true );
add_image_size( 'thumb-322-201', 322, 201, true );
add_image_size( 'thumb-460-214', 460, 214, true );
add_image_size( 'thumb-940-300', 940, 300, true );
add_image_size( 'thumb-300-150', 300, 150, true );


// remove injected CSS for recent comments widget
function boiler_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function boiler_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function boiler_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/**
 * Register widgetized area and update sidebar with default widgets
 */
function boiler_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'boiler' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'boiler_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function boiler_scripts_styles() {
	// style.css just initializes the theme. This is compiled from /sass
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/css/main.css');
	
	wp_enqueue_style( 'flexslider-css', get_template_directory_uri() . '/css/flexslider.css');
	
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css');
	
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/idangerous.swiper.css');

	wp_enqueue_script( 'jquery' , array(), '', true );
	
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/vendor/flexslider/jquery.flexslider-min.js', array(), '', true );
	
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.pack.js', array('jquery'), '', true );
	
	wp_enqueue_script( 'rwdimages', get_template_directory_uri() . '/js/vendor/jquery.rwdImageMaps.min.js', array('jquery'), '', true );
	
	wp_enqueue_script( 'ddslick', get_template_directory_uri() . '/js/vendor/jquery.ddslick.min.js', array(), '', true );
	
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/vendor/idangerous.swiper.js', array(), '', true );
	
	//wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2.min.js', '2.6.2', true );

	//wp_enqueue_script( 'boiler-plugins', get_template_directory_uri() . '/js/plugins.js', array(), '20120206', true );

	//wp_enqueue_script( 'boiler-main', get_template_directory_uri() . '/js/main.js', array(), '20120205', true );
	
	// Return concatenated version of JS. If you add a new JS file add it to the concatenation queue in the gruntfile. 
	// current files: js/vendor.mordernizr-2.6.2.min.js, js/plugins.js, js/main.js
	wp_enqueue_script( 'boiler-concat', get_template_directory_uri() . '/js/built.js', array(), '', true );

}
add_action( 'wp_enqueue_scripts', 'boiler_scripts_styles' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom Short Codes
 */
require get_template_directory() . '/inc/short-codes.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom post type and taxonomy initialization
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// Auto wrap embeds with video container to make video responsive
function wrap_embed_with_div($html, $url, $attr) {
     return '<div class="video_container">' . $html . '</div>';
}

add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);

function br_pagination() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    for($i = 3; $i > 0; $i--){
    	if(($paged + $i) <= $max){
    		$links[] = $paged + $i;
    	}
    }

    echo '<div class="navigation"><ul>' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() ) {
        printf( '<li class="prev_btn">%s</li>' . "\n", get_previous_posts_link('<') );
    } else {
        printf( '<li class="prev_btn_disabled"><</li>' . "\n");
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s<span></span></a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Next Post Link */
    if ( get_next_posts_link() ) {
        printf( '<li class="next_btn">%s</li>' . "\n", get_next_posts_link('More >') );
    } else {
        printf( '<li class="next_btn_disabled">More ></li>' . "\n");
    }

    echo '</ul></div>' . "\n";

}


/**
* Advanced Custom Fields Option Page
*/

if( function_exists('acf_add_options_page') ) {
 
	acf_add_options_page('Transportation Alerts');
	acf_add_options_page('Amenity to Square Feet');
	acf_add_options_page('Bishop Ranch Highlights');
	acf_add_options_page('Leasing Info');
	acf_add_options_page('Options');
}

/**
* Automation for Business Directory Alphabetical Indexing
*/

function alphaindex_save_alpha( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	return;
	//only on business posts
	$slug = 'business';
	$letter = '';
	// If this isn't a 'business' post, don't update it.
	if ( isset( $_POST['post_type'] ) && $slug != $_POST['post_type'] )
	return;
	// Check permissions
	if ( !current_user_can( 'edit_post', $post_id ) )
	return;
	// Permission to update post granted; continue
	$taxonomy = 'alpha';
	if ( isset( $_POST['post_type'] ) ) {
		
		if ( isset( $_POST['acf']['field_548b2fbf7dbf9'])) {
			$customalpha = $_POST['acf']['field_548b2fbf7dbf9'];
			if($customalpha) {
				if ( isset( $_POST['acf']['field_548b2fdf7dbfa'])) {
					$letter = $_POST['acf']['field_548b2fdf7dbfa'];
					if(is_numeric($letter)) {
						$letter = '1-9';
					}
				}
			} else {
				// Get the title of the post
				$title = strtolower( $_POST['post_title'] );
				
				// The next lines remove A or the from the start of the title
				$splitTitle = explode(" ", $title);
				$blacklist = array('the');
				$splitTitle[0] = str_ireplace($blacklist,"",strtolower($splitTitle[0]));
				if($splitTitle[0] === "" || strtolower($splitTitle[0]) === 'a') {
					$empty_character = array_shift($splitTitle);
				}
				$title = implode(" ", $splitTitle);
				
				// Get the first letter of the title
				$letter = substr( $title, 0, 1 );
				$letter = strtoupper($letter);
				// Set to 1-9 if it's a number
				if ( is_numeric( $letter ) ) {
					$letter = '1-9';
				}
			}
		} else {
			// Get the title of the post
			$title = strtolower( $_POST['post_title'] );
			
			// The next lines remove A or the from the start of the title
			$splitTitle = explode(" ", $title);
			$blacklist = array('the');
			$splitTitle[0] = str_ireplace($blacklist,"",strtolower($splitTitle[0]));
			if($splitTitle[0] === "" || strtolower($splitTitle[0]) === 'a') {
				$empty_character = array_shift($splitTitle);
			}
			$title = implode(" ", $splitTitle);
			
			// Get the first letter of the title
			$letter = substr( $title, 0, 1 );
			$letter = strtoupper($letter);
			// Set to 1-9 if it's a number
			if ( is_numeric( $letter ) ) {
				$letter = '1-9';
			}
		}
	}
	//set term as first letter of post title, lower case
	wp_set_post_terms( $post_id, $letter, $taxonomy );
}
add_action( 'save_post', 'alphaindex_save_alpha' );

/**
* Adding Registration fields to the form 
*/
add_filter( 'register_form', 'adding_custom_registration_fields' );
function adding_custom_registration_fields() {

	echo '<div class="form-row form-row-wide"><label for="reg_firstname">'.__('First Name', 'woocommerce').' <span class="required">*</span></label>
<input type="text" class="input-text" name="firstname" id="reg_firstname" size="30" value="'.esc_attr($_POST['firstname']).'" /></div>';

	echo '<div class="form-row form-row-wide"><label for="reg_lastname">'.__('Last Name', 'woocommerce').' <span class="required">*</span></label>
<input type="text" class="input-text" name="lastname" id="reg_lastname" size="30" value="'.esc_attr($_POST['lastname']).'" /></div>';

echo '<p class="form-row form-row-wide"><label for="reg_email">' . __( 'Email', 'woocommerce' ) . 
				'<span class="required">*</span></label>
				<input type="email" class="input-text" name="email" id="reg_email" value="' .  esc_attr( $_POST['email'] )  .  '"/></p>';
			
	echo '<div class="form-row form-row-wide">
<input type="checkbox" name="permission" id="permission" size="30" /><label for="permission">'.__('Need permission to submit request', 'woocommerce').'</label></div>';

	echo '<p class="login_bottom_text">You will be sent an e-mail containing your unique login credentials.</p>';

}

//Validation registration form  after submission using the filter registration_errors
add_filter('registration_errors', 'registration_errors_validation', 10,3);
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
		global $woocommerce;
		extract($_POST); // extracting $_POST into separate variables
		if($firstname == '' || $lastname == '') {
			$woocommerce->add_error( __( 'Please, fill in all the required fields.', 'woocommerce' ) );
		}
		return $reg_errors;
}

//Updating use meta after registration successful registration
add_action('woocommerce_created_customer','adding_extra_reg_fields');

function adding_extra_reg_fields($user_id) {
	extract($_POST);
	update_user_meta($user_id, 'first_name', $firstname);
	update_user_meta($user_id, 'last_name', $lastname);
	
}

//remove_action( 'template_redirect', array('WC_Form_Handler', 'save_account_details') );
add_action( 'template_redirect', 'bishopranch_update_account_details' );

/**
 * Save the password/account details and redirect back to the my account page.
 */
function bishopranch_update_account_details() {

	if ( 'POST' !== strtoupper( $_SERVER[ 'REQUEST_METHOD' ] ) ) {
		return;
	}

	if ( empty( $_POST[ 'action' ] ) || ( 'bishopranch_update_account_details' !== $_POST[ 'action' ] ) || empty( $_POST['_wpnonce'] ) ) {
		return;
	}

	wp_verify_nonce( $_POST['_wpnonce'], 'bishopranch_update_account_details' );

	$update       = true;
	$errors       = new WP_Error();
	$user         = new stdClass();

	$user->ID     = (int) get_current_user_id();
	$current_user = get_user_by( 'id', $user->ID );

	if ( $user->ID <= 0 ) {
		return;
	}

	//$account_first_name = ! empty( $_POST[ 'account_first_name' ] ) ? wc_clean( $_POST[ 'account_first_name' ] ) : '';
	$account_name  = ! empty( $_POST[ 'account_name' ] ) ? wc_clean( $_POST[ 'account_name' ] ) : '';
	$account_building  = ! empty( $_POST[ 'account_building' ] ) ? wc_clean( $_POST[ 'account_building' ] ) : '';
	$account_floor_suite  = ! empty( $_POST[ 'account_floor_suite' ] ) ? wc_clean( $_POST[ 'account_floor_suite' ] ) : '';
	$account_company  = ! empty( $_POST[ 'account_company' ] ) ? wc_clean( $_POST[ 'account_company' ] ) : '';
	$account_title  = ! empty( $_POST[ 'account_title' ] ) ? wc_clean( $_POST[ 'account_title' ] ) : '';
	
	$account_phone  = ! empty( $_POST[ 'account_phone' ] ) ? wc_clean( $_POST[ 'account_phone' ] ) : '';
	$account_fax  = ! empty( $_POST[ 'account_fax' ] ) ? wc_clean( $_POST[ 'account_fax' ] ) : '';
	$account_email      = ! empty( $_POST[ 'account_email' ] ) ? sanitize_email( $_POST[ 'account_email' ] ) : '';
	$account_cc  = ! empty( $_POST[ 'account_cc' ] ) ? wc_clean( $_POST[ 'account_cc' ] ) : '';
	
	$account_emergency_phone_one  = ! empty( $_POST[ 'account_emergency_phone_one' ] ) ? wc_clean( $_POST[ 'account_emergency_phone_one' ] ) : '';
	$account_emergency_phone_two  = ! empty( $_POST[ 'account_emergency_phone_two' ] ) ? wc_clean( $_POST[ 'account_emergency_phone_two' ] ) : '';
	$account_emergency_email  = ! empty( $_POST[ 'account_emergency_email' ] ) ? sanitize_email( $_POST[ 'account_emergency_email' ] ) : '';
	$account_emergency_sms  = ! empty( $_POST[ 'account_emergency_sms' ] ) ? wc_clean( $_POST[ 'account_emergency_sms' ] ) : '';
	
	$account_permission_submit  = ! empty( $_POST[ 'account_permission_submit_requests' ] ) ? wc_clean( $_POST[ 'account_permission_submit_requests' ] ) : '';
	$account_permission_view  = ! empty( $_POST[ 'account_permission_view_requests' ] ) ? wc_clean( $_POST[ 'account_permission_view_requests' ] ) : '';
	$account_permission_subscribe  = ! empty( $_POST[ 'account_permission_subscribe' ] ) ? wc_clean( $_POST[ 'account_permission_subscribe' ] ) : '';

	$pass_cur           = ! empty( $_POST[ 'password_current' ] ) ? $_POST[ 'password_current' ] : '';
	$pass1              = ! empty( $_POST[ 'password_1' ] ) ? $_POST[ 'password_1' ] : '';
	$pass2              = ! empty( $_POST[ 'password_2' ] ) ? $_POST[ 'password_2' ] : '';
	$save_pass          = true;

	//$user->first_name   = $account_first_name;
	//$user->last_name    = $account_last_name;
	//$user->user_email   = $account_email;
	//$user->display_name = $user->first_name;

	/*if ( empty( $account_name ) ) {
		wc_add_notice( __( 'Please enter Your name.', 'woocommerce' ), 'error' );
	}

	if ( empty( $account_email ) || ! is_email( $account_email ) ) {
		wc_add_notice( __( 'Please provide a valid email address.', 'woocommerce' ), 'error' );
	} elseif ( email_exists( $account_email ) && $account_email !== $current_user->user_email ) {
		wc_add_notice( __( 'This email address is already registered.', 'woocommerce' ), 'error' );
	}*/

	if ( ! empty( $pass1 ) && ! wp_check_password( $pass_cur, $current_user->user_pass, $current_user->ID ) ) {
		wc_add_notice( __( 'Your current password is incorrect.', 'woocommerce' ), 'error' );
		$save_pass = false;
	}

	if ( ! empty( $pass_cur ) && empty( $pass1 ) && empty( $pass2 ) ) {
		wc_add_notice( __( 'Please fill out all password fields.', 'woocommerce' ), 'error' );

		$save_pass = false;
	} elseif ( ! empty( $pass1 ) && empty( $pass_cur ) ) {
		wc_add_notice( __( 'Please enter your current password.', 'woocommerce' ), 'error' );

		$save_pass = false;
	} elseif ( ! empty( $pass1 ) && empty( $pass2 ) ) {
		wc_add_notice( __( 'Please re-enter your password.', 'woocommerce' ), 'error' );

		$save_pass = false;
	} elseif ( ! empty( $pass1 ) && $pass1 !== $pass2 ) {
		wc_add_notice( __( 'Passwords do not match.', 'woocommerce' ), 'error' );

		$save_pass = false;
	}

	if ( $pass1 && $save_pass ) {
		$user->user_pass = $pass1;
	}
	
	$user_field = 'user_'.$user->ID;
	update_field('field_546a5ee0b2a8a', $account_name, $user_field);
	update_field('field_546a46c977037', $account_building, $user_field);
	update_field('field_546a46d377038', $account_floor_suite, $user_field);
	update_field('field_546a46e477039', $account_company, $user_field);
	update_field('field_546a46eb7703a', $account_title, $user_field);
	update_field('field_546a58d5a4c47', $account_phone, $user_field);
	update_field('field_546a58dfa4c48', $account_fax, $user_field);
	update_field('field_546a58e4a4c49', $account_email, $user_field);
	update_field('field_546a58f1a4c4a', $account_cc, $user_field);
	update_field('field_546a58f7a4c4b', $account_emergency_phone_one, $user_field);
	update_field('field_546a5904a4c4c', $account_emergency_phone_two, $user_field);
	update_field('field_546a590ea4c4d', $account_emergency_email, $user_field);
	update_field('field_546a5917a4c4e', $account_emergency_sms, $user_field);
	update_field('field_546a5925a4c4f', $account_permission_submit, $user_field);
	update_field('field_546a593ca4c50', $account_permission_view, $user_field);
	update_field('field_546a594ea4c51', $account_permission_subscribe, $user_field);
	

	// Allow plugins to return their own errors.
	do_action_ref_array( 'user_profile_update_errors', array ( &$errors, $update, &$user ) );

	if ( $errors->get_error_messages() ) {
		foreach ( $errors->get_error_messages() as $error ) {
			wc_add_notice( $error, 'error' );
		}
	}

	if ( wc_notice_count( 'error' ) === 0 ) {

		wp_update_user( $user ) ;

		wc_add_notice( __( 'Account details changed successfully.', 'woocommerce' ) );

		do_action( 'woocommerce_save_account_details', $user->ID );

		wp_safe_redirect( get_permalink( wc_get_page_id( 'myaccount' ) ) );
		exit;
	}
}

add_action('wp_enqueue_scripts', 'br_payment_scripts');

function br_payment_scripts() {
	if(is_page('Payment')) {
		wp_enqueue_script( 'wc-add-payment-method', WP_PLUGIN_URL . '/woocommerce/assets/js/frontend/add-payment-method.min.js', array( 'jquery', 'woocommerce' ), false, 1 );
	}
}

/**
 * Add a 1% surcharge to your cart / checkout
 * change the $percentage to set the surcharge to a value to suit
 * Uses the WooCommerce fees API
 *
 * Add to theme functions.php
 */
add_action( 'woocommerce_cart_calculate_fees','woocommerce_custom_surcharge' );
function woocommerce_custom_surcharge() {
  global $woocommerce;
  	$subscriptionIncluded = false;
	if ( is_admin() && ! defined( 'DOING_AJAX' ) )
		return;
	$cartItems = $woocommerce->cart->cart_contents;
	
	foreach ($cartItems as $item) {
		if ($item['data']->product_type === 'subscription') {
			$subscriptionIncluded = true;
		}
	}
	
	if ($subscriptionIncluded) {
		$percentage = 0.029;
		$surcharge = ( $woocommerce->cart->cart_contents_total + $woocommerce->cart->shipping_total ) * $percentage +.30;	
		$woocommerce->cart->add_fee( 'Convenience Fee', $surcharge, true, 'standard' );
	}
}
// Custom Login Screen
function br_loginlogo() {
    echo '<style type="text/css">
        h1 a {
        background-image: url(' . get_template_directory_uri() . '/images/site-login-logo.png) !important;
        background-size: 100% !important;
        width: 100% !important;
        }
        </style>';
}
add_action('login_head', 'br_loginlogo');

// Login Image URL
function br_loginURL () {
    return '/';
}
add_filter('login_headerurl', 'br_loginURL');

add_filter('woocommerce_login_redirect', 'br_login_redirect');
function br_login_redirect( $redirect_to ) {
	$pageID = 19;
	$redirect_to = '/';
    if(is_page('checkout')) {
	    $redirect_to = get_permalink($pageID);
    } else {
	    $redirect_to = get_permalink(20);
    }
    return $redirect_to;
}
