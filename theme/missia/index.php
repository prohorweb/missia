<?php get_template_part('layout/header');

if (is_front_page()) {
    get_template_part('layout/section/carousel');
    get_template_part('layout/section/news');
}
//
//if (cat_is_ancestor_of(9, $cat)  or is_category(9)) {
//    get_template_part('category/articles');
//}
//
//if (cat_is_ancestor_of(18, $cat)  or is_category(18)) {
//    get_template_part('category/events');
//}
//
//if (cat_is_ancestor_of(22, $cat)  or is_category(22)) {
//    get_template_part('category/media');
//}
//
//if (is_single()) {
//    if (in_category(4) || post_is_in_descendant_category(4)) {
//        get_template_part('page/about');
//    }
//     else {
//       get_template_part( 'page/article' );
//     }
//     if ( in_category(  array( 9,18 ) ) || post_is_in_descendant_category( array( 9,18 ) ) ){
//       get_template_part( 'page/article' );
//     }
//
//    if (in_category(22) || post_is_in_descendant_category(22)) {
//        get_template_part('page/media');
//    }
//
//    if (in_category(18) || post_is_in_descendant_category(18)and in_category(9) || post_is_in_descendant_category(9)) {
//        get_template_part('page/event');
//    } elseif (in_category(9) || post_is_in_descendant_category(9)) {
//        get_template_part('page/article');
//    } elseif (in_category(18) || post_is_in_descendant_category(18)) {
//        get_template_part('page/event');
//    }
//}
//
//if (is_404()) {
//    get_template_part('layout/main');
//}
//
//if ( is_preview() ){
//    get_template_part('page/article');
//}
//
// if ( is_search() ){
// 	  get_template_part('search');
// }

get_template_part('layout/footer');