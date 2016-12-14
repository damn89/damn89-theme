<?php wp_footer(); ?>

    <footer>
      <?php if ( is_active_sidebar( 'footer1' ) ) : ?>
        <div id="footer1" class="footer">
          <?php dynamic_sidebar( 'footer1' ); ?>
        </div>
      <?php endif; ?>

      <?php if ( is_active_sidebar( 'footer2' ) ) : ?>
        <div id="footer2" class="footer">
          <?php dynamic_sidebar( 'footer2' ); ?>
        </div>
      <?php endif; ?>
    </footer>
    </div> <!-- end contain-->
  </body>
</html>

