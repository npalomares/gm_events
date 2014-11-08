<?
function gm_event_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'orderby' => 'menu_order',
		'cat' => '',
		'display' => 'excerpt',
	), $atts ) );
	
	$db_args = array(
		'post_type' => 'events',
		'order' => 'ASC',
		'orderby' => $orderby,
		'meta_key' => '_thumbnail_id'
	);
	

	$event_loop = new WP_Query( $db_args );
	
	
	if($event_loop->have_posts()) {
		switch($display) {		
			case "content":
				$content .= "<div class=\"event_wrapper\">";
				while( $event_loop->have_posts() ) : $event_loop->the_post();
					$content_filtered = get_the_content();
					$content_filtered = apply_filters('the_content', $content_filtered);
					$content_filtered = str_replace(']]>', ']]&gt;', $content_filtered);
					$content .= "<div class=\"event_single\">";
					$content .= "<h3 class=\"event_title\">".get_the_title()."</h3>";
					$content .= "<div class=\"event_content\">$content_filtered</div>";
					$content .= "</div>";
				endwhile;
				$content .= "</div>";
				break;
				
				
			case "excerpt":
				$content .= '<div class="row">';
				while( $event_loop->have_posts() ) : $event_loop->the_post();
				
					$thumb = get_the_post_thumbnail( get_the_id(), 'event-thumb'/*, array("class" => "img-responsive")*/);
					$content .= "<div class=\"col-sm-4\">";
					$content .= '<div class="event-item">';
					$content .= "<a href=\"".get_permalink()."\">".$thumb."</a>";
					$content .= '<h4 class="text-center event-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
					$content .= "</div></div>";
					

					
				endwhile;
				$content .= "</div>";
				break;
				
				
			case "list":
				$content .= "<ul class=\"event_wrapper\">";
				while( $event_loop->have_posts() ) : $event_loop->the_post();
					$content .= "<li class=\"event_single\">";
					$content .= "<span class=\"event_title\"><a href=".get_permalink().">".get_the_title()."</a></span>";
					$content .= "</li>";
				endwhile;
				$content .= "</ul>";
				break;
		}
			
	}
	wp_reset_postdata();
	return $content;
				
}
add_shortcode( 'gm_events', 'gm_event_shortcode' );
