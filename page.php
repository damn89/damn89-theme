
<?php get_header(); ?>

  <?php
    while (have_posts()) :
      the_post();
  ?>
  <article class="page">
    <div class="container">
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>

    </div>
  </article>
  <?php
    endwhile;
  ?>

<?php get_footer(); ?>
