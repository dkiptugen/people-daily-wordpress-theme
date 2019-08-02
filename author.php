<?php
/*
 *  Template Name: author
 *
 *  @Package people daily
 *
 */
 get_header();
if ( $author_id = get_query_var( 'author' ) ) 
	{ 
		$author = get_user_by( 'id', $author_id ); 
    }
else
    {
    	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
    }    
     
?>
<section class="row">
	<div class="col-12 col-md-8">
		<div class="jumbotron bg-secondary p-5 text-white rounded">
		<div class="display-4 d-flex justify-content-between">
		  	<h1 class="font-22 fw-700">About <?=get_the_author();?></h1>
		  	<span class="font-16">
				<?php echo count_user_posts(get_the_author_meta('ID'));?> Articles
			</span>			
        </div>
	  	<div class="d-flex lead">
	  		<div class="mr-2">
	  			<?php echo get_avatar(get_the_author_meta('user_email')); ?>
	  		</div>
	  		<div class="font-16 nunitosans d-block">
	  			<?php 
		  			if ( get_the_author_meta('description')) :
		  			 	echo wpautop( get_the_author_meta('description') ); 
		  			endif;
	  			?>
	  			<div class="clearfix">
	  				<a href="mailto:<?=get_the_author_meta('user_email', $post->post_author ); ?>" class="m-2 text-white"><i class="fas fa-envelope"></i></a>
	  				<?php
                    $social = array('linkedin','twitter','facebook','instagram','whatsapp','telegram','youtube'); 
                    foreach($social as $ssite)
	                    {
	                    	if($link = get_the_author_meta( $ssite, $post->post_author ))
		                    	{
		                    		echo '<a href="'.$link.'" class="m-2 text-white" rel="nofollow" target="_blank"><i class="fab fa-'.$ssite.'"></i></a>';
		                    	}
	                    }
	  				?>
	  				
	  				<!-- <a href="" class="m-2 text-white"><i class="fab fa-twitter"></i></a>
	  				<a href="" class="m-2 text-white"><i class="fab fa-facebook"></i></a>
	  				<a href="" class="m-2 text-white"><i class="fab fa-instagram"></i></a>
	  				<a href="" class="m-2 text-white"><i class="fas fa-envelope"></i></a>
	  				<a href="" class="m-2 text-white"><i class="fab fa-whatsapp"></i></a>
	  				<a href="" class="m-2 text-white"><i class="fab fa-telegram"></i></a> -->
	  			</div>
	  		</div>
	  	</div>			  
	</div>
	<div class="clearfix mt-3">
		<?php
		$data = fetch_posts_by_author_id(NULL,$author->ID, 8);
		if($data->have_posts())
			{
				while ( $data->have_posts() ) : $data->the_post();
				echo'
				<div class="media py-2">
				  	<a href="'.get_the_permalink( $post).'" class="col-4 px-0">
				  		<img src="'.get_the_post_thumbnail_url($post->ID, 'full').'" alt="" class="w-100 img-fluid">
				  	</a>
				  	<div class="media-body col-8 pr-0">
				    	<h5 class="mt-0 font-17 fw-700">
							<a href="'.get_the_permalink( $post).'" title="'.get_the_title( $post ).'">
								'.get_the_title( $post ).'
							</a>
				    	</h5>
				    	<p class="font-13">
				    		'.get_the_excerpt().'
				    	</p>
				  	</div>
				</div>';
				endwhile;
					wp_reset_postdata();
			}
		?>
	</div>
	</div>
	<div class="col-12 col-md-4">
		<aside class="ad pb-3 text-center">
		<small class="font-10">advertisement</small>
		<aside class="ad d-flex justify-content-center">
			<img src="http://unsplash.it/300/250?image=45" alt="">
		</aside>
	</aside>
	<aside class="">
		<div class="section my-3">
			<h3 class="section-title">Latest news</h3>
		</div>
		<?php
			$notin = [];
			
		  	$data = get_latest_posts($notin,5);
		  	$x 	  = 1;
		  	if($data->have_posts())
				{
					while ( $data->have_posts() ) : $data->the_post();
					if($x == 1)
						{
							echo '<div class="card rounded-0 border-0">
									<a href="'.get_the_permalink( $post).'">
										<img src="'.get_the_post_thumbnail_url($post->ID, 'full').'" alt="" class="w-100 img-fluid">
									</a>
									<div class="card-body px-0 py-1 font-15">
										<a href="'.get_the_permalink( $post).'">
											'.get_the_title( $post ).'
										</a>
									</div>
								</div>';
						}
					else
						{
							echo '<div class="media border-top py-2">
								  	<a href="'.get_the_permalink( $post).'" title="'.get_the_title( $post ).'" class="col-4 px-0">
								  		<img src="'.get_the_post_thumbnail_url($post->ID, 'full').'" alt="" class="w-100 img-fluid">
								  	</a>
								  	<div class="media-body col-8 pr-0">
								    	<h5 class="mt-0 font-13">
								    		<a href="'.get_the_permalink( $post).'" title="'.get_the_title( $post ).'">
												'.get_the_title( $post ).'
								    		</a>
								    	</h5>
								    	
								  	</div>
								</div>';
						}
					$x++;
					endwhile;
					wp_reset_postdata();
				}
		?>
	</aside>
	</div>
</section>
<?php
get_footer();
?>