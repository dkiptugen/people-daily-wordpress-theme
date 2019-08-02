<?php
function add_meta_tags()
    {
        echo '<meta name="Developer:name" content="Dennis Kiptoo Kiptugen" />
            <meta name="Developer:email" content="dennis.kiptoo@programmer.net" />
                 ';
    }
add_action('wp_head', 'add_meta_tags');
remove_action( 'wp_head', 'wp_generator' );
if (function_exists('add_theme_support'))
	{
		add_theme_support( 'wigets' );
		add_theme_support( 'menus' );
		add_theme_support( 'title-tag' );
		add_theme_support('post-thumbnails');
		add_image_size('large', 800, 500,  array('center','center') ); //Large Thumbnail
		add_image_size('medium', 480, 300,  array('center','center') ); //Medium Thumbnail
		add_image_size('small', 225, 141,  array('center','center') ); //Small Thumbnail
		add_image_size('xsmall', 115, 72,  array('center','center') ); //Small Thumbnail		
		add_image_size( 'facebook-image', 1200, 630, array('center','center') );
		add_image_size( 'dribbble-image', 800, 600, array('center','center') );
		add_image_size( 'instagram-image', 640, 640, array('center','center') );
		add_image_size( 'twitter-image', 640, 400, array('center','center') );
	}
add_filter( 'excerpt_length', function($length) {
    return 20;
} );

function PD_custom_logo_setup() 
	{
 		$defaults = array(
							 'height'      => 100,
							 'width'       => 400,
							 'flex-height' => true,
							 'flex-width'  => true,
							 'header-text' => array( 'site-title', 'site-description' ),
						);
 		add_theme_support( 'custom-logo', $defaults );
	}
add_action( 'after_setup_theme', 'PD_custom_logo_setup' );

function PD_customizer_setting($wp_customize) {
// add a setting 
    $wp_customize->add_setting('PD_light_logo');
// Add a control to upload the hover logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'PD_light_logo', array(
        'label' => 'Upload Light Logo',
        'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
        'settings' => 'PD_light_logo',
        'priority' => 8 // show it just below the custom-logo
    )));
}

add_action('customize_register', 'PD_customizer_setting');

function import_scripts()
	{
		wp_enqueue_style('style', get_template_directory_uri().'/style.css',false);
		wp_deregister_script( 'jquery' );
	    wp_register_script( 'jquery', get_template_directory_uri().'/assets/js/jquery-3.4.1.min.js');  
		wp_enqueue_script( 'jquery', get_template_directory_uri().'/assets/js/jquery-3.4.1.min.js', False , false, true );
		wp_enqueue_script( 'popper', get_template_directory_uri().'/assets/js/popper.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), false, true );
	}
add_action( 'wp_enqueue_scripts', 'import_scripts');

function register_my_menu() 
	{
	  	register_nav_menu('topmenu',__( 'Primary  Menu','people-daily' ));
	  	register_nav_menu('social_menu',__( 'Social Menu','social-media' ));
	}
add_action( 'init', 'register_my_menu' );

function add_classes_on_li($classes, $item, $args) 
	{
	    $classes[] = 'nav-item';
	    return $classes;
	}
add_filter('nav_menu_css_class','add_classes_on_li',1,3);


function add_menuclass($ulclass)
	{
		return preg_replace('/<a /', '<a class="nav-link" ', $ulclass);
	}
add_filter( 'wp_nav_menu', 'add_menuclass', 10, 1 );

function custom_cat_templates($template) 
	{
	    $category = get_category(get_queried_object_id()); 
	    $term = get_queried_object();
	    $children = get_terms( $term->taxonomy, array(
								'parent'    =>  $term->term_id,
								'hide_empty' => true
								) );	  
	    if ( $category->category_parent > 0  || ( empty($children ) && !is_singular()) ) //
		    { 
		       $cat = $category->term_id;
		        $sub_category_template = locate_template('child_category.php'); 
		        $template = !empty($sub_category_template) ? $sub_category_template : $template; 
		    }
	    return $template;
	}
add_filter('category_template', 'custom_cat_templates');	
add_filter( "term_links-post_tag", 'add_tag_class');

function add_tag_class($links) {
return str_replace('<a href="', '<a class="text-white font-14 bg-black rounded  px-3 py-1" href="', $links);
}
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}





