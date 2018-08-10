<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Steed
 */
if ( ! function_exists( 'steed_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function steed_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'steed' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'steed' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'steed_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function steed_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'steed' ) );
		if ( $categories_list && steed_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'steed' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'steed' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'steed' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'steed' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'steed' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function steed_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'steed_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'steed_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so steed_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so steed_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in steed_categorized_blog.
 */
function steed_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'steed_categories' );
}
add_action( 'edit_category', 'steed_category_transient_flusher' );
add_action( 'save_post',     'steed_category_transient_flusher' );



if ( ! function_exists( 'steed_site_header' ) ) :

	function steed_site_header(){
		do_action('steed_before_site_header');
		get_template_part( 'includes/parts/part', 'header');
		do_action('steed_after_site_header');
	}

endif;

if ( ! function_exists( 'steed_site_subheader' ) ) :

	function steed_site_subheader(){
		do_action('steed_before_site_subheader');
		get_template_part( 'includes/parts/part', 'subheader');
		do_action('steed_after_site_subheader');
	}

endif;

if ( ! function_exists( 'steed_site_footer' ) ) :

	function steed_site_footer(){
		do_action('steed_before_site_footer');
		get_template_part( 'includes/parts/part', 'footer');
		do_action('steed_before_site_footer');
	}

endif;


if ( ! function_exists( 'steed_before_site_content' ) ) :

	function steed_before_site_content($arg){
		$arg = array_merge(array( 'class' => '', 'in_class' => '' ), $arg);
		echo '<div id="content" class="site-content '.apply_filters('steed_content_area_color_mood', 'color-dark').' '.$arg['class'].'">';
			echo '<div id="content-in" class="site-content-in '.$arg['in_class'].'">';
				do_action('steed_before_site_content');
	}

endif;


if ( ! function_exists( 'steed_after_site_content' ) ) :

	function steed_after_site_content(){
				do_action('steed_after_site_content');
			echo '</div><!-- #content-in -->';
		echo '</div><!-- #content -->';
		
	}

endif;


if ( ! function_exists( 'steed_before_primary_content' ) ) :

	function steed_before_primary_content(){
		
		echo '<div id="primary" class="content-area">';
			echo '<main id="main" class="site-main" role="main">';
				do_action('steed_before_primary_content');
	}

endif;


if ( ! function_exists( 'steed_after_primary_content' ) ) :

	function steed_after_primary_content(){
				do_action('steed_after_primary_content');
			echo '</main><!-- #main -->';
		echo '</div><!-- #primary -->';
		
	}

endif;