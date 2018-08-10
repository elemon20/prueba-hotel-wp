<?php
if(!function_exists('steed_content_author')){
	function steed_content_author(){
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;
			
			while ( have_posts() ) : the_post();
				steed_content_post_item();
			endwhile;
			the_posts_navigation();
			
		else :
			_e('Sorry No entry Found', 'steed');
		endif;
	}
}
add_action('steed_content_author', 'steed_content_author');