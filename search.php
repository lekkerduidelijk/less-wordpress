<?php
/**
 * @package WordPress
 * @subpackage LESS_Wordpress
 */

get_header(); ?>
<div role="main">
  <div id="content">
    <?php if (have_posts()) : ?>
      <header>
        <h1><?php e_("Search results", "lwp" ); ?></h1>
      </header>
      <nav>
        <div><?php next_posts_link("&laquo; ".__("Older Entries","lwp")) ?></div>
        <div><?php previous_posts_link(__("Newer Entries","lwp"). "&raquo;") ?></div>
      </nav>
      <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class() ?>>
          <h1 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php e_("Permanent Link to", "lwp" ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
          <time><?php the_time('j F Y') ?></time>
        </article>
      <?php endwhile; ?>
      <nav>
        <div><?php next_posts_link("&laquo; ".__("Older Entries","lwp")) ?></div>
        <div><?php previous_posts_link(__("Newer Entries","lwp"). "&raquo;") ?></div>
      </nav>
    <?php else : ?>
      <article>
        <h1><?php e_("No posts found", "lwp" ); ?></h1>
        <p><?php e_("Try a different search?", "lwp" ); ?></p>
        <?php get_search_form(); ?>
      </article>
    <?php endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div> <!-- [role=main] -->
<?php get_footer(); ?>
