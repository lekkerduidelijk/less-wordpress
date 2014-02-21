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
<script>
  (function(){
    var lrdk = document.createElement('script');
    lrdk.src = "<?php echo versioned_resource('/js/all.min.js'); ?>";
    lrdk.type = 'text/javascript';
    lrdk.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(lrdk, s);
  })();
</script>

<?php wp_footer(); ?>
</body>
</html>
