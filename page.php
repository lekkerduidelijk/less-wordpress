<?php
/**
 * @package WordPress
 * @subpackage LESS_Wordpress
 */
get_header(); ?>
<div role="main">
  <div id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article class="post" id="post-<?php the_ID(); ?>">
        <header>
          <h1><?php the_title(); ?></h1>
        </header>
        <?php the_content(); ?>
      </article>
    <?php endwhile; endif; ?>
    <?php edit_post_link(__("Edit this entry","lwp"), "<p>", "</p>"); ?>
    <?php comments_template(); ?>
  </div>
  <?php get_sidebar(); ?>
</div> <!-- [role=main] -->
<?php get_footer(); ?>
