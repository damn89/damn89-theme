<!DOCTYPE html>
<html>
  <head>
    <title><?php echo get_bloginfo( 'name'); ?></title>
      <?php wp_head(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>

  <div class="wrapper">

  <header>
    <?php if ( has_nav_menu( 'main_menu' ) ) : ?>
      <div id="burger-menu">
        <span></span>
      </div>
      
      <nav>
        <?php
          get_main_menu();
        ?>

      </nav>
    <?php endif; ?>
  </header>

