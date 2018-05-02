<?php
/*
 * Template name: Contact
 */

get_header(); ?>
 
<div id="map">
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
			<div class="col-md-3 sidebar-contact">
				<h1>Contactgegevens</h1>
					Peppeling 65<br>
					9603 HK Hoogezand<br><br>
					+31 (0)6 – 298 882 53<br>
info@scherffhydrauliek.nl
			</div>
			<div class="col-md-9">
<form class="modals multi-step" id="demo-modals-3">
    <div class="modals-dialog">
        <div class="modals-content">
            <div class="modals-header">
			                <h1 class="modals-title step-1" data-step="1">Waar kunnen wij u mee helpen?</h1>
			                <h1 class="modals-title step-2" data-step="2">Wat is uw naam?</h1>
			                <h1 class="modals-title step-3" data-step="3">Waarop kunnen wij u bereiken?</h1>
			                <h1 class="modals-title step-4" data-step="4">Voer uw vraag of opmerking in</h1>
			            </div

            
            
            <?php echo do_shortcode( '[contact-form-7 id="209" title="Contactformulier 1"]' ); ?>
            
        
            <div class="modals-footer">
            <div class="m-progress">
	            <div class="container contact-container">
	            <div class="row row-contact">
		            <div class="col-md-4">		            
			            <div class="contact-buttons">
			                <button type="button" class="btn btn-primary step step-2" data-step="2" onclick="sendEvent('#demo-modals-3', 1)">Terug</button>
			                <button type="button" class="btn btn-primary step step-1" data-step="1" onclick="sendEvent('#demo-modals-3', 2)">Volgende</button>
			                <button type="button" class="btn btn-primary step step-3" data-step="3" onclick="sendEvent('#demo-modals-3', 2)">Terug</button>
			                <button type="button" class="btn btn-primary step step-2" data-step="2" onclick="sendEvent('#demo-modals-3', 3)">Volgende</button>
			                <button type="button" class="btn btn-primary step step-4" data-step="1" onclick="sendEvent('#demo-modals-3', 3)">Terug</button>
			                <button type="button" class="btn btn-primary step step-3" data-step="2" onclick="sendEvent('#demo-modals-3', 4)">Volgende</button>
		            	</div>		            
		            </div>
	            <div class="col-md-8">
		            
		            
		            
		              <div class="m-progress-bar-wrapper">
			                        <div class="m-progress-bar">
			                        </div>
			                    </div>
			                    <div class="m-progress-stats">
				                    Stap:
			                        <span class="m-progress-current">
			                        </span>
			                        /
			                        <span class="m-progress-total">
			                        </span>
			                    </div>
			                    <div class="m-progress-complete">
			                        Afgerond
			                    </div>

		            
		            

	            </div>
	            </div>
            </div>
            </div>
        </div>
            </div>
    </div>
</form>
			</div>
		</div>
	</div>
	
	
<script>
sendEvent = function(sel, step) {
    $(sel).trigger('next.m.' + step);
}
</script>	
	
		<?php get_footer(); ?>


