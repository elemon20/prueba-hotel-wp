<?php
if(!function_exists('steed_content_archive')){
	function steed_content_archive(){
		if ( have_posts() ) :
			the_archive_title('<h1 class="entry-title">', '</h1>');
			
			while ( have_posts() ) : the_post();
				steed_content_post_item();
			endwhile;
			the_posts_navigation();
			
		else :
			_e('Sorry No entry Found', 'steed');
		endif;
	}
}
add_action('steed_content_archive', 'steed_content_archive');