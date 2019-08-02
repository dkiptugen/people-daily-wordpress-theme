<?php
function responsetek_login_logo()
    {
        ?>
        <style type="text/css">
            body.login div#login h1 a {
                background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.jpg);
                background-size: contain;
                width: 300px;
            }
            .login h1 a {
        height: 50px!important;
            }

        </style>
        <?php
    }

add_action('login_enqueue_scripts', 'responsetek_login_logo');
add_action( 'admin_menu', 'pd_home_category_menu' );
function pd_home_category_menu()
    {
        // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        add_menu_page('Home Category', 'home category', 'manage_options', 'home-category', 'add_home_category', 'dashicons-index-card', 13);
    }
function add_home_category()
    {
    	$cat = get_categories();
    	
    	
        echo '<h1 class="text-center font-25 fw-700 mt-5">Add/Update Home Category</h1>
              <div class="row justify-content-center mb-5">
              
              <form action="" class="form form-horizontal"  method="post">';
        for($x=1; $x<=4; $x++)
            {
            	add_option('home_cat_'.$x);
                $home_page_cats = get_option('home_cat_'.$x);
                echo '<div class="form-group">
                		<label for="home_cat_'.$x.'" class="control-label">Home category '.$x.'</label>
	                	<select name="home_cat_'.$x.'" id="home_cat_'.$x.'" class="rounded">
	                		<option selected value="'.$home_page_cats.'">'.$home_page_cats.'</option>';
	                		foreach($cat as $val)
						    	{
						    		if($val->name != $home_page_cats)
							    		{
							    			echo '<option value="'.$val->name.'">'.$val->name.'</option>';
							    		}						    		
						    	}
	            echo'  	</select>
	                </div>';
            }

        echo '<div class="form-group form-row">
        		<button type="submit" class="btn btn-primary ml-auto btn-sm" name="homecategory">Save</button>
        	</div>
        </form>
        </div>';

    }
if(isset($_POST['homecategory']))
	{
		unset($_POST['homecategory']);
		foreach($_POST as $key => $value )
			{
				//echo $key." : ".$value."<br />";
				update_option($key,$value);
			}
	}