<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
	
</head>
<body>
	<?php
		if(is_single( '' ))
			{
				echo '
						<div id="fb-root"></div>
						<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=329919840946944&autoLogAppEvents=1"></script>';
			}
	?>
	<header class="mb-5">
		<nav class="container d-none d-lg-flex  clearfix" id="nav-1 ">
			
					<a class="m-0 logo"  href="<?= get_home_url(); ?>" >
						<?php
				  		$custom_logo_id = get_theme_mod( 'custom_logo' );
						$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
						// var_dump($logo);
						if ( has_custom_logo() ) {
						        echo '<img src="' . $logo[0] . '" alt="' . get_bloginfo( 'name' ) . '">';
						} else {
						        echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
						}
						?>
				  	</a>
				  	<div class="ml-auto py-2">
						<img src="https://unsplash.it/728/90?image=16" class="img-fluid" alt="" />	
					</div> 
		
		</nav>
		<nav class="bg-black navbar navbar-expand-md navbar-dark py-md-0" id="nav-2">
			<div class="container">
				<a href="<?= get_home_url(); ?>" class="navbar-brand d-lg-none">
					<?php
						
						$logo = get_theme_mod( 'PD_light_logo' );
						
						if ( $logo != "" ) {
						        echo '<img src="' . $logo . '" style="height:50px" alt="' . get_bloginfo( 'name' ) . '">';
						} else {
						        echo '<h1 class="text-white">'. get_bloginfo( 'name' ) .'</h1>';
						}
					?>
				</a>
				<a class="nav-link text-white d-block d-md-none" href="">
					<i class="fa fa-search"></i>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    			<span class="fas fa-bars"></span>
	  			</button>				
							    
					<?php
						$args = array(
										'container_class' 	=>	'collapse navbar-collapse w-100',
										'container_id'		=>	'navbarSupportedContent',
										'menu_class'		=>	'navbar-nav mx-md-auto',
										'menu_id'			=>	'',
										'theme_location'	=>  'topmenu',
										'depth'             => 	1,
										'fallback_cb'		=>	false,
										'add_li_class'      =>  'nav-item',
										
									);
						wp_nav_menu($args);			
				    ?>
				<a class="nav-link text-white d-none d-md-block" href="">
					<i class="fa fa-search"></i>
				</a>
			
			</div>
		</nav>
	</header>
	<main class="container">