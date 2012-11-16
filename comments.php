<?php
/**
 * @package WordPress
 * @subpackage LESS_Wordpress
 */

// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die (__('Please do not load this page directly. Thanks!','lwp'));

  if ( post_password_required() ) { ?>
    <p class="nocomments"><?php _e("This post is password protected. Enter the password to view comments.","lwp") ?></p>
    <?php
    return;
  }
?>

<?php /* You can start editing here. */ ?>

<?php if ( have_comments() ) : ?>
  <h3 id="comments"><?php comments_number(__("No Responses","lwp"), __("One Response","lwp"), __("% Responses","lwp") );?> <?php _e("to","lwp") ?> &#8220;<?php the_title(); ?>&#8221;</h3>

  <nav>
    <div><?php previous_comments_link() ?></div>
    <div><?php next_comments_link() ?></div>
  </nav>

  <ol class="commentlist">
    <?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
  </ol>

  <nav>
    <div><?php previous_comments_link() ?></div>
    <div><?php next_comments_link() ?></div>
  </nav>
<?php else : // this is displayed if there are no comments so far ?>
  <?php if ( comments_open() ) : ?>

    <?php /* If comments are open, but there are no comments. */ ?>

  <?php else : // comments are closed ?>

    <?php /* If comments are closed. */ ?>
    <p class="nocomments"><?php _e("Comments are closed.","lwp") ?></p>

  <?php endif; ?>
<?php endif; ?>

<?php if ( comments_open() ) : ?>

  <section id="respond">

    <h3><?php comment_form_title( __("Leave a Reply","lwp"), __("Leave a Reply to %s","lwp") ); ?></h3>

    <div class="cancel-comment-reply">
      <small><?php cancel_comment_reply_link(); ?></small>
    </div>

    <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
      <p><?php _e("You must be","lwp") ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e("logged in","lwp") ?></a> <?php _e("to post a comment.","lwp") ?></p>
    <?php else : ?>
      <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

        <?php if ( is_user_logged_in() ) : ?>
          <p><?php _e("Logged in as","lwp") ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e("Log out of this account","lwp")?>"><?php _e("Log out","lwp") ?> &raquo;</a></p>
        <?php else : ?>
          <p>
            <label for="author"><?php _e("Name","lwp") ?> <?php if ($req) _e("(required)","lwp"); ?></label>
            <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
          </p>

          <p>
            <label for="email"><small><?php _e("E-Mail","lwp") ?> <?php _e("(will not be published)","lwp") ?> <?php if ($req) _e("(required)","lwp"); ?></small></label>
            <input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
          </p>

          <p>
            <label for="url"><?php _e("Website","lwp") ?></label>
            <input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
          </p>
        <?php endif; ?>

        <p id="allowed_tags"><strong>HTML:</strong> <?php _e("You can use these tags","lwp") ?>: <code><?php echo allowed_tags(); ?></code></p>

        <p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>

        <p>
          <input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e("Submit Comment","lwp") ?>" />
          <?php comment_id_fields(); ?>
        </p>
          <?php do_action('comment_form', $post->ID); ?>
      </form>
    <?php endif; // If registration required and not logged in ?>
  </section>

<?php endif;
