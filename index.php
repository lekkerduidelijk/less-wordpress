<?php
/**
 * @package WordPress
 * @subpackage LESS_Wordpress
 */
get_header(); ?>
<div role="main">
  <div id="content">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
          <header>
            <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e("Permanent link to", "lwp" ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
            <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('j F Y') ?></time>
          </header>
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
      <nav>
        <div><?php next_posts_link("&laquo; ".__("Older entries","lwp")) ?></div>
        <div><?php previous_posts_link(__("Newer entries","lwp"). "&raquo;") ?></div>
      </nav>
    <?php else : ?>
      <article>
        <header>
          <h1><?php _e("Not Found","lwp"); ?></h1>
        </header>
        <p><?php _e("Sorry, but you are looking for something that isn't here.", "lwp" ); ?></p>
        <?php get_search_form(); ?>
      </article>
    <?php endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
