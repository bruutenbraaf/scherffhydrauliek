<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	
	<?php wp_head(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title('|', true, 'right'); ?> </title>
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() )?>/bootstrap/css/bootstrap.min.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() )?>/style.css" type="text/css" media="all" />
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() )?>/js/jquerymobile.min.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() )?>/bootstrap/js/popper.min.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() )?>/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() )?>/js/carousel-swipe.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() )?>/js/scripts.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZn1deMhAw6igAgVh56mC7r7zVRSEzv6w"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() )?>/js/googlemaps.js"></script>
	<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
	<link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() )?>/font-awesome/css/font-awesome.min.css">
	
	
	
</head>
<body>
	
	<div class="main_menu_top ">
		<div class="container">
			<div class="row">
				<div class="col-md-4 logo">
					<?php if ( get_field( 'logo', 'option' ) ) { ?>
					<a href="<?php $url = home_url();
echo $url;?>">
					 <img class="branding" src="<?php the_field( 'logo', 'option' ); ?>" /></a>
					<?php } ?>
				</div>
				<div class="col-md-8 hoofd_menu"> 
					<?php wp_nav_menu( array( 'theme_location' => 'main' ) ); ?>
					<a href="contact"><div class="button_hoofd_menu">
						Direct contact
					</div>
					</a>
				</div>
				
				<div class="col-md-8 mobile_menu"> 
					<div class="mobile_menu_container">
						<div class="hamburger">
							<div></div>
							<div></div>
							<div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="m-menu">
	<div class="m-menu-col">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php wp_nav_menu( array( 'theme_location' => 'main' ) ); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="m-menu-col">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="m-menu-col-info">
						<li class="m-menu-col-phone"><i class="fa fa-phone" aria-hidden="true"></i> +31 (0)6 – 298 882 53</li>
						<li><i class="fa fa-envelope" aria-hidden="true"></i> info@scherffhydrauliek.nl</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
	<div class="content">
	
	