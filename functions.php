<?php

/*
  # THEMEROOT CONSTANT FOR EASY ACCESS
*/


define('THEME_ROOT', get_template_directory_uri());




if($_POST['requestType'] == 'filter') {
  return_filter();
}


/*
  # MENU SUPPORT AND FUNCTIONS
*/

//add theme support for menus
add_theme_support('menus');

register_nav_menus(
  array(
    'main_menu' => 'Main Menu',
  )
);

//function to get menu
function get_main_menu() {
  wp_nav_menu(array(
    'menu' => 'main_menu',
    'theme_location' => 'main_menu'
  ));
}


/*
  # ADD THEME SUPPORT
*/


// add some post formats (display)
add_theme_support('post-formats', array( 'aside' ));


// add some post thumbnails (display)
add_theme_support('post-thumbnails', array( 'post', 'page' ));





/*
  # CUSTOM FUNCTIONS
*/




// list all categories 

function return_categories_markup($class){
  $categories = get_categories();
  echo "<ul class='$class'>";
  foreach ($categories as $cat) {
    echo '<li><a  data-category="' . $cat->slug . '" href="#">' . $cat->name . '</a></li>';
  }
  echo "</ul>";
}

// thumbnail, medium, large, full
function return_thumbnail( $size ) {
  the_post_thumbnail_url( $size );
}

function get_comment_form() {
  comment_form();
}

// echo out number of amount of characters you want
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

// echo out number of amount of characters you want
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  } 
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

// get the date format you choose in wordpress
function new_date_format( $format = false ) {
  global $post;
  if ( !$format ) $format = get_option('date_format');
  echo date($format, strtotime($post->post_date));
}




/*
  # CLEANUP
*/


add_action('init', 'cleanUp');

function cleanUp(){
  remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
  remove_action('wp_head', 'wp_generator'); // remove wordpress version

  remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links

  remove_action('wp_head', 'index_rel_link'); // remove link to index page
  remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)

  remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
  remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
  remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
}

/*
  # ENQUE STYLES AND SCRIPTS
*/

// Enqueue styles
function enqueue_styles() {
  wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css');
  wp_enqueue_style( 'slickcss', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css');
  wp_enqueue_style( 'themeslickcss', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css');
}
add_action( 'wp_enqueue_scripts', 'enqueue_styles' );

// Enqueue scripts
function enqueue_scripts() {
  wp_enqueue_script( 'jquery');
  wp_enqueue_script( 'slickjs', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js' );
  wp_enqueue_script( 'main',      get_template_directory_uri() . '/js/main.js' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );




/*
  # REGISTER SIDEBARS
*/


function damn89_widgets_init() {

  register_sidebar(array(
    'name'          => 'Högersidebar',
    'id'            => 'sidebar_right',
    'before_widget' => '<div class="panel panel-default">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<div class="panel-heading"><h3 class="panel-title">',
    'after_title'   => '</h3></div><div class="panel-body">',
  ));

    register_sidebar(array(
    'name'          => 'Sökfält',
    'id'            => 'search_field',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
  ));

  register_sidebar(array(
    'name'          => 'Footer Vänster',
    'id'            => 'footer1',
    'before_widget' => '<div class="footer1">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="sidebar-title">',
    'after_title'   => '</h4>',
  ));

  register_sidebar(array(
    'name'          => 'Footer Höger',
    'id'            => 'footer2',
    'before_widget' => '<div class="footer2">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="sidebar-title">',
    'after_title'   => '</h4>',
  ));
}
// add our function to the wordpress boot cycle
add_action( 'widgets_init', 'damn89_widgets_init' );



function return_filter(){

  $cat_var_from_js = $_POST['category'];

  $categories = get_categories();
  // var_dump($categories);
  $i = 0;
  $category_values = array();
  foreach ($categories as $cat ) {
    $category_value[$i] = $cat->slug;
    array_push($category_values, $category_value[$i] );

    $i++;

  }


  foreach ($category_values as $cat) {
    if($cat == $cat_var_from_js){
      $c = get_category_by_slug($cat);
      $args = array(
        'numberposts' => -1,
        'category' => $c->term_id
      );
      $returned_posts = get_posts($args);
      $i = 0;
      foreach ($returned_posts as $p) {
        if($i%3 == 0) {
          echo $i > 0 ? "</div>" : ""; // close div if it's not the first
          echo "<div class='box'>";
        }
        $cats_from_post = get_the_category($p);
        $collected_cats = array();
        foreach ($cats_from_post as $cat) {
          array_push($collected_cats, $cat->slug);
        }
        $categories = implode(" ", $collected_cats);
        ?>
        <a href="<?php the_permalink($p); ?>" class="portfolio-object" data-category="<?php echo $categories; ?>">
          <article>
            <h1><?php echo get_the_title($p->ID); ?></h1>
            <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), "full" ) ?>
            <?php 
            if (has_post_thumbnail($p)){
              ?><div class="background-image-front" style="background-image: url('<?php echo $thumbnail_src[0]; ?>')"></div><?php
            }else {
              ?><div class="background-image-front" style="background-image: url('<?php echo THEME_ROOT . '/img/default-thumbnail.png'; ?>')"></div><?php
            }
            ?>
          </article>  
        </a>
      <?php
      $i++;
      }
    }
  }
  die();
}

