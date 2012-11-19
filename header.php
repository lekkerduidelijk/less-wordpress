<?php
/**
 * @package WordPress
 * @subpackage LESS_Wordpress
 */
?><!doctype html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php wp_title('&laquo;') ?></title>
<?php
// Install Wordpress SEO plugin from Yoast for page title and meta description
// See: http://lrdk.nl/fn
?>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" type="text/css" href="<?php echo versioned_resource('/css/style.css') ?>">
<?php wp_head(); ?>
<script src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
<body <?php body_class(); ?>>
<!--[if lte IE 7]><iframe src="http://www.browserupgrade.info/ie6-upgrade/?lang=en&gc=true" frameborder="no" style="height: 81px; width: 100%; border: none;"></iframe><![endif]-->
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
