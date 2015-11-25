<?php
/**
 * @package WordPress
 * @subpackage LESS_WordPress
 */
get_header(); ?>
<div class="wrap">
  <main>
    <article>
      <header>
        <h1><?php _e("Not found","lwp") ?></h1>
      </header>
      <p><?php _e("Sorry, but the page you were trying to view does not exist.","lwp") ?></p>
      <p><?php _e("It looks like this was the result of either","lwp") ?>:</p>
      <ul>
        <li><?php _e("a mistyped address","lwp") ?></li>
        <li><?php _e("an out-of-date link","lwp") ?></li>
      </ul>
      <script>
        var GOOG_FIXURL_LANG = (navigator.language || '').slice(0,2),GOOG_FIXURL_SITE = location.host;
      </script>
      <script src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js"></script>
    </article>
  </main>
  <?php get_sidebar(); ?>
</div>
<?php get_footer();
