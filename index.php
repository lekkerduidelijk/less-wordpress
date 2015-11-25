<?php
/**
 * @package WordPress
 * @subpackage LESS_WordPress
 */
get_header(); ?>
<div class="wrap">
  <main>
    <header>
      <?php if(is_blog()): ?>
      <h1>News</h1>
      <?php else: ?>
      <h1><?php the_title(); ?></h1>
      <?php endif; ?>
      <?php if(is_archive()): ?>
      <h2>Archive</h2>
      <?php endif; ?>
    </header>
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
          <header>
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e("Permanent link to", "gwp" ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('j F Y') ?></time>
          </header>
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
      <nav>
        <div><?php next_posts_link("&laquo; ".__("Older entries","gwp")) ?></div>
        <div><?php previous_posts_link(__("Newer entries","gwp"). "&raquo;") ?></div>
      </nav>
    <?php else : ?>
      <article>
        <header>
          <h2><?php _e("Not Found","gwp"); ?></h2>
        </header>
        <p><?php _e("Sorry, but you are looking for something that isn't here.", "gwp" ); ?></p>
        <?php get_search_form(); ?>
      </article>
    <?php endif; ?>
  </main>
  <?php get_sidebar(); ?>
</div>
<?php get_footer();
