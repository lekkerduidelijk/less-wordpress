<?php
/**
 * @package WordPress
 * @subpackage LESS_Wordpress
 */
?>
  <footer>
    <?php wp_nav_menu( array(
      'container_class' => '',
      'theme_location'  => 'footer',
      'fallback_cb'     => false
    )); ?>
  </footer>
</div>
<script src="<?php echo versioned_resource('/js/plugins.js'); ?>"></script>
<script src="<?php echo versioned_resource('/js/main.js'); ?>"></script>
<?php wp_footer(); ?>
<!-- <script>
  var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));
</script> -->
</body>
</html>
