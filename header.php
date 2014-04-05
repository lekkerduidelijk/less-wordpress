<?php
/**
 * @package WordPress
 * @subpackage LESS_Wordpress
 */
?><!doctype html>
<html class="no-js">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php wp_title('&laquo;') ?></title>
<?php
// Install Wordpress SEO plugin from Yoast for page title and meta description
// See: http://lrdk.nl/fn
?>
<meta name="viewport" content="width=device-width">
<script>
  // Check for javascript support
  (function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement);

  // Check for SVG support
  (function(H){if(!!("createElementNS"in document&&document.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect)){H.className+=" svg"}else{H.className+=" no-svg"}})(document.documentElement);
</script>
<link rel="stylesheet" type="text/css" href="<?php echo versioned_resource('/css/style.css') ?>">
<?php wp_head(); ?>
<!--[if lt IE 9]>
  <script src="<?php echo versioned_resource('/js/oldbrowsers.js') ?>"></script>
<![endif]-->
<body <?php body_class(); ?>>
<div id="container">
  <header role="banner">
    <figure id="logo"><a href="<?php echo get_option('home'); ?>"><img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="<?php bloginfo('name'); ?>"></a></figure>
    <p class="description"><?php bloginfo('description'); ?></p>
    <nav id="access" role="navigation">
      <?php wp_nav_menu(array(
        'theme_location'  => 'primary',
        'container'       => '',
        'menu_class'      => ''
      )); ?>
    </nav><!-- #access -->
  </header>
