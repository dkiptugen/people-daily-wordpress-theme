<?php
/*********************************************************************/
/* Add sponsored post checkbox
/********************************************************************/
add_action( 'add_meta_boxes', 'add_sponsored_checkbox_function' );
function add_sponsored_checkbox_function() 
	{
		add_meta_box('sponsored_checkbox_id','Set as Sponsored Post?', 'sponsored_checkbox_callback_function', 'post', 'side', 'high');
	}
function sponsored_checkbox_callback_function( $post ) 
	{
		global $post;
		$isSponsored = get_post_meta( $post->ID, 'is_sponsored', true );
		echo '
		<input type="checkbox" name="is_sponsored" value="yes" '.(($isSponsored=='yes') ? 'checked="checked"': '').'/> YES';
	}

	
/*********************************************************************/
/* Add breaking post checkbox
/********************************************************************/
add_action( 'add_meta_boxes', 'add_breaking_news_checkbox_function' );
function add_breaking_news_checkbox_function() 
	{
		add_meta_box('breaking_news_checkbox_id','Set as Breaking News?', 'breaking_news_checkbox_callback_function', 'post', 'side', 'high');
	}
function breaking_news_checkbox_callback_function( $post ) 
	{
		global $post;
		$isBreakingNews = get_post_meta( $post->ID, 'is_breaking_news', true );

		echo '<input type="checkbox" name="is_breaking_news" value="yes" '.(($isBreakingNews=='yes') ? 'checked="checked"': '').'/> YES';
	}

