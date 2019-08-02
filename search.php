<?php
/*
 *  Template Name: search
 *
 *  @Package people daily
 *
 */
 get_header();
?>
<section class="row">
	<div class="col-12 col-md-8">
		<script async src="https://cse.google.com/cse.js?cx=000052943387538872558:lb8aexuudoo"></script>
		<div class="gcse-search"></div>
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