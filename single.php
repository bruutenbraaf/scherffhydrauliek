<?php
/*
 * Template name: Portfolio
 */

get_header(); ?>

	<div class="omslagfoto" style="background-image:url(<?php the_field( 'omgslagfoto', 'option' ); ?>);"/>
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
			<div class="col-md-9 pr">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

 <h1><?php the_title(); ?></h1>
  <span class="pr_datum"><?php echo get_the_date(); ?></span>
  
 <?php the_content(); ?>

<?php endwhile; ?>
<?php endif; ?>

			</div>
		</div>
	</div>



<?php get_footer(); ?>