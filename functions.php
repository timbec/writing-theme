<?php

/**
 * Custom Endpoints
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
 * Enqueue scripts and styles.
 */
function writing_portfolio_scripts() {

	// Theme stylesheet.
	wp_enqueue_style( 'writing_portfolio-style', get_stylesheet_uri() );

   wp_enqueue_script('tb-writing-portfolio-scripts', get_template_directory_uri() . '/dist/build.js',['jquery'], time(), true);

wp_localize_script('tb-writing-portfolio-scripts', 'writingportfolio_vars', array(
        'site_url' => esc_url( site_url() )
   )
);

}
add_action( 'wp_enqueue_scripts', 'writing_portfolio_scripts' );
