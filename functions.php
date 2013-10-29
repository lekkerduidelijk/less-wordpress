<?php
/**
 * @package WordPress
 * @subpackage LESS_Wordpress
 *
 * Credits for most of this file go to Walker Hamiltons work on his Wordpress
 * theme html5-boilerplate-for-wordpress.
 * https://github.com/walker/html5-boilerplate-for-wordpress
 */

if(!function_exists("lwp_setup")) {
  function lwp_setup(){
    if(function_exists( "register_nav_menu")) {
      add_theme_support("menus");
      register_nav_menu("primary", __("Primary navigation", "lwp"));
      register_nav_menu("footer",  __("Footer navigation",  "lwp"));
    }

    // Widgetized Sidebar HTML5 Markup
    if ( function_exists("register_sidebar") ) {
      register_sidebar(array(
        "name"          => "Sidebar",
        "before_widget" => "<section class='widget'>",
        "after_widget"  => "</section>",
        "before_title"  => "<h2>",
        "after_title"   => "</h2>"
      ));
    }

    // Get language files for theme
    $locale = get_locale();
    $locale_file = TEMPLATEPATH . "/languages/$locale.php";
    if (is_readable( $locale_file ) )
      require_once( $locale_file );

    add_theme_support( "post-thumbnails" );
    load_theme_textdomain( "lwp", TEMPLATEPATH . "/languages" );
  }
}

if(!function_exists("lwp_init")) {
  function lwp_init(){
    remove_action( "wp_head", "wp_shortlink_wp_head" );                   // Shortlinks for articles
    remove_action( "wp_head", "wp_generator" );                           // "Generated by Wordpress"
    remove_action( "wp_head", "feed_links_extra", 3 );                    // Category Feeds
    remove_action( "wp_head", "feed_links", 2 );                          // Post and Comment Feeds
    remove_action( "wp_head", "rsd_link" );                               // EditURI link
    remove_action( "wp_head", "wlwmanifest_link" );                       // Windows Live Writer
    remove_action( "wp_head", "index_rel_link" );                         // index link
    remove_action( "wp_head", "parent_post_rel_link", 10, 0 );            // previous link
    remove_action( "wp_head", "start_post_rel_link", 10, 0 );             // start link
    remove_action( "wp_head", "adjacent_posts_rel_link_wp_head", 10, 0 ); // Links for Adjacent Posts

    if(!is_admin()) {
      wp_enqueue_script("jquery");
    }
  }
}
add_action( "after_setup_theme", "lwp_setup" );
add_action( "init", "lwp_init" );

// Add ?v=[last modified time] to a file url
if(!function_exists('versioned_resource')) {
  function versioned_resource($relative_url) {
    $file = dirname(__FILE__).$relative_url;
    $file_version = "";

    if(file_exists($file)) {
      $file_version = "?v=".filemtime($file);
    }

    return get_bloginfo('template_url').$relative_url.$file_version;
  }
}

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function lwp_excerpt_length( $length ) {
  return 40;
}
add_filter( 'excerpt_length', 'lwp_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function lwp_continue_reading_link() {
  return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading', 'lwp' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and lwp_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function lwp_auto_excerpt_more( $more ) {
  return ' &hellip;' . lwp_continue_reading_link();
}
add_filter( 'excerpt_more', 'lwp_auto_excerpt_more' );

/**
 * Deletes all CSS classes and id's, except for those listed in the array below
 */
function lwp_wp_nav_menu($var) {
  return is_array($var) ? array_intersect($var, array(
    //List of allowed menu classes
    'current_page_item',
    'current_page_parent',
    'current_page_ancestor',
    'first',
    'last',
    'vertical',
    'horizontal'
    )
  ) : '';
}
add_filter('nav_menu_css_class', 'lwp_wp_nav_menu');
add_filter('nav_menu_item_id', 'lwp_wp_nav_menu');
add_filter('page_css_class', 'lwp_wp_nav_menu');

/**
 * Replaces "current-menu-item" with "active"
 */
function lwp_current_to_active($text){
  $replace = array(
    //List of menu item classes that should be changed to "active"
    'current_page_item'     => 'active',
    'current_page_parent'   => 'active_parent',
    'current_page_ancestor' => 'active_ancestor',
  );
  $text = str_replace(array_keys($replace), $replace, $text);
  return $text;
}
add_filter ('wp_nav_menu','lwp_current_to_active');

/**
 * Deletes empty classes and removes the sub menu class
 */
function lwp_strip_empty_classes($menu) {
  $menu = preg_replace('/ class=""| class="sub-menu"/','',$menu);
  return $menu;
}
add_filter ('wp_nav_menu','lwp_strip_empty_classes');

/**
 * Give editor role full access to Gravity Forms in admin
 */
function lwp_add_gf_access(){
  $role = get_role('editor');
  $role->add_cap('gform_full_access');
}
add_action('admin_init','lwp_add_gf_access');

/**
 * Check if post is a blog post
 * https://gist.github.com/wesbos/1189639
 */
function is_blog () {
  global  $post;
  $posttype = get_post_type($post );
  return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

/**
 * Partial helper
 * Loads partials from the partials folder
 */
function lwp_partial($partial) {
  locate_template('partials/'.$partial.'.php',true);
}

/**
 * Header image helper
 * Get a header image for the current page (works only for pages)
 */
function lwp_get_header_image_src() {
  global $post;

  // Default
  $header_image_src =  get_bloginfo('template_url').'/img/header-default.jpg';

  // Do we have a featured image ?
  if(has_post_thumbnail($post->ID)) {
    $header_image_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
  } else {
    // Walk up the tree
    $ancestors = get_ancestors($post->ID,'page');
    foreach($ancestors as $ancestor) {
      if(has_post_thumbnail($ancestor)) {
        $header_image_src = wp_get_attachment_url( get_post_thumbnail_id($ancestor) );
        break; // We have our image
      }
    }
  }
  return $header_image_src;
}
