<?php
/*
 * Template name: Portfolio
 */

get_header(); ?>

	<div class="omslagfoto" style="background-image:url(<?php the_field( 'omgslagfoto', 'option' ); ?>);"/>
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<h1>Projecten</h1>
					Huidige en recent opgeleverde projecten
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
			<div class="col-md-9 projecten">
	
<?php 
// the query to set the posts per page to 3
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('posts_per_page' => 6, 'paged' => $paged );
query_posts($args); ?>
<!-- the loop -->
<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
<div class="project">
	<a href="<?php the_permalink(); ?>">
		<div class="thumbnail">
			<?php the_post_thumbnail('full'); ?>
		</div>
		<div class="the_title">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</div>
	<div class="the_excerpt">
		 <p><?php the_excerpt(); ?></p>
	</div>
	</a>
	<div class="read_more">
		<a href="<?php the_permalink(); ?>" class="read_more_btn"><?php the_field( 'lees_meer_knop', 'options' ); ?></a>
	</div>
</div>
<?php endwhile; ?>
<div class="nav_post">
<?php previous_posts_link(); ?> <?php next_posts_link(); ?>
</div>

<?php else : ?>

<div class="no_post">
	<h1> Helaas geen berichten </h1>
</div>

<?php endif; ?>
</div>



			</div>
		</div>
	</div>



<?php get_footer(); ?>