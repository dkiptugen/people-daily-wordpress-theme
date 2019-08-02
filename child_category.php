<?php
/*
 *  Template Name: category
 *
 *  @Package people daily
 *
 */
 get_header();
 global $cat;
?>
<section class="row">
			<div class="col-12 col-md-8">
				<div class="row py-3">
					<div class="col-12 col-md-6">
					<?php
				
					
					$data     = get_child_categories($cat,7);
					if($data->have_posts())
						{   
							$x = 1;
							while($data->have_posts()):$data->the_post();
							if($x == 1)
								{
									echo'
										<div class="card rounded-0 border-0">
											<a href="' . get_the_permalink() .'" title="'.get_the_title().'">
												' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
											</a>
											<div class="card-body px-0 py-1">
												<small class="text-dark font-11">
												<a href="'. get_author_posts_url($authordata->ID, $authordata->user_nicename).'" class="text-dark">By '.get_the_author().' </a> |
												'.time_ago(get_the_date()).'</small>
												<h1 class="font-15">
													<a href="' . get_the_permalink() .'" title="'.get_the_title().'">
														'.get_the_title().'
													</a>
												</h1>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-6">';
								}
							elseif(($x>1) && ($x<4))
								{
									echo '<div class="media py-2">
										  	<a href="' . get_the_permalink() .'" title="'.get_the_title().'" class="col-4 px-0">
										  		' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
										  	</a>
										  	<div class="media-body col-8 pr-0">
										    	<h2 class="mt-0 font-15">
											    	<a href="' . get_the_permalink() .'" title="'.get_the_title().'">
											    		'.get_the_title().'
											    	</a>
											    </h2>
											    <div class="postmeta text-dark my-1">
											    	<small class="font-11>
											    		<a href="'. get_author_posts_url($authordata->ID, $authordata->user_nicename).'" title="'.get_the_author().'" class="text-dark">
											    			BY '.get_the_author().'
											    		</a> | '.time_ago(get_the_date()).'
											    	</small>
											    </div>							    	
										  	</div>
										</div>';
								}							
						    elseif( $x == 4 )
							    {
							    	echo '<div class="media py-2">
										  	<a href="' . get_the_permalink() .'" title="'.get_the_title().'" class="col-4 px-0">
										  		' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
										  	</a>
										  	<div class="media-body col-8 pr-0">
										    	<h2 class="mt-0 font-15">
											    	<a href="' . get_the_permalink() .'" title="'.get_the_title().'">
											    		'.get_the_title().'
											    	</a>
											    </h2>
											    <div class="postmeta text-pdgreen my-1">
											    	<small class="font-11">
											    		<a href="'. get_author_posts_url($authordata->ID, $authordata->user_nicename).'" title="'.get_the_author().'" class="text-dark">
											    			BY '.get_the_author().'
											    		</a> | '.time_ago(get_the_date()).'
											    	</small>
											    </div>							    	
										  	</div>
										</div>
										</div>
										

										<div class="row">';
							    }
						    else
							    {
							    	echo '<div class="col-12 col-md-4 mt-3">
											<div class="card rounded-0 border-0">
												<a href="' . get_the_permalink() .'" title="'.get_the_title().'" >
													' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
												</a>
												<div class="card-body px-0 py-1">
													<h5 class="font-15">
														<a href="' . get_the_permalink() .'" title="'.get_the_title().'" >
															'.get_the_title().'
														</a>
													</h5>
												</div>
											</div>
										</div>';
							    }
							$x++;    
							endwhile;
							wp_reset_postdata();
							if(($x<7))
								{
									echo '</div>';
								}
						}
					
					?>
				
				</div>
		
				<div class="row justify-content-center my-3">
					<img src="http://unsplash.it/728/90?image=120" alt="">
				</div>
			
					<?php 
					$data = get_child_categories($cat,4,7);
                    if($data->have_posts())
	                    {
	                    	echo '	<section class="my-3">
										<div class="section">
											<h3 class="section-title">More on '.get_the_category_by_ID( $cat).'</h3>
										</div>';
	                    	while($data->have_posts()):$data->the_post();
							echo '   <div class="media py-2">
								  	    <a href="' . get_the_permalink() .'" title="'.get_the_title().'" class="col-4 px-0">
								  		    ' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
								  	    </a>
								  	    <div class="media-body col-8 pr-0">
								    	    <h5 class="mt-0 font-17 fw-700">
											    <a href="' . get_the_permalink() .'" title="'.get_the_title().'">
												    '.get_the_title().'
											    </a>
								    	    </h5>
								    	    <p class="font-13">
								    		    '.get_the_excerpt().'
								    	    </p>
								  	    </div>
								    </div>';
							endwhile;
							wp_reset_postdata();	

					        $dt 	= get_child_categories($cat,4,11);
					        if($dt->have_posts())
	                            {
	                    	        echo '<div class="d-flex justify-content-center">
									    <button class="btn btn-pdgreen text-white loadmorecat" data-catid="'.$cat.'" data-start="11" data-end="8">
										    Load More
									    </button>
								    </div>';
	                            }
					        echo '</section>';
                        }
					?>
					
                </div>
			</div>
			<div class="col-12 col-md-4">
				<aside class="ad py-3 text-center">
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
		<!-- <section class="row load-more">
			<div class="col-12 col-lg-3 col-md-6 mt-3">
				<div class="card rounded-0 border-0">
					<a href="">
						<img src="http://unsplash.it/800/500?image=11" alt="" class="w-100 img-fluid">
					</a>
					<div class="card-body px-0 py-1">
						<small class="text-pdgreen">1 day ago</small>
						<h5 class="font-15">
							<a href="">
								AFCON 2019: amount you will pay 20 MPs to enjoy the tournament in Egypt
							</a>
						</h5>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-3  col-md-6 mt-3">
				<div class="card rounded-0 border-0">
					<a href="">
						<img src="http://unsplash.it/800/500?image=12" alt="" class="w-100 img-fluid">
					</a>
					<div class="card-body px-0 py-1">
						<small class="text-pdgreen">1 day ago</small>
						<h5 class="font-15">
							<a href="">
								AFCON 2019: amount you will pay 20 MPs to enjoy the tournament in Egypt
							</a>
						</h5>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-3  col-md-6 mt-3">
				<div class="card rounded-0 border-0">
					<a href="">
						<img src="http://unsplash.it/800/500?image=13" alt="" class="w-100 img-fluid">
					</a>
					<div class="card-body px-0 py-1">
						<small class="text-pdgreen">1 day ago</small>
						<h5 class="font-15">
							<a href=""><div class="card rounded-0 border-0">
				
								AFCON 2019: amount you will pay 20 MPs to enjoy the tournament in Egypt
							</a>
						</h5>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-3  col-md-6 mt-3">
				<div class="card rounded-0 border-0">
					<a href="">
						<img src="http://unsplash.it/800/500?image=14" alt="" class="w-100 img-fluid">
					</a>
					<div class="card-body px-0 py-1">
						<small class="text-pdgreen">1 day ago</small>
						<h5 class="font-15">
							<a href="">
								AFCON 2019: amount you will pay 20 MPs to enjoy the tournament in Egypt
							</a>
						</h5>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-3 col-md-6 mt-3">
				<div class="card rounded-0 border-0">
					<a href="">
						<img src="http://unsplash.it/800/500?image=15" alt="" class="w-100 img-fluid">
					</a>
					<div class="card-body px-0 py-1">
						<small class="text-pdgreen">1 day ago</small>
						<h5 class="font-15">
							<a href="">
								AFCON 2019: amount you will pay 20 MPs to enjoy the tournament in Egypt
							</a>
						</h5>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-3  col-md-6 mt-3">
				<div class="card rounded-0 border-0">
					<a href="">
						<img src="http://unsplash.it/800/500?image=16" alt="" class="w-100 img-fluid">
					</a>
					<div class="card-body px-0 py-1">
						<small class="text-pdgreen">1 day ago</small>
						<h5 class="font-15">
							<a href="">
								AFCON 2019: amount you will pay 20 MPs to enjoy the tournament in Egypt
							</a>
						</h5>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-3  col-md-6 mt-3">
				<div class="card rounded-0 border-0">
					<a href="">
						<img src="http://unsplash.it/800/500?image=17" alt="" class="w-100 img-fluid">
					</a>
					<div class="card-body px-0 py-1">
						<small class="text-pdgreen">1 day ago</small>
						<h5 class="font-15">
							<a href=""><div class="card rounded-0 border-0">
				
								AFCON 2019: amount you will pay 20 MPs to enjoy the tournament in Egypt
							</a>
						</h5>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-3  col-md-6 mt-3">
				<div class="card rounded-0 border-0">
					<a href="">
						<img src="http://unsplash.it/800/500?image=18" alt="" class="w-100 img-fluid">
					</a>
					<div class="card-body px-0 py-1">
						<small class="text-pdgreen">1 day ago</small>
						<h5 class="font-15">
							<a href="">
								AFCON 2019: amount you will pay 20 MPs to enjoy the tournament in Egypt
							</a>
						</h5>
					</div>
				</div>
			</div>
		</section> -->

<?php
get_footer();
?>