<?php
/**
 * @package WordPress
 * @subpackage LESS_WordPress
 */
?>
<footer class="l-footer">
  <p>
    Copyright &copy; <?php echo date("Y"); ?>
  </p>
  <?php wp_nav_menu( array(
    'container_class' => '',
    'theme_location'  => 'footer',
    'fallback_cb'     => false
  )); ?>
</footer>

<?php wp_footer(); ?>
</body>
</html>
