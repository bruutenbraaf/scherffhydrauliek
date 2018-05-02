 <?php get_header(); ?>
 
 
 <?php if(is_front_page()): ?>
 	<?php if ( have_rows( 'slider' ) ): ?>
 	
		<div id="carouselcontrols" class="carousel slide" data-ride="carousel">			
		  <div class="carousel-inner">
			  
			 <?php while ( have_rows( 'slider' ) ) : the_row(); ?>
				<?php if ( get_row_layout() == 'slides' ) : ?>	  
				    <div class="carousel-item">
					    <?php $slide_afbeelding = get_sub_field( 'slide_afbeelding' ); ?>
						<?php if ( $slide_afbeelding ) { ?>
						<div style="background:url('<?php echo $slide_afbeelding['url']; ?>') no-repeat center center fixed; background-size: cover;" class="w-100 slide"><div class="overlay"></div>
							<div class="container">
								<div class="row">
									<div class="col-md-8">
										<h1><?php the_sub_field( 'titel_slide' ); ?></h1>
										<p><?php the_sub_field( 'content_slide' ); ?></p>
										<a href="<?php the_sub_field( 'knop_link' ); ?>" class="button_slide"><?php the_sub_field( 'knop_tekst' ); ?></a>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
				    </div>    
				<?php endif; ?>
			<?php endwhile; ?>
		 
		 
		 </div>
		  
		  <a class="carousel-control-prev" href="#carouselcontrols" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselcontrols" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		  
		</div>
	<?php else: ?>
		<?php // no layouts found ?>
	<?php endif; ?>
	
<div class="container intro">
	<div class="row">
		<div class="col-md-12">
			<h1><?php the_field( 'intro_titel' ); ?></h1>
			<div class="col-md-9 intro_tekst">
			<p><?php the_field( 'intro_tekst' ); ?></p>
			<?php if( get_field( 'knop_tekst_intro' ) ): ?>
				<a href="<?php the_field( 'knop_link_intro' ); ?>" class="button"><?php the_field( 'knop_tekst_intro' ); ?></a>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<div class="informatie-bar" style="background:<?php the_field( 'achtergrond_kleur' ); ?>;">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<h1><?php the_field( 'info_titel_grey' ); ?></h1>
				<?php the_field( 'content_titel_grey' ); ?>			
			</div>
			<div class="col-md-5">
				
			</div>
		</div>
	</div>
	<div class="informatie-bar-image">
		<?php if ( get_field( 'afbeelding_info_grey' ) ) { ?>
			<img src="<?php the_field( 'afbeelding_info_grey' ); ?>" />
		<?php } ?>
	</div>
	
	<a href="<?php the_field( 'knop_link_info_grey' ); ?>" class="informatie-bar-button"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
</div>


  



<?php if ( have_rows( 'homepagina_tabs' ) ): ?>
	
	<div class="container home-tabs">
		<div class="row">
			<div class="col-md-3">
				<ul class="nav nav-tabs nav-tabs-home" id="myTab" role="tablist">
					<?php while ( have_rows( 'homepagina_tabs' ) ) : the_row(); ?>
						<?php if ( get_row_layout() == 'tab' ) : ?>
					
				    <li role="presentation"><a href="#<?php the_sub_field( 'unique_id' ); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php the_sub_field( 'tab_knop_tekst' ); ?></a></li>
				    
				        <?php endif; ?>
	<?php endwhile; ?>

	
			  	</ul>
			</div>
			<div class="col-md-9">
			 	<div class="tab-content">
				 	
				 	<?php while ( have_rows( 'homepagina_tabs' ) ) : the_row(); ?>
						<?php if ( get_row_layout() == 'tab' ) : ?>
				 	
				    <div role="tabpanel" class="tab-pane" id="<?php the_sub_field( 'unique_id' ); ?>">
					    <h1><?php the_sub_field( 'tab_titel' ); ?></h1>
					    <?php the_sub_field( 'tab_tekst' ); ?>
					    
					    <?php if(get_sub_field("meer_info_knop")): ?>
					    	<a href="<?php the_sub_field( 'link_van_de_knop' ); ?>" class="button"><?php the_sub_field( 'meer_info_knop' ); ?></a>
					    <?php endif; ?>
					</div>
				    
				    <?php endif; ?>
					<?php endwhile; ?>
				    
				</div>
			</div>
		</div>
	</div>

<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>


<?php endif; ?>	

<?php if ( get_field( 'omgslagfoto' ) ) { ?>
	<div class="omslagfoto" style="background-image:url(<?php the_field( 'omgslagfoto' ); ?>);"/>
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<h1><?php the_field( 'titel' ); ?></h1>
					<?php the_field( 'intro_tekst' ); ?>
					<a href="<?php the_field( 'knop_url' ); ?>" class="button"><?php the_field( 'intro_knop' ); ?></a>
				</div>
			</div>
		</div>
		<div class="overlay">
		</div>
	</div>
	<div class="breadcrumbs_page">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php custom_breadcrumbs(); ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container content_page">
		<div class="row">
			<div class="col-md-3">
				<?php dynamic_sidebar( 'sidebar' ); ?>
				<?php the_field( 'phone', $widget_id_prefixed ); ?>
			</div>
			<div class="col-md-9">
				<h1><?php the_field( 'content_titel' ); ?></h1>
				<?php the_field( 'content' ); ?>		
			</div>
		</div>
	</div>
<?php } ?>
	<?php get_footer(); ?>


