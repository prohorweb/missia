<?php

function title_header() {
            if (is_home()) {
                // bloginfo('name');
                // echo' : ';
                bloginfo('description');
            } elseif (is_category()) {
                single_cat_title();
                echo ' - ';
                bloginfo('description');
            } elseif (is_single()) {
                single_post_title();
            } elseif (is_page()) {
                bloginfo('description');
                echo ': ';
                single_post_title();
            } else {
                wp_title('', true);
            }
}
add_action('init', 'title_header');


add_action('init', 'remove_else_link');

function remove_else_link()
{

remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'rel_canonical');
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}
add_filter( 'emoji_svg_url', '__return_false' );

function my_admin_logo() {
   echo '
    <style type="text/css">
        #header-logo { background:url('.get_bloginfo('template_directory').'/assets/img/logo.png) no-repeat 0 0  !important; }
    </style>';
}
function my_login_logo(){
   echo '
   <style type="text/css">
        #login h1 a { background: url('. get_bloginfo('template_directory') .'/assets/img/logo.png) no-repeat 0 0 !important;
            background-size: cover !important;
            height: 62px;
            width: auto;
           }
          .wp-core-ui.locale-ru-ru {
             background: #3760c8;
           }
         #nav a,
         #backtoblog a {
            color: #fff !important;
            }
    </style>';
}

add_action('add_admin_bar_menus', function(){
	// удаляем из тулбара
	remove_action( 'admin_bar_menu', 'wp_admin_bar_customize_menu', 40); // Настроить тему
	remove_action( 'admin_bar_menu', 'wp_admin_bar_search_menu', 4 );    // поиск
	remove_action( 'admin_bar_menu', 'wp_admin_bar_wp_menu', 10 );      // WordPress ссылки (WordPress лого)
});



function custom_pagination( \WP_Query $wp_query = null, $echo = true, $params = [] ) {
    if ( null === $wp_query ) {
        global $wp_query;
    }

    $add_args = [];

    //add query (GET) parameters to generated page URLs
    /*if (isset($_GET[ 'sort' ])) {
        $add_args[ 'sort' ] = (string)$_GET[ 'sort' ];
    }*/
    $total_pages = $wp_query->max_num_pages;
    $pages = paginate_links( array_merge( [
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'format'       => '?paged=%#%',
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'total'        => $total_pages,
            'type'         => 'array',
            'show_all'     => false,
            'end_size'     => 3,
            'mid_size'     => 1,
            'prev_next'    => false,
            'add_args'     => $add_args,
            'add_fragment' => ''
        ], $params )
    );

    if ( is_array( $pages ) ) {
        //$current_page = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
        $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
        //Disable Previous button if the current page is the first one
        if ($paged == 1) {
            echo '<a class="pagination-previous is-hidden"> <i class="fas fa-angle-double-left"></i> </a>';
        } else {
            echo '<a class="pagination-previous" href="' . get_previous_posts_page_link() . '"><i class="fas fa-angle-double-left"></i> </a>';
        }

        //Disable Next button if the current page is the last one
        if ($paged < $total_pages) {
            echo '<a class="pagination-next" href="' . get_next_posts_page_link() . '"> <i class="fas fa-angle-double-right"></i></a>';
        } else {
            echo '<a class="pagination-next is-hidden"> <i class="fas fa-angle-double-right"></i> </a>';
        }

        $pagination = '<ul class="pagination-list">';
        foreach ( $pages as $page ) {
            $pagination .= '<li> ' . str_replace('page-numbers', 'pagination-link ' . (strpos($page, 'current') !== false ? 'is-current' : '') . '"', $page) . '</li>';
        }

        $pagination .= '</ul>';

        if ( $echo ) {
            echo $pagination;
        } else {
            return $pagination;
        }
    }

    return null;
}

// function redirect_admin( $redirect_to, $request, $user ){
//     $redirect_to = WP_HOME.'/wp-admin/edit.php'; // Your redirect URL
//     return $redirect_to;
// }
// add_filter( 'login_redirect', 'redirect_admin', 10, 3 );

function login_redirect( $redirect_to, $request, $user ){
    return home_url('wp-admin/edit.php');
}
add_filter( 'login_redirect', 'login_redirect', 10, 3 );

add_action( 'admin_menu', 'remove_menus' );
function remove_menus(){
	remove_menu_page( 'index.php' );                  // Консоль
}
/* Ставим ссылку с логотипа на сайт, а не на wordpress.org */
add_filter( 'login_headerurl', create_function('', 'return get_home_url();') );

