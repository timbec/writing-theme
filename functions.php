<?php

add_theme_support( 'post-thumbnails' );

register_nav_menu( 'primary', __( 'Primary', 'tbwp' ) );

/**
* Home Page Featured
*/
function tbwp_register_custom_featured() {
 register_rest_route('writing/v1', '/featured', [
	 'methods' => 'GET',
	 'callback' => 'tbwp_custom_featured'

 ]);
}
add_action('rest_api_init', 'tbwp_register_custom_featured');

function tbwp_custom_featured() {

	$args = array(
		'numberposts' => -1,
      'post_type' => 'post',
      'meta_key'		=> 'featured_on_home_page',
	   'meta_value'	=> ''
	);

	$featured_query = get_posts( $args );

	if ( empty( $featured_query ) ) {
		return null;
	}

	$featured_posts = [];

	foreach( $featured_query as $query ) {

		$image_id = get_post_thumbnail_id( $query->ID );
		$query->thumbnail = wp_get_attachment_image_src( $image_id, 'large' );

		$link = get_the_permalink( $query->ID );

		$featured_post = [
			'id' => $query->ID,
			'thumbnail' => $query->thumbnail,
			'title' => $query->post_title,
			'link' => $query->post_name,
			'excerpt' => $query->excerpt,
         'content' => $query->body
		];

		array_push( $featured_posts, $featured_post );
	}
	return $featured_posts;
}

/**
 * Generates Custom Posts
 */
function tbwp_register_custom_posts() {
 register_rest_route('writing/v1', '/posts', [
	 'methods' => 'GET',
	 'callback' => 'tbwp_custom_posts'
 ]);
}
add_action('rest_api_init', 'tbwp_register_custom_posts');

function tbwp_custom_posts() {
	$args = array(
		'numberposts' => -1
	);

	$custom_query = get_posts( $args );

	if ( empty( $custom_query ) ) {
		return null;
	}

	$custom_posts = [];

	foreach( $custom_query as $query ) {


      print_r($query);

		$image_id = get_post_thumbnail_id( $query->ID );
		$query->thumbnail = wp_get_attachment_image_src( $image_id, 'large' );

		$link = get_the_permalink( $query->ID );

		$custom_post = [
			'id' => $query->ID,
			'thumbnail' => $query->thumbnail,
			'title' => $query->post_title,
			'link' => $query->post_name,
			'excerpt' => $query->excerpt,
         'content' => $query->body
		];



		array_push( $custom_posts, $custom_post );
	}
	return $custom_posts;
}

/**
 * Generates Fiction Posts for Custom REST API
 */
function tbwp_fiction_get_all_fiction() {

  register_rest_route('writing/v1', '/fiction', [
 	 'methods' => 'GET',
 	 'callback' => 'tbwp_get_fiction'
  ]);
}

 add_action('rest_api_init', 'tbwp_fiction_get_all_fiction');


/**
* Get Indvidual Fiction Page Callback
*/
function tbwp_get_fiction() {

   $args = array(
      'sort_order' => 'asc',
      'category_name' => 'fiction'
   );

   $fiction_posts = get_posts($args);

   if ( empty( $fiction_posts ) ) {
      return null;
   }

   $custom_fiction_posts = [];

	foreach( $fiction_posts as $query ) {

		$image_id = get_post_thumbnail_id( $query->ID );
		$query->thumbnail = wp_get_attachment_image_src( $image_id, 'large' );

		$link = get_the_permalink( $query->ID );

		$custom_post = [
			'id' => $query->ID,
			'thumbnail' => $query->thumbnail,
			'title' => $query->post_title,
			'link' => $query->post_name,
			'excerpt' => $query->post_excerpt,
         'content' => $query->post_content
		];
      array_push( $custom_fiction_posts, $custom_post );
   }
   return $custom_fiction_posts;
 }



 /**
  * Generates Fiction Posts for Custom REST API
  */
 function tbwp_nonfiction_get_all_nonfiction() {

   register_rest_route('writing/v1', '/non-fiction', [
  	 'methods' => 'GET',
  	 'callback' => 'tbwp_get_nonfiction'
   ]);
 }

  add_action('rest_api_init', 'tbwp_nonfiction_get_all_nonfiction');


 /**
 * Get Indvidual Non Fiction Page Callback
 */
 function tbwp_get_nonfiction() {

    $args = array(
       'sort_order' => 'asc',
       'category_name' => 'non-fiction',
       'posts_per_page' => '-1'
    );

    $nonfiction_posts = get_posts($args);

    if ( empty( $nonfiction_posts ) ) {
       return null;
    }

    $custom_nonfiction_posts = [];

 	foreach( $nonfiction_posts as $query ) {

 		$image_id = get_post_thumbnail_id( $query->ID );
 		$query->thumbnail = wp_get_attachment_image_src( $image_id, 'large' );

 		$link = get_the_permalink( $query->ID );

 		$custom_post = [
 			'id' => $query->ID,
 			'thumbnail' => $query->thumbnail,
 			'title' => $query->post_title,
 			'link' => $query->post_name,
 			'excerpt' => $query->post_excerpt,
          'content' => $query->post_content
 		];
       array_push( $custom_nonfiction_posts, $custom_post );
    }
    return $custom_nonfiction_posts;
  }




/**
 * Generates Menu Settings for REST API
 */
function tbwp_menus_get_all_pages() {

  register_rest_route('writing/v1', '/pages', [
 	 'methods' => 'GET',
 	 'callback' => 'tbwp_get_pages'
  ]);
}

 add_action('rest_api_init', 'tbwp_menus_get_all_pages');


/**
* Get Indvidual Menu Callback
*/
function tbwp_get_pages() {

   $args = array(
      'sort_order' => 'asc',
      'parent' => 0
   );

   $pages = get_pages($args);

   if ( empty( $pages ) ) {
      return null;
   }

   $custom_pages = [];

   foreach( $pages as $page ) {

      $link = get_the_permalink( $page->ID );

      $custom_page = [
         'id' => $page->ID,
         'title' => $page->post_title,
         'link' => $page->post_name
      ];
      array_push( $custom_pages, $custom_page );
   }
   return $custom_pages;
 }



/**
 * Enqueue scripts and styles.
 */
function writing_portfolio_scripts() {

	// Theme stylesheet.
	wp_enqueue_style( 'writing_portfolio-style', get_stylesheet_directory_uri() . '/dist/css/style.css' );

   wp_enqueue_script('tb-writing-portfolio-scripts', get_template_directory_uri() . '/dist/build.js',['jquery'], time(), true);

   wp_localize_script('tb-writing-portfolio-scripts', 'writingportfolio_vars', array(
           'site_url' => esc_url( site_url() )
      )
   );

}
add_action( 'wp_enqueue_scripts', 'writing_portfolio_scripts' );
