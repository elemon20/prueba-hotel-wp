<?php
if(!function_exists('steed_content_search')){
	function steed_content_search(){
		if ( have_posts() ) :
			?>
            <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'steed' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            <?php
			
			while ( have_posts() ) : the_post();
				steed_content_post_item();
			endwhile;
			the_posts_navigation();
			
		else :
			_e('Sorry No entry Found', 'steed');
		endif;
	}
}
add_action('steed_content_search', 'steed_content_search');