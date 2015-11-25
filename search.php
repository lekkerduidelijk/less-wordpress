<?php
/**
 * @package WordPress
 * @subpackage LESS_WordPress
 */
get_header(); ?>
<div class="wrap">
  <main>
    <header>
      <h1><?php _e("Search results", "lwp" ); ?></h1>
    </header>
    <?php if (have_posts()) : ?>
      <nav>
        <div><?php next_posts_link("&laquo; ".__("Older entries","lwp")) ?></div>
        <div><?php previous_posts_link(__("Newer entries","lwp"). "&raquo;") ?></div>
      </nav>
      <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class() ?>>
          <h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e("Permanent link to", "lwp" ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
          <time><?php the_time('j F Y') ?></time>
        </article>
      <?php endwhile; ?>
      <nav>
        <div><?php next_posts_link("&laquo; ".__("Older entries","lwp")) ?></div>
        <div><?php previous_posts_link(__("Newer entries","lwp"). "&raquo;") ?></div>
      </nav>
    <?php else : ?>
      <article>
        <h2><?php _e("No posts found", "lwp" ); ?></h2>
        <p><?php _e("Try a different search?", "lwp" ); ?></p>
        <?php get_search_form(); ?>
      </article>
    <?php endif; ?>
  </main>
  <?php get_sidebar(); ?>
</div>
<?php get_footer();
