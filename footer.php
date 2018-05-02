
<div class="meer-informatie" style="display:<?php if ( get_field( 'meer_informatie_footer', 'option' ) == 1 ) { 
  echo 'block;'; 
} else { 
 echo 'none;'; 
} ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1><?php the_field( 'titel_meer_informatie_bar', 'option' ); ?></h1>
			</div>
			<div class="col-md-6">
				<div class="m-i-buttons">
					<ul>
						<li><a href="mailto:<?php the_field( 'email_adres', 'option' ); ?>" class="light-email-button"><?php the_field( 'email_knop_tekst', 'option' ); ?></a></li>
						<li><a href="tel:<?php the_field( 'telefoonnummer', 'option' ); ?>" class="dark-phone-button"><?php the_field( 'telefonisch_contact', 'option' ); ?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div> 


<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h2 class="widgettitle">Contactgegevens</h2>
				<ul class="widget_contact">
					<li class="widget_phone">
						<?php the_field( 'telefoonnummer_scherff', 'option' ); ?>
					</li>
					<li class="widget_envelope">
						<?php the_field( 'emailadres', 'option' ); ?>
					</li>
				</ul>
			</div>
			<div class="col-md-3">
				<h2 class="widgettitle">Adresgegevens</h2>
				<ul class="widget_adresgegevens">
					<li class="widget_adres">
						<?php the_field( 'adres', 'option' ); ?>
					</li>
					<li >
						<?php the_field( 'postcode', 'option' ); ?>
					</li>
				</ul>
			</div>
			<div class="col-md-3">
				<?php dynamic_sidebar( 'footer_drie' ); ?>
			</div>
			<div class="col-md-3">
				<?php dynamic_sidebar( 'footer_vier' ); ?>
			</div>
		</div>
	</div>
</footer>

<div class="copyright">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				&copy; Scherff Hydrauliek
			</div>
			<div class="col-md-8">
				<?php dynamic_sidebar( 'conditions' ); ?>
			</div>
		</div>
	</div>
</div>

		<script>
	
	if ( $(window).width() > 1024) {      
document.write('<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() )?>/js/desktop.js"><\/script>');
} 
else {
	document.write('<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() )?>/js/mobile.js"><\/script>');
}
</script>

<script type="text/javascript">
        $("#carouselcontrols").carousel({
  swipe: 30 // percent-per-second, default is 50. Pass false to disable swipe
});
 </script> 

		<?php wp_footer(); ?>
	</body>
</html>