<?php
/* 
 * De-register default WP jQuery
 *  
 * This function de-registers WordPress's default jQuery version,
 * and reg/enq's the latest version via Google's CDN.
 * 
*/
if (!is_admin()) {
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"), false);
	wp_enqueue_script('jquery');
}


/* 
 * Register and enqueue scripts and styles
 *  
 * Use this function to register BOTH styles and scripts in your
 * theme. The project stylesheet is already done for you. This
 * elimiates the need to include the files manually in the <head>.
 * 
*/
function skratch_scripts() {
  wp_enqueue_style( 'stylesheet', get_stylesheet_uri() );  
}

add_action( 'wp_enqueue_scripts', 'skratch_scripts' );



/* 
 * Register custom menus
 *  
 * When creating menus via WordPress, name the menu to be used
 * in the header "header-nav" and the menu to be used in the
 * footer, if different, "footer-nav" in order for this to work
 * properly.
 * 
*/
function register_custom_menus() {
  register_nav_menus(
    array(
      'header-nav' => __( 'Header Navigation' ),
      'footer-nav' => __( 'Footer Navigation' )
    )
  );
}

add_action( 'init', 'register_custom_menus' );


/* 
 * Remove junk from head
 *  
 * We recommend you keep this section to remove the junk actions
 * that WP automatically includes in wp_head. Delete lines if you
 * will need to make use of those specific functions.
 * 
*/
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

?>
