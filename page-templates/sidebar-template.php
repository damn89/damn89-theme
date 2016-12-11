<?php
  /*
    Template Name: Sidebar template
  */
?>

<?php get_header(); ?>


      <main>
          <?php
            while (have_posts()) :
              the_post();
          ?>
              <div class="page-header">
                  <?php the_title('<h1>', '</h1>'); ?>
              </div>
              <?php the_content(); ?>

              <?php if ( has_post_thumbnail() ) :
                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
              ?>
                <img src="<?php echo($large_image_url[0]); ?>" class="image-responsive">
              <?php
                endif;
              ?>
          <?php
            endwhile;
          ?>
      </main>

      <div>
        <?php get_sidebar(); ?>
      </div>



<?php get_footer(); ?>
