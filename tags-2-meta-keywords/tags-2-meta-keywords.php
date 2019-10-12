<?php
/*
Plugin Name: Tags 2 Meta Keywords
Version: 1.1
Plugin URI: http://www.monkey-business.biz/131/wordpress-plugin-tags-2-meta-keywords/
Description: Generates meta keywords automatically from your post tags. A single post or page get up to 10 tags as meta keywords. In category and archive view you get the 10 most used tags in category or archive as meta keywords. On the main page you get the 10 most used tags as meta keywords. This plugin doesn't need any configuration. It just works. ;)
Author: "Loaden"
Author URI: http://www.monkey-business.biz/
*/

	function tags2meta_keywords() {
		$metatags = array();
		$tags = array();	
		if (have_posts()) {		
			while (have_posts()) {			 
				the_post();
				$posttags = get_the_tags();				
				if (is_array($posttags)) {
					foreach ($posttags as $tag) {					
						if (!isset($tags[$tag->name])) {
							$tags[strtolower(str_replace('"', "'", html_entity_decode($tag->name)))] = $tag->count;
						}
					}
				}	
			}		
			if (is_array($tags)) {				
				arsort($tags);
				echo "\n".'<meta name="keywords" content="'.implode(', ', array_keys(array_slice($tags, 0, 10))).'" />';	
			}
		}	
	}
	add_action('wp_head', 'tags2meta_keywords');
	
?>
