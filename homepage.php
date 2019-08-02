<?php
/*
 *  Template Name: Homepage
 *
 *  @Package people daily
 *
 */
 get_header();
 
?>
<!-- layer1 -->
		<section class="row">
			<div class="col-12 col-md-6 col-lg-3 order-2 order-lg-1">
				<?php
				$data = home_top(1,2);
				if($data->have_posts())
					{
						while ( $data->have_posts() ) : $data->the_post();
						echo'<div class="card rounded-0 border-0">
								<a href="'.get_the_permalink().'" title="'.get_the_title( $post ).'">
									' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
								</a>
								<div class="card-body px-0 py-1 font-18 fw-700">
									<a href="'.get_the_permalink().'" title="'.get_the_title( $post ).'">
										'.get_the_title( $post ).'
									</a>
								</div>
							</div>';
						endwhile;
						wp_reset_postdata();
					}
				$data =	get_home_latest(6);
				if($data->have_posts())
					{
						while ( $data->have_posts() ) : $data->the_post();
							echo '
									<div class="media border-top py-2">
									  	<a href="'.get_the_permalink( $post ).'" title="'.get_the_title( $post ).'" class="col-4 px-0">
									  		' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
									  	</a>
									  	<div class="media-body col-8 pr-0 ">
									    	<h5 class="mt-0 font-15 fw-400">
										    	<a href="'.get_the_permalink( $post ).'" title="'.get_the_title( $post ).'">
										    		'.get_the_title( $post ).'	
										    	</a>
									    	</h5>
									    	
									  	</div>
									</div>';
						endwhile;
						wp_reset_postdata();

					}
				?>
				
			</div>
			<div class="col-12 col-md-5 col-lg-5  order-1 order-lg-2">
				<?php
				   $data = home_top(2);
					if($data->have_posts())
						{
							$x=1;
							while ( $data->have_posts() ) : $data->the_post();
						    	echo'
									<div class="card rounded-0 border-0">
										<a href="' . get_the_permalink() .'">
											' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
										</a>
										<div class="card-body px-0 py-1">
											<h'.$x.' class="font-28 fw-900 nunito">
												<a href="' . get_the_permalink() .'">
													'.get_the_title().'
												</a>
											</h'.$x.'>
											<p  class="font-13 d-none d-md-block">
												'.get_the_excerpt().'
											</p>
										</div>
									</div>';
									$x++;
							endwhile;
							wp_reset_postdata();
						}
				?>
				
			</div>
			<div class="col-12 col-md-6 col-lg-4 order-3">
				<div class="ad d-flex justify-content-center">
					<img src="http://unsplash.it/300/250?image=96" class="img-fluid" alt="">
				</div>
				<div class="section mt-3 p-0">					
					<h3 class="section-title font-15 text-pdgreen">
						<a href="">Trending Posts</a>
					</h3>					
				</div>
				<ul class="list-group list-group-flush">
				  	
				  	<?php
				  	$data = trending_posts([],6);
				  	if(is_array($data))
						{
						    $x=1;
							foreach($data as $post)
										{
											setup_postdata( $post);
								echo'
								    <li class="list-group-item px-0">
								    	<h5 class="font-15 my-0 font-400">
									    	<a href="'.get_the_permalink().'" title="'.get_the_title().'">
									    		'.get_the_title().'
									    	</a>
								    	</h5>
								    	<p class="font-11 my-0">'.time_ago(get_the_date()).'</p>
								    </li>';
								$x++;
							}
							wp_reset_postdata();
						}
				    ?>
				   
				</ul>
			</div>
		</section>
		<!-- second section -->
		<section class="row mb-2">
			<div class="col-12">
				<div class="w-100 d-flex justify-content-center ad mb-2">
					<img src="http://unsplash.it/970/90?image=196" alt="">
				</div>
			</div>
		</section>
		<section class="row mb-2">
			<?php
			$check = check_home_category("home_cat_1");
			
			if($check)
				{
					$category_id = get_cat_ID($check);
					echo '
				    <div class="col-12">		
						<div class="section mt-3 p-0">
							<h3 class="section-title font-18 text-pdgreen">
								<a href="'.get_category_link($category_id).'">
									'.$check.'
								</a>
							</h3>					
						</div>
					</div>';
					$x=1;
					$data =  home_category($category_id,5);
					if($data->have_posts())
						{
							while ( $data->have_posts() ) : $data->the_post();
								if($x == 1)
									{
										echo '<div class="col-12 col-lg-8 col-md-6 mt-3 ">
												<div class="flex-wrap d-flex bg-light ">
													<div class="col-12 col-lg-3 order-2 order-lg-1 bg-light p-4">
														<h4 class="font-20 text-justified m-0">
															<a href="'.get_the_permalink( $post ).'">
																'.get_the_title().'
															</a>
														</h4>
														<p class="font-12">
															<a href="">BY '.get_the_author().'</a>
														</p>
													</div>
													<div class="col-12 col-lg-9 order-1 order-lg-2 px-0">
														<a href="'.get_the_permalink( $post ).'">
															' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
														</a>
													</div>
												</div>
											</div>';
									}
								else if($x == 2)
					                {
					                	echo '<div class="col-12 col-lg-4 col-md-6 mt-3">
												<div class="card rounded-0 border-0">
													<a href="'.get_the_permalink( $post ).'">
														' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
													</a>
													<div class="card-body px-0 py-1">
														<small class="text-pdgreen">
															'.time_ago(get_the_date()).'
														</small>
														<h5 class="font-18">
															<a href="'.get_the_permalink( $post ).'">
																'.get_the_title().'
															</a>
														</h5>
													</div>
												</div>
											</div>';
					                }
					            else
						            {
						            	echo '<div class="col-12 col-md-4 mt-3">
												<div class="card rounded-0 border-0">
													<a href="'.get_the_permalink( $post ).'" title="'.get_the_title().'">
														' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
													</a>
													<div class="card-body px-0 py-1">
														<small class="text-pdgreen">
															'.time_ago(get_the_date()).'
														</small>
														<h5 class="font-15">
															<a href="'.get_the_permalink( $post ).'" title="'.get_the_title().'">
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
						}
				}
			?>
			
			
		</section>
		<!-- Third Section -->

		<section class="row">
			<div class="col-lg-8  col-12">
				<div class="row">
					<div class="col-md-5 col-12">
						<?php
						$check = check_home_category("home_cat_2");
						
						if($check)
							{
								$category_id = get_cat_ID($check);
								echo '
									<div class="section my-3 p-0">
										<h3 class="section-title font-18 text-pdgreen">
											<a href="'.get_category_link($category_id).'" title="'.$check.'">
												'.$check.'
											</a>
										</h3>												
									</div>';
								$x=1;
								$data =  home_category($category_id,4);
								if($data->have_posts())
									{
										while ( $data->have_posts() ) : $data->the_post();
											if($x == 1)
												{
													echo '<div class="card rounded-0 border-0">
														<a href="'.get_the_permalink( $post ).'">
															' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
														</a>
														<div class="card-body px-0 py-1 fw-500 font-18">
															<a href="'.get_the_permalink( $post ).'">
																'.get_the_title().'
															</a>
														</div>
													</div>';
												}
											else
												{
													echo '<div class="media border-top py-2">
														  	<a href="'.get_the_permalink( $post ).'" title="'.get_the_title().'" class="col-4 px-0">
														  		' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
														  	</a>
														  	<div class="media-body col-8 pr-0">
														    	<h5 class="mt-0 font-15">
														    		<a href="'.get_the_permalink( $post ).'" title="'.get_the_title().'">
																		'.get_the_title().'
														    		</a>
														    	</h5>
														    	
														  	</div>
														</div>';
												}	
												 $x++;
									    endwhile;
										wp_reset_postdata();
									}
							}
						?>
						
						
				
					</div>
					<div class="col-md-7 col-12">
						<?php
						$check = check_home_category("home_cat_3");
						
						if($check)
							{
								$category_id = get_cat_ID($check);
								echo'
									<div class="section my-3 p-0 ">
										<h3 class="section-title font-18 text-pdgreen">
											<a href="'.get_category_link($category_id).'" title="'.$check.'">
												'.$check.'
											</a>
										</h3>					
									</div>';
								$x=1;
								$data =  home_category($category_id,3);
								if($data->have_posts())
									{
										while ( $data->have_posts() ) : $data->the_post();
											if($x == 1)
												{
													echo '
													<div class="card rounded-0 border-0">
														<a href="'.get_the_permalink( $post ).'" title="'.get_the_title().'">
															' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
														</a>
														<div class="card-body px-0 py-1 ">
															<h5 class="font-18 fw-md-700">
																<a href="'.get_the_permalink( $post ).'" title="'.get_the_title().'">
																	'.get_the_title().'
																</a>
															</h5>
															<p class="font-13 text-dark">'.get_the_excerpt().'</p>
														</div>
														<ul class="list-group list-group-flush">';
												}
											else
												{
													echo ' <li class="list-group-item px-0">
													    	<h5 class="font-15 my-0">
													    		<a href="'.get_the_permalink( $post ).'" title="'.get_the_title().'">
													    			'.get_the_title().'
													    		</a>
													    	</h5>
													    	
													    </li>';
												}				  	
										   $x++;
												    endwhile;
													wp_reset_postdata();
												}
										}
									?>
							    
							   
							</ul>
						</div>
					</div>
					<div class="col-12 ad d-flex justify-content-center">
						<img src="http://unsplash.it/728/90?image=43" alt="">
					</div>

				</div>
					<?php
						$check = check_home_category("home_cat_4");
						
						if($check)
							{
								$category_id = get_cat_ID($check);
								echo '
									<div class="section mt-3 p-0">					
										<h3 class="section-title font-15 text-pdgreen">
											<a href="'.get_category_link($category_id).'" title="'.$check.'">
												'.$check.'
											</a>
										</h3>					
									</div>
									<div class="row">';
							    $data =  home_category($category_id,3);
								if($data->have_posts())
									{
										while ( $data->have_posts() ) : $data->the_post();
											echo '
											<div class="col-12 col-md-4 mt-3">
												<div class="card rounded-0 border-0">
													<a href="'.get_the_permalink( $post ).'" title="'.get_the_title().'">
														' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
													</a>
													<div class="card-body px-0 py-1">
														<small class="text-pdgreen">
															'.time_ago(get_the_date()).'
														</small>
														<h5 class="font-15">
															<a href="'.get_the_permalink( $post ).'" title="'.get_the_title().'">
																'.get_the_title().'
															</a>
														</h5>
													</div>
												</div>
											</div>';
										endwhile;
										wp_reset_postdata();
									}
							}
						?>
					
				</div>
			</div>
			<div class="col-md-4 col-12">
				<div class="ad d-flex justify-content-center">
					<img src="http://unsplash.it/300/250?image=201" alt="">
				</div>
				<?php

				$category_id = get_cat_ID('peoplespeak');
				$data =  get_category_top($category_id,7);
				if($data->have_posts())
					{
						echo '<div class="section my-3 p-0">
									<h3 class="section-title font-18 text-pdgreen">
										<a href="'.get_category_link($category_id).'" title="people speak" >People Speak</a>
									</h3>												
								</div>';
						while ( $data->have_posts() ) : $data->the_post();
				
							echo '<div class="media py-2">
								  	<a href="'.get_the_permalink( $post ).'" title="'.get_the_title().'" class="col-4 px-0">
								  		' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
								  	</a>
								  	<div class="media-body col-8 pr-0">
								    	<h5 class="mt-0 font-15">
								    		<a href="'.get_the_permalink( $post ).'" title="'.get_the_title().'">
												'.get_the_title().'
											</a>
								    	</h5>
								    	
								  	</div>
								</div>';
						    endwhile;
						    wp_reset_postdata();
						}
						?>
				
			
		</section>
		<section class="row mt-3">
			<div class="col-12 col-md-8">
				<?php
					$data = get_slideshow(NULL,6);
					if($data->have_posts())
						{
							echo '
								<div class="section my-3 p-0">
									<h3 class="section-title font-18 text-pdgreen">
										<a href="">Pictures of the Day</a>
									</h3>												
								</div>
								<div class="row">';
								while ( $data->have_posts() ) : $data->the_post();
								echo '
									<div class="col-12 col-md-4 mt-3">
										<div class="card rounded-0 border-0">
											<a href="'.get_the_permalink( $post ).'" title="'.get_the_title().'">
												' . get_the_post_thumbnail($post,array(500,800), ['class'=>'w-100 img-fluid'] ) .'
											</a>
											<div class="card-body px-0 py-1">
												<small class="text-pdgreen">1 day ago</small>
												<h5 class="font-15">
													<a href="'.get_the_permalink( $post ).'" title="'.get_the_title().'">
														'.get_the_title( $post ).'
													</a>
												</h5>
											</div>
										</div>
									</div>';
								endwhile;
						    	wp_reset_postdata();
						    	echo '</div>';
						
				echo'		
					</div>
					<div class="col-12 col-md-4">
						<div class="ad d-flex justify-content-center my-3">
							<img src="http://unsplash.it/300/600?image=208" alt="">
						</div>
					</div>';
		    }
					?>
		</section>
<?php
get_footer();
?>
