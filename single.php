<?php get_header(); ?>

<?php if (have_posts()) { ?>

  <?php while (have_posts()) { the_post(); ?>

  <?php $post_categories = get_the_category(); ; ?>
  
    <article>
      <div class="container">
        <?php 
          the_content(); 
        ?>
      </div>
    </article>

    <?php if (comments_open() || get_comments_number()) { comments_template('', true); } ?>
  
  <?php } ?>

<?php } else { ?>

  <article>
    <div class="container">
      <p>The post was not found.</p>
    </div>
  </article>

<?php } ?>


<?php get_footer(); ?>