/* убираем title в логотипе "сайт работает на wordpress" */
add_filter( 'login_headertitle', create_function('', 'return false;') );

add_action('login_head', 'my_login_logo');
add_action('admin_head', 'my_admin_logo');

add_theme_support( 'post-thumbnails' );


if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'tab-thumb', 150, 150, array( 'center', 'top' ));
}

// if ( function_exists( 'add_image_size' ) ) {
// 	add_image_size( 'thumbnail', 300, 200, array( 'center', 'center' ));
// }

function trim_title_chars($count, $after) {
  $title = get_the_title();
  if (mb_strlen($title) > $count) $title = mb_substr($title,0,$count);
  else $after = '';
  echo $title . $after;
}
function trim_excerpt_chars($count, $after) {
  $excerpt = get_the_excerpt();
  if (mb_strlen($excerpt,'UTF-8') > $count) $excerpt = mb_substr($excerpt,0,$count,'UTF-8');
  else $after = '';
  echo $excerpt . $after;
}

function post_is_in_descendant_category( $cats, $_post = null ){
	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');
		if( $descendants && in_category( $descendants, $_post ) )
			return true;
	}
	return false;
}

function grants_title($title)
{
  $grants_pub = get_page_by_path('grants', OBJECT, 'page');
  $grants_ID = $grants_pub->ID;
  $the_grants = get_post( $grants_ID );
  echo $title = $the_grants->post_title;
}
function grants_content($content)
{
  $grants_pub = get_page_by_path('grants', OBJECT, 'page');
  $grants_ID = $grants_pub->ID;
  $content = get_post_field('post_content', $grants_ID);
  echo $content;
}

function contacts_title($title)
{
  $contacts_pub = get_page_by_path('contacts', OBJECT, 'page');
  $contacts_ID = $contacts_pub->ID;
  $the_contacts = get_post( $contacts_ID );
  echo $title = $the_contacts->post_title;
}

function btn($text)
{
  if (is_main_site()) {
      $text='Показать больше';
      echo $text;
  } else {
    $text = 'Pokaż więcej';
      echo $text;
  }
}

function btn_more($text)
{
  if (is_main_site()) {
      $text='Читать далее';
      echo $text;
  } else {
    $text = 'Przeczytaj więcej';
      echo $text;
  }
}

function btn_all($text)
{
  if (is_main_site()) {
      $text='Все материалы';
      echo $text;
  } else {
    $text = 'Wszystkie materiały';
      echo $text;
  }
}

function btn_event($text)
{
  if (is_main_site()) {
      $text='Все мероприятия';
      echo $text;
  } else {
    $text = 'Wszystkie wydarzenia';
      echo $text;
  }
}

function no_found($text)
{
  if (is_main_site()) {
      $text='Материалы отсутствуют. Попробуйте выбрать другую категорию.';
      echo $text;
  } else {
    $text = 'Brak dostępnych materiałów. Spróbuj wybrać inną kategorię.';
      echo $text;
  }
}

add_filter( 'upload_size_limit', 'PBP_increase_upload' );
 function PBP_increase_upload( $bytes )
 {
 return 1048576000; // 1 megabyte
 }

 function add_image_insert_override($sizes){
    unset($sizes['medium']);
    unset($sizes['medium_large']);
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'add_image_insert_override' );
add_filter('max_srcset_image_width', create_function('', 'return 1;'));

// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
 /*
 Вид базового шаблона:
 <nav class="navigation %1$s" role="navigation">
   <h2 class="screen-reader-text">%2$s</h2>
   <div class="nav-links">%3$s</div>
 </nav>
 */

 return '
 <ul class="navigation %1$s justify-content-center w-100 f16 my-4" role="navigation">
   <li class="page-item"> %3$s</li>
 </ul>
 ';
}

function search_filters(){
    if(is_search()) { ?>
            <?php
            $searching = get_search_query();
            $order = get_query_var('order');
            $i=0;
            $filter_categories_array = array();
            while (have_posts()) : the_post();
                foreach((get_the_category()) as $category) {
                $categores = '<span class="search-results-link mr-3 cat-'.$category->cat_ID.'"><a href="'.get_option('home').'?s='.$searching.'&cat='.$category->cat_ID.'&order='.$order.'">'.$category->cat_name.'</a></span>';
                $filter_categories_array[$i] = $categores;
                $i++;
                }
            endwhile;

            $clear_filter_categories_array = array_unique($filter_categories_array);
            for($i=0;$i<count($filter_categories_array);$i++) {
                echo $clear_filter_categories_array[$i];
            }
            if ($filter_categories_array == null ) {
                echo "";
            }
            ?>
        <?php }
    }
