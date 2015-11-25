<?php
/**
 * @package WordPress
 * @subpackage LESS_WordPress
 */

get_header(); ?>
<div class="wrap">
  <main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
        <header>
          <h1><?php the_title(); ?></h1>
          <time datetime="<?php the_time('c'); ?>"><?php the_date(); ?></time>
        </header>
        <?php the_content(); ?>
        <nav>
          <div><?php previous_post_link('&laquo; %link') ?></div>
          <div><?php next_post_link('%link &raquo;') ?></div>
        </nav>
        <?php comments_template(); ?>
      </article>
    <?php endwhile; else: ?>
      <article>
        <header>
          <h1><?php _e("No posts","lwp") ?></h1>
        </header>
        <p>
          <?php _e("Sorry, no posts matched your criteria","lwp") ?>.
        </p>
      </article>
    <?php endif; ?>
  </main>
  <?php get_sidebar(); ?>
</div>
<?php get_footer();
