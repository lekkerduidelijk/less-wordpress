<?php
/**
 * Template name: Homepage
 * @package WordPress
 * @subpackage LESS_WordPress
 */
get_header(); ?>
<div class="wrap">
  <main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article class="post" id="post-<?php the_ID(); ?>">
        <header>
          <?php /* Homepage has H1 on .branding */ ?>
          <h2><?php the_title(); ?></h2>
        </header>
        <?php the_content(); ?>
      </article>
    <?php endwhile; endif; ?>
    <?php edit_post_link(__("Edit this entry","lwp"), "<p>", "</p>"); ?>
    <?php comments_template(); ?>
  </main>
  <?php get_sidebar(); ?>
</div>
<?php get_footer();
