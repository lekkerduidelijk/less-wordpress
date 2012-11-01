<?php
/**
 * @package WordPress
 * @subpackage LESS_Wordpress
 */

/*
Template Name: Links
*/
?>

<?php get_header(); ?>

<div id="content">

	<h2>Links:</h2>

	<ul>
		<?php wp_list_bookmarks(); ?>
	</ul>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
