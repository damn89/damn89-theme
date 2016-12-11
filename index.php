<?php get_header(); ?>
  <main>
    <?php

      if (have_posts()) :

      while (have_posts()) :
        the_post();
      ?>
        <a href="<?php the_permalink(); ?>">
          <article>
          <h1><?php echo the_title(); ?></h1>
          <?php the_content(); ?>

          </article>
        </a>
    <?php

      endwhile;

    ?>
  </main>
    <?php
    else :
  ?>
    <main>

    </main>
  <?php endif; ?>


<?php get_footer(); ?>