function time_ago($datetime, $full = false) 
    {
        $now      =     new DateTime;
        $ago      =     new DateTime($datetime);
        $diff     =     $now->diff($ago);
        $diff->w  =     floor($diff->d / 7);
        $diff->d -=     $diff->w * 7;
        $string = array(
                            'y' => 'year',
                            'm' => 'month',
                            'w' => 'week',
                            'd' => 'day',
                            'h' => 'hour',
                            'i' => 'minute',
                            's' => 'second',
                        );
        foreach ($string as $k => &$v) 
            {
                if ($diff->$k) 
                    {
                        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                    } 
                else 
                    {
                        unset($string[$k]);
                    }
            }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
function fetch_posts($category, $limit, $offset) 
	{
	    $args = array(
				        'posts_per_page'   => $limit,
				        'offset'           => $offset,
				        'category_name'    => $category,
				        'orderby'          => 'date',
				        'order'            => 'DESC',
				        'post_type'        => 'post',
				        'post_status'      => 'publish',
				        'suppress_filters' => true,
				    );
	    $posts = get_posts( $args );
	    return $posts;
	}

function get_category_top($catid,$limit,$start=0)
	{
		$args 	= 	[
						'post_type'			=> 'post', 
						'orderby'			=> 'date', 
						'order'				=> 'DESC', 
						'posts_per_page'	=> $limit,
						'offset'			=> $start,
						'post_status'		=> 'publish',
						'tax_query' 		=> [
													'relation' => 'OR',
													[
														'taxonomy' => 'category',
														'field'    => 'term_id',
														'terms'    => $catid,
													],

													[
														'taxonomy' => 'category',
														'field'    => 'parent',
														'terms'    => $catid,
													]
												],
					];
		$myposts = new WP_Query($args);
		return $myposts;
	}

function fetch_posts_by_sub_category($parentid, $sub_category_id, $limit, $offset=0) 
	{		
		$args 	= 	[
			            'post__not_in' 	    => $parentid,
						'post_type'			=> 'post', 
						'orderby'			=> 'date', 
						'order'				=> 'DESC', 
						'posts_per_page'	=> $limit,
						'offset'			=> $offset,
						'post_status'		=> 'publish',
						'tax_query' 		=> [
													[
														'taxonomy' => 'category',
														'field'    => 'term_id',
														'terms'    => $sub_category_id,
													],
												],
					];
		$myposts = new WP_Query($args);
		return $myposts;
	}

function fetch_posts_by_author_id($notin=[],$author_id, $limit, $offset=0) {
    $args = array(
        'author'        =>  $author_id,
        'posts_per_page' => $limit,
        'offset'           => $offset,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'suppress_filters' => true,
        );
    $posts = new WP_Query( $args );
    return $posts;
}

function get_post_views( $postID )
	{
	    $count_key 	= 	'post_views_count';
	    $count 		= 	get_post_meta($postID, $count_key, true);
	    if($count=='')
		    {
		        delete_post_meta($postID, $count_key);
		        add_post_meta($postID, $count_key, '0');
		        return "0 View";
		    }
	    return $count.' Views';
	}
function get_child_categories( $catid , $limit , $start = 0 )
	{
		$args 	= 	[
			            
						'post_type'			=> 'post', 
						'orderby'			=> 'date', 
						'order'				=> 'DESC', 
						'posts_per_page'	=> $limit,
						'offset'			=> $start,
						'post_status'		=> 'publish',
						'tax_query' 		=> [
													[
														'taxonomy' => 'category',
														'field'    => 'term_id',
														'terms'    => $catid,
													],
												],
					];
		$myposts = new WP_Query($args);
		return $myposts;
	}
function set_post_views($postID) 
	{
	    $count_key 	= 	'post_views_count';
	    $count 		= 	get_post_meta($postID, $count_key, true);
	    if( $count == '' )
		    {
		        $count = 0;
		        delete_post_meta($postID, $count_key);
		        add_post_meta($postID, $count_key, '1');
		    } 
	    else
		    {
		        $count++;
		        update_post_meta($postID, $count_key, $count);
		    }
	}

function check_home_category($category)
	{
		return get_option($category);
	}
function home_category($catid,$limit,$start=0)
	{
		$sticky 		= 	get_option( 'sticky_posts' );
		rsort($sticky);
		$sticky 		= 	array_slice( $sticky, 0, 3 );
		$args 	= 	[
			            'post__not_in' 	    =>	$sticky,
						'post_type'			=> 	'post', 
						'orderby'			=> 	'date', 
						'order'				=> 	'DESC', 
						'posts_per_page'	=> 	$limit,
						'offset'			=> 	$start,
						'post_status'		=> 	'publish',
						'tax_query' 		=> 	[
													[
														'taxonomy' => 'category',
														'field'    => 'term_id',
														'terms'    => $catid,
													],
												],
					];
		$myposts = new WP_Query($args);
		return $myposts;
	} 
function trending_posts($notin=[],$count = 3) 
	{
	    $args 	= array(
	    	                'post__not_in'      => $notin,
				        	'posts_per_page'    => $count,
				        	'meta_key'          => 'post_views_count',
				        	'orderby'           => 'meta_value_num',
				        	'order'             => 'DESC'
				    	);
	    $data 	= get_posts($args);
	    //var_dump($data);
	    return $data;
	}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function track_post_views ($post_id) 
	{
	    if ( !is_single() ) return;
	    if ( empty ( $post_id) ) 
		    {
		        global $post;
		        $post_id = $post->ID;    
		    }
	    set_post_views($post_id);
	}
add_action( 'wp_head', 'track_post_views');

function limit_characters($string, $length)
	{
	    $string_without_tags 	= 	strip_tags($string); 
	    $result 				= 	substr($string_without_tags, 0, $length);
	    return $result;
	}


function home_top($limit,$start=0) 
	{

		$sticky 		= 	get_option( 'sticky_posts' );
		rsort($sticky);
		$sticky 		= 	array_slice( $sticky, $start, $limit );
		$data 			= 	new WP_Query(['post__in' => $sticky, 'ignore_sticky_posts' => 1 ]);	
		return $data;
	}
function get_home_latest($limit,$start=0)
	{
		$sticky 		= 	get_option( 'sticky_posts' );
		rsort($sticky);
		$sticky 		= 	array_slice( $sticky, 0, 3 );
		$data 			= 	new WP_Query([
											'post__not_in' 			=> 	$sticky,
		                                  	'ignore_sticky_posts' 	=> 	1,
		                                  	'orderby'             	=> 	'date',
				        				  	'order'             	=> 	'DESC',
				        				  	'posts_per_page' 		=> 	$limit,
        									'offset'           		=> 	$start 
		                              	]);	
		return $data;
	}

function get_latest_posts($notin=[],$limit,$start=0)
	{
		$data 			= 	new WP_Query([
                                            'post__not_in' 			=> 	$notin,
		                                   	'orderby'             	=> 	'date',
				        				  	'order'             	=> 	'DESC',
				        				  	'posts_per_page' 		=> 	$limit,
        									'offset'           		=> 	$start 
		                              	]);	
		return $data;
	}

function get_slideshow($notin=[],$limit,$start=0)
	{
		$data 			= 	new WP_Query([
                                        'post__not_in' 			=> 	$notin,
                                        'post_parent'           =>  0,
                                        'post_type'             =>  'slideshow',
	                                   	'orderby'             	=> 	'date',
			        				  	'order'             	=> 	'DESC',
			        				  	'posts_per_page' 		=> 	$limit,
    									'offset'           		=> 	$start 
	                              	]);	
		return $data;
	}
function get_slideshow_pictures($slideshowid)
	{
		$data 			= 	new WP_Query([
                                        
	                                        'post_parent'           =>  $slideshowid,
	                                        'post_type'             =>  'slideshow',
		                                   	'orderby'             	=> 	'menu_order',
				        				  	'order'             	=> 	'ASC',
				        				  	'posts_per_page' 		=> 	-1,
	    									
		                              	]);	
		return $data;
	}
function get_parent_category_featured($catid,$limit,$start=0)
	{
		$sticky 		= 	get_option( 'sticky_posts' );
		rsort($sticky);
		$sticky 		= 	array_slice( $sticky, 0, 4 );
		$data 			= 	new WP_Query(
											[
												'post__in' 				=> $sticky, 
												'ignore_sticky_posts' 	=> 1 
											]
										);	
		return $data;
	}
function wpb_related_author_posts($content) 
	{
	 
		if ( is_single() ) 
			{ 
		    	global $authordata, $post;
		     
		    	$content .= '<h4>Similar Posts by The Author:</h4> ';
		  
		    	$authors_posts = get_posts( array( 'author' => $authordata->ID, 'post__not_in' => array( $post->ID ), 'posts_per_page' => 5 ));
		  
		    	$content .= '<ul>';
		    	foreach ( $authors_posts as $authors_post ) 
		    		{
		        		$content .= '<li><a href="' . get_permalink( $authors_post->ID ) . '">' . apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) . '</a></li>';
		    		}
		    	$content .= '</ul>';
		  
		    	return $content;
		    } 
		else 
			{ 
		    	return $content; 
		    }
	}
function get_recommended_posts($postID)
    {

        try {
            $tags = wp_get_post_tags($postID);

            if (is_array($tags))
                {
                    $t = @$tags[0]->term_id;
    //                foreach ($tags as $value) {
    //                    array_push($t, $value->term_id);
    //                }

                    $args = array(
                            'tag__in' => array($t),
                            'post__not_in' => [$postID],
                            'posts_per_page' => 4
                        );
                    $data = new WP_Query($args);

                    return $data;
                }
        }
        catch(Exception $e)
        {
           echo  $e->getMessage();
        }
    }
add_filter('the_content','wpb_related_author_posts');


add_action( 'admin_footer-post.php', 'wpse_22836_remove_top_categories_checkbox' );
add_action( 'admin_footer-post-new.php', 'wpse_22836_remove_top_categories_checkbox' );

function wpse_22836_remove_top_categories_checkbox()
{
    global $post_type;

    if ( 'post' != $post_type )
        return;
    ?>
        <script type="text/javascript">
            jQuery("#categorychecklist>li>label input").each(function(){
                jQuery(this).remove();
            });
        </script>
    <?php
}
include_once 'theme_option.php';
include_once 'includes/widget.php';