<?php
/*
 *  Template Name: single post
 *
 *  @Package people daily
 *
 */
 get_header();
if(have_posts() & is_singular())
{
while(have_posts()):the_post();
$articleid = get_the_ID();
$category  = wp_get_post_categories((int)$post->ID);
foreach( $category as $term_id ) {
    $category = get_term( $term_id )->term_id;
    // do stuff.
}

echo '
<section class="row">
			<div class="col-12 col-md-8">
				<article id="content" class="raleway">
					<h1 class="nunito fw-900">
						'.get_the_title( $post ).'
					</h1>
					
					
					<div class="d-flex flex-wrap m-2">
						<div class="mr-3">
	  						'.get_avatar(get_the_author_meta('user_email')).'
			  			</div>
			  			<div class="text-dark font-13">By						
							<a href="'. get_author_posts_url($authordata->ID, $authordata->user_nicename).'" class="text-pdgreen">
								'.get_the_author().' 
							</a> <br /> '. get_the_time( 'l, F jS, Y' ).'
						</div>						
					</div>
					<figure class="position-relative">
						' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
						<figcaption class="d-flex justify-content-center font-12 position-absolute w-100 bottom-0">
							'.wp_get_attachment_caption(get_post_thumbnail_id()).'
						</figcaption>
					</figure>
					
						';
            $in_summary = get_post_meta( $post->ID, 'in_summary', true );
            if($in_summary) 
	            {
	               
	                echo'<div class="summary float-left border-right mr-3 mb-3">
		                    <strong class="text-danger text-center">
									In summary
							</strong>
		                    <div class="text-dark">
		                        <ul class="font-italic font-13 px-2">';
		                            
		                            $in_summary = str_replace("<p>", "<li>", $in_summary);
		                            $in_summary = str_replace("</p>", "</li>", $in_summary);
		                            echo $in_summary.'
		                           
		                        </ul>
		                    </div>
	                    </div>';
	                
	            }
	            echo '<div class="float-right clearfix">'.wideweb_social_share_buttons().'</div><p><br /></p>';
						
						
					
					echo get_the_content();

					if(get_the_tag_list()) {
                        echo get_the_tag_list('<ul class="related-topics list-unstyled d-flex justify-content-start flex-wrap"><li class="mr-2 mt-2">','</li><li class="mr-2 mt-2">','</li></ul>');
                    }
                    echo '
					<div class="d-flex justify-content-start flex-wrap">
						'.wideweb_social_share_buttons().'
					</div>
					<div class="promoted-posts clearfix">
						<strong>From the web</strong>
					</div>
					<div class="fb-comments" data-href="'.get_the_permalink().'" data-width="100%" data-numposts="30"></div>
				</article>
				
			</div>';
		endwhile;
		wp_reset_postdata();
	}
			?>
			<div class="col-12 col-md-4">
				<aside class="ad text-center">
					<small class="font-11">advertisement</small>
					<div class="ad d-flex justify-content-center">
						<img src="http://unsplash.it/300/250?image=12" alt="">
					</div>				
				</aside>
				<div class="section my-3">
					<h3 class="section-title">Trending Posts</h3>
				</div>
					<?php
					$notin = [];
					array_push($notin,$articleid );
				  	$data = trending_posts($notin,5);
				  	$x 	  = 1;
				  	if(is_array($data))
						{
							foreach($data as $post)
								{
									setup_postdata( $post);
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
										    	<h5 class="mt-0 font-15">
										    		<a href="'.get_the_permalink( $post).'" title="'.get_the_title( $post ).'">
														'.get_the_title( $post ).'
										    		</a>
										    	</h5>
										    	
										  	</div>
										</div>';
								}
							$x++;
							}
							wp_reset_postdata();
						}
				?>
				
				<aside class="latest">
					<div class="section my-3">
						<h3 class="section-title">Latest Posts</h3>
					</div>
						<?php
					$notin = [];
					array_push($notin,$articleid );
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
										    	<h5 class="mt-0 font-15">
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
$data = get_recommended_posts($articleid);
//var_dump($data);
if($data->have_posts())
{
       echo '<section>
			<div class="section">
				<h3 class="section-title">
					Recommended Stories
				</h3>
			</div>
			<div class="row">';

       while ($data->have_posts()):$data->the_post();
            echo '
				<div class="col-12 col-lg-3 col-md-6 mt-3">
					<div class="card rounded-0 border-0">
						<a href="'.get_the_permalink( $post).'" title="'.get_the_title( $post ).'" >
							' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
						</a>
						<div class="card-body px-0 py-1">
							<small class="text-pdgreen">'.time_ago(get_the_time()).'</small>
							<h5 class="font-15">
								<a href="'.get_the_permalink( $post).'" title="'.get_the_title( $post ).'" >
									'.get_the_title( $post ).'
								</a>
							</h5>
						</div>
					</div>
				</div>';

       endwhile;
       wp_reset_postdata();
       echo '</div>
		    </section>';
    }
?>



        <?php
			$data = fetch_posts_by_sub_category(array($articleid), $category,3);
			if($data->have_posts())
				{
                    echo '<section>
                            <div class="section">
                                <h3 class="section-title">
                                    <a href="'.get_category_link($category ).'">More Stories from '.get_the_category_by_ID( $category ).'</a>
                                </h3>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <div class="row py-3">';

								$x=1;
								while($data->have_posts()): $data->the_post();
								if( $x == 1 )
									{
										echo '<div class="col-12 col-md-6">
												<div class="card rounded-0 border-0">
													<a href="' . get_the_permalink() .'" title="'.get_the_title().'">
														' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
													</a>
													<div class="card-body px-0 py-1">
														<small class="text-pdgreen">'.time_ago(get_the_time()).'</small>
														<h5 class="font-15">
															<a href="' . get_the_permalink() .'" title="'.get_the_title().'">
																'.get_the_title().'
															</a>
														</h5>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">';
									}
								else
									{
										echo '<div class="media py-2">
											  	<a href="' . get_the_permalink() .'" title="'.get_the_title().'" class="col-4 px-0">
											  		' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
											  	</a>
											  	<div class="media-body col-8 pr-0">

											    	<h5 class="mt-0 font-15">
														<a href="' . get_the_permalink() .'" title="'.get_the_title().'">
															'.get_the_title().'
														</a>
											    	</h5>
											    	
											  	</div>
											</div>';
									}	
	         					$x++;					
								endwhile;
	                            wp_reset_postdata();

							echo '</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 py-3 text-center">
                                            <small class="font-10">advertisement</small>
                                            <aside class="ad d-flex justify-content-center">
                                                <img src="http://unsplash.it/300/250?image=45" alt="">
                                            </aside>
                                        </div>
                                    </div>
                                </section>';
                }

get_footer();
?>