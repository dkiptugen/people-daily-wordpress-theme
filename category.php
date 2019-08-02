<?php
/*
 *  Template Name: category
 *
 *  @Package people daily
 *
 */
 get_header();
 $category = get_category( get_query_var( 'cat' ) );
 $postid_arrays = [];

?>
<section class="row">
			<div class="col-12">
				<h1 class="text-center text-pdgreen"><?=$category->name; ?></h1>
				<div class="d-flex flex-wrap justify-content-center">
                <?php		
					$args     = array('child_of' => $category->cat_ID);
 					$children = get_categories('child_of=' .$category->cat_ID . '&hide_empty=1');
					
 					foreach ($children as $child) 
						{
 							 echo '<a href="'.get_category_link($child->cat_ID ).'" class="btn btn-black btn-sm text-white m-2">'.$child->name.'</a>';
 						}
					wp_reset_postdata();
			    ?>
					
				</div>
			</div>
			<div class="col-md-8 col-12">

				<div class="row">
					<div class="col-12 d-none d-lg-block col-md-4 mt-3">
						<div class="section mb-3">
							<h3 class="section-title">Latest Posts</h3>
						</div>
						<ul class="list-group list-group-flush">
							<?php

							
						  	$data = fetch_posts("", 3, 0);
						  	//var_dump($data);
						  	$x 	  = 1;
						  	if(is_array($data))
								{
									foreach($data as $post)
										{
											setup_postdata( $post);
											
		                                       
												$latecat = get_the_category(get_the_ID());
												foreach($latecat as $value)
													{
														$catname = $value->name;
														$catid   = $value->term_id;
													}
												//wp_reset_query();
												echo'
													<li class="py-1 px-0 '.(($x==1)?"border-top-0":"").' list-group-item">
														<small>
															<a href="'.get_category_link($catid).'" class="text-danger fw-600">
																'.$catname.'
															</a>
														</small>
														<h4 class="font-15 my-0">
															<a href="' . get_the_permalink() .'"  title="'.get_the_title().'">
																'.get_the_title().'
															</a>
															
														</h4>
														<p class="font-11">
															<a href="'. get_author_posts_url($authordata->ID, $authordata->user_nicename).'" class="text-dark">By '.get_the_author().' </a></p>
													</li>';
												$x++;
											
											
										}
									wp_reset_postdata();
								}
							?>
						</ul>
					</div>

					<?php
					$data = get_category_top($category->cat_ID,4);
					if($data->have_posts())
						{
						    $x = 1;
							while($data->have_posts()):$data->the_post();
								array_push($postid_arrays, get_the_ID());
		                    if($x == 1)
			                    {
			                    	echo'
										<div class="col-12 col-lg-8 mt-3">
											<div class="card rounded-0 border-0">
												<a href="' . get_the_permalink() .'" title="'.get_the_title().'">
													' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
												</a>
												<div class="card-body px-0 py-1">
													<h1 class="font-28 fw-900 nunito">
														<a href="' . get_the_permalink() .'" title="'.get_the_title().'">
															'.get_the_title().'
														</a>
													</h1>
													
												</div>
											</div>
										</div>
										<div class="row">
										';

			                    }
							else
								{
									echo '<div class="col-12 col-md-4 mt-3">
											<div class="card rounded-0 border-0">
												<a href="' . get_the_permalink() .'" title="'.get_the_title().'">
													' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
												</a>
												<div class="card-body p-1">
													<h5 class="font-15">
														<a href="' . get_the_permalink() .'" title="'.get_the_title().'">
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
							if($x<4)
                                {
                                    echo "</div>";
                                }

						}
						?>


				</div>

				

				<!-- ad section -->
				<div class="row my-4 ">
					<div class="ad d-flex justify-content-center col-12">
						<img src="http://unsplash.it/728/90?image=78" class="img-fluid" alt="">
					</div>
				</div>
				<!-- section 2 -->
                <div class="clearfix"></div>
			   	<?php
			   	foreach ($children as $child) 
				   	{
				   		$catquery = fetch_posts_by_sub_category($postid_arrays,$child->cat_ID, 3);
				   		if($catquery->have_posts())
				   			{
						   		echo '<div class="row">
										<div class="col-12">
											<div class="section mt-3">
												<h3 class="section-title"><a href="'.get_category_link($child->cat_ID ).'">'.$child->name.'</a></h3>
											</div>
										</div>';
								while($catquery->have_posts()):$catquery->the_post();
									echo'
			                            <div class="col-12 col-md-4 mt-3">
											<div class="card rounded-0 border-0">
												<a href="' . get_the_permalink() .'" title="'.get_the_title().'">
													' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
												</a>
												<div class="card-body p-1">
													<small class="text-pdgreen">'.time_ago(get_the_date()).'</small>
													<h5 class="font-15">
														<a href="' . get_the_permalink() .'" title="'.get_the_title().'">
															' . get_the_title() .'
														</a>
													</h5>
												</div>
											</div>
										</div>';
								endwhile;
								wp_reset_postdata();
						    }
						echo '</div>';
						
				   	}
				?>
            </div>
			</div>
			<div class="col-md-4 col-12">
				<aside class="ad py-3 text-center">
					<small class="font-10">ADVERTISEMENT</small>
					<aside class="ad d-flex justify-content-center">
						<img src="http://unsplash.it/300/250?image=45"  alt="">
					</aside>
				</aside>
				<aside class="">
					<div class="section my-3">
						<h3 class="section-title">Trending Posts</h3>
					</div>
					<?php
					
				  	$data = trending_posts($postid_arrays,5);
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
				</aside>
				<aside class="ad py-3 text-center">
					<small class="font-10">ADVERTISEMENT</small>
					<aside class="ad d-flex justify-content-center">
						<img src="http://unsplash.it/300/600?image=145" class="d-none d-lg-block" alt="">

                        <img src="http://unsplash.it/300/250?image=145" class="d-block d-lg-none" alt="">
					</aside>
				</aside>
                <div class="col-12 d-block d-lg-none col-lg-4 mt-3">
                    <div class="section mb-3">
                        <h3 class="section-title">Latest Posts</h3>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php


                        $data = get_latest_posts(NULL,2);
                        $x 	  = 1;
                        if($data->have_posts())
                        {
                            while ( $data->have_posts() ) : $data->the_post();

                                $latecat = get_the_category($post->ID);
                                foreach($latecat as $value)
                                {
                                    $catname = $value->name;
                                    $catid   = $value->term_id;
                                }
                                echo'
											<li class="py-1 px-0 '.(($x==1)?"border-top-0":"").' list-group-item">
												<small>
													<a href="'.get_category_link($catid).'" class="text-danger fw-600">
														'.$catname.'
													</a>
												</small>
												<h4 class="font-15 my-0">
													<a href="' . get_the_permalink() .'"  title="'.get_the_title().'">
														'.get_the_title().'
													</a>
													
												</h4>
												<p class="font-11">
													<a href="'. get_author_posts_url($authordata->ID, $authordata->user_nicename).'" class="text-dark">By '.get_the_author().' </a></p>
											</li>';
                                $x++;
                            endwhile;
                            wp_reset_postdata();
                        }
                        ?>
                    </ul>
                </div>

            </div>
		</section>

<?php
get_footer();
?